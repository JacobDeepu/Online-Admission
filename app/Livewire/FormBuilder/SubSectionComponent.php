<?php

namespace App\Livewire\FormBuilder;

use Livewire\Component;

class SubSectionComponent extends Component
{
    public $subSection;

    public function delete()
    {
        $this->subSection->fields()->delete();
        $this->subSection->delete();
        session()->flash('status', 'Sub Section Deleted Successfully.');
        $this->redirectRoute('form-builder.index');
    }

    public function render()
    {
        return view('livewire.form-builder.sub-section-component');
    }
}
