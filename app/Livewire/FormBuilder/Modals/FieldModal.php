<?php

namespace App\Livewire\FormBuilder\Modals;

use App\Models\FormField;
use App\Models\FormSection;
use App\Models\FormSubSection;
use Illuminate\Validation\Rule;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class FieldModal extends Component
{
    use InteractsWithBanner;

    public $isOpen = false;

    public $field;

    public $formableId = null;

    public $formableType = null;

    public $isRequired = false;

    #[Validate]
    public $name;

    #[Validate('required|string|max:255')]
    public $label;

    #[Validate('required|string|in:text,number,date,email,textarea,select,radio,checkbox|max:255')]
    public $type;

    #[Validate('nullable|string|max:255')]
    public $options;

    #[Validate('nullable|string|max:255')]
    public $validationRules = 'required|string|max:255';

    public function updatedLabel()
    {
        $this->name = strtolower(str_replace(' ', '_', $this->label));
    }

    protected function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('form_fields', 'name')->ignore($this->field),
            ],
        ];
    }

    #[On('open-field-modal')]
    public function openModal($field = null, $formableId = null, $formableType = null)
    {
        $this->reset();

        if ($formableId && $formableType) {
            $this->formableId = $formableId;

            $this->formableType = $formableType == 'section' ? FormSection::class : FormSubSection::class;
        } else {
            $this->field = FormField::find($field);
            $this->name = $this->field->name;
            $this->label = $this->field->label;
            $this->type = $this->field->type;
            $this->options = implode(',', $this->field->options);
            $this->isRequired = $this->field->is_required;
            $this->validationRules = $this->field->validation_rules;
        }

        $this->isOpen = true;
    }

    public function close()
    {
        $this->isOpen = false;
    }

    public function create()
    {
        FormField::create([
            'name' => $this->name,
            'label' => $this->label,
            'type' => $this->type,
            'options' => explode(',', $this->options),
            'is_required' => $this->isRequired,
            'validation_rules' => $this->validationRules,
            'formable_id' => $this->formableId,
            'formable_type' => $this->formableType,
        ]);
        $this->banner('Field Created Successfully!');
    }

    public function update()
    {
        $this->field->update([
            'name' => $this->name,
            'label' => $this->label,
            'type' => $this->type,
            'options' => explode(',', $this->options),
            'is_required' => $this->isRequired,
            'validation_rules' => $this->validationRules,
        ]);
        $this->banner('Field Updated Successfully!');
    }

    public function save()
    {
        $this->validate();

        $this->field ? $this->update() : $this->create();

        $this->dispatch('refresh-section');

        $this->close();
    }

    public function render()
    {
        return view('livewire.form-builder.modals.field-modal');
    }
}
