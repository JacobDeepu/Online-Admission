<?php

namespace App\Livewire\FormBuilder;

use Livewire\Attributes\On;
use Livewire\Component;

class FormBuilder extends Component
{
    public $institution;

    public $sections;

    public function mount($institution)
    {
        $this->institution = $institution;
        $this->loadSections();
    }

    #[On('refresh-form-builder')]
    public function loadSections()
    {
        $this->sections = $this->institution->sections->load(['subSections', 'fields']);
    }

    public function render()
    {
        return view('livewire.form-builder.form-builder');
    }
}
