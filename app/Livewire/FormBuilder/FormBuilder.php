<?php

namespace App\Livewire\FormBuilder;

use App\Models\FormSection;
use Livewire\Attributes\On;
use Livewire\Component;

class FormBuilder extends Component
{
    public $sections;

    public function mount()
    {
        $this->loadSections();
    }

    #[On('refresh-form-builder')]
    public function loadSections()
    {
        $this->sections = FormSection::with(['subSections', 'fields'])->get();
    }

    public function render()
    {
        return view('livewire.form-builder.form-builder');
    }
}
