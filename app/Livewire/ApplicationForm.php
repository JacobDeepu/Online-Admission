<?php

namespace App\Livewire;

use App\Models\FormSubmission;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ApplicationForm extends Component
{
    public $currentTab = 1;

    public $isSubmitted = false;

    public $showModal = false;

    public $formSections = [];

    public $submissionId;

    public $institution;

    #[Validate]
    public $formData = [];

    public function mount($institution)
    {

        $this->institution = $institution;
        $sections = $institution->sections;
        $sections = $sections->load(['fields', 'subSections.fields']);
        $this->formSections = $sections;

        foreach ($sections as $section) {
            foreach ($section->fields as $field) {
                $this->formData[$field->name] = null;
            }
            foreach ($section->subSections as $subSection) {
                foreach ($subSection->fields as $field) {
                    $this->formData[$field->name] = null;
                }
            }
        }

        $this->submissionId = session('submissionId');

        if ($this->submissionId) {
            $this->showModal = true;
        }
    }

    protected function rules()
    {
        $rules = [];
        $currentSection = $this->formSections[$this->currentTab - 1];

        foreach ($currentSection->fields as $field) {
            $rules['formData.'.$field->name] = $field->validation_rules ?? 'nullable';
        }

        foreach ($currentSection->subSections as $subSection) {
            foreach ($subSection->fields as $field) {
                $rules['formData.'.$field->name] = $field->validation_rules ?? 'nullable';
            }
        }

        return $rules;
    }

    protected function validationAttributes()
    {
        $attributes = [];
        $currentSection = $this->formSections[$this->currentTab - 1];

        foreach ($currentSection->fields as $field) {
            $attributes['formData.'.$field->name] = $field->label;
        }

        foreach ($currentSection->subSections as $subSection) {
            foreach ($subSection->fields as $field) {
                $attributes['formData.'.$field->name] = $field->label;
            }
        }

        return $attributes;
    }

    public function nextSection()
    {
        $this->validate();
        if ($this->currentTab < count($this->formSections)) {
            $this->currentTab++;
        }
    }

    public function submitForm()
    {
        $this->validate();

        $user = auth()->user();

        $this->submissionId = FormSubmission::create([
            'institution_id' => $this->institution->id,
            'submission_data' => $this->formData,
            'submitted_by' => $user?->id,
            'verified_by' => $user?->id,
            'status' => $user?->id ? 'verified' : 'pending',
        ]);

        session()->flash('message', 'Form submitted successfully!');
        $this->isSubmitted = true;

        session()->flash('submissionId', $this->submissionId);
        $this->redirectIntended('apply');
    }

    public function download()
    {
        $this->showModal = false;
        $this->redirectRoute('print', $this->submissionId);
    }
}
