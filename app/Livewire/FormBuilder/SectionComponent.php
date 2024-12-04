<?php

namespace App\Livewire\FormBuilder;

use App\Models\FormSection;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Attributes\On;
use Livewire\Component;

class SectionComponent extends Component
{
    use InteractsWithBanner;

    public $section;

    #[On('refresh-section')]
    public function loadSubSections()
    {
        $this->section->load('subSections.fields');
    }

    #[On('refresh-section.{section.id}')]
    public function refreshSection()
    {
        $this->section = FormSection::find($this->section->id);
        $this->section->load('subSections.fields');
    }

    public function delete()
    {
        $this->section->fields()->delete();
        $this->section->delete();
        session()->flash('status', 'Section Deleted Successfully.');
        $this->redirectRoute('form-builder.index');
    }

    public function render()
    {
        return view('livewire.form-builder.section-component');
    }
}
