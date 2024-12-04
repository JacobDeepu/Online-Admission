<?php

namespace App\Livewire\FormBuilder;

use Livewire\Component;

class FieldComponent extends Component
{
    public $field;

    public function delete()
    {
        $this->field->delete();
        session()->flash('status', 'Field Deleted Successfully.');
        $this->redirectRoute('form-builder.index');
    }

    public function render()
    {
        return view('livewire.form-builder.field-component');
    }
}
