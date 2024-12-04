<?php

namespace App\Livewire\FormBuilder\Modals;

use App\Models\FormSubSection;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SubSectionModal extends Component
{
    public $isOpen = false;

    public $subSectionId = 0;

    #[Validate('required|string|max:255')]
    public $name;

    #[Validate('nullable|string|max:255')]
    public $icon;

    #[Validate('nullable|string|max:255')]
    public $description;

    #[Validate('required|exists:form_sections,id')]
    public $formSectionId;

    #[On('open-sub-section-modal')]
    public function openModal($subSection = null, $formSectionId = null)
    {
        $this->reset();

        $this->formSectionId = $formSectionId ?? null;

        if ($subSection) {
            $this->subSectionId = $subSection['id'];
            $this->name = $subSection['name'];
            $this->icon = $subSection['icon'];
            $this->description = $subSection['description'];
            $this->formSectionId = $subSection['form_section_id'];
        }

        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function save()
    {
        $this->validate();

        if ($this->subSectionId) {
            $section = FormSubSection::find($this->subSectionId);
            $section->update([
                'name' => $this->name,
                'icon' => $this->icon,
                'description' => $this->description,
                'form_section_id' => $this->formSectionId,
            ]);
        } else {
            FormSubSection::create([
                'name' => $this->name,
                'icon' => $this->icon,
                'description' => $this->description,
                'form_section_id' => $this->formSectionId,
            ]);
        }

        $this->dispatch('refresh-sub-section');

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.form-builder.modals.sub-section-modal');
    }
}
