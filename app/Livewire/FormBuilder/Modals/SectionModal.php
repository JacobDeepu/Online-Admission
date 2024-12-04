<?php

namespace App\Livewire\FormBuilder\Modals;

use App\Models\FormSection;
use App\Models\Institution;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SectionModal extends Component
{
    public $isOpen = false;

    public $section;

    #[Validate('required|string|max:255')]
    public $name;

    #[Validate('nullable|string|max:255')]
    public $icon;

    #[Validate('nullable|string|max:255')]
    public $description;

    #[Validate('required|exists:institutions,id')]
    public $institutionId;

    #[On('open-section-modal')]
    public function open($section = null)
    {
        $this->reset();

        if ($section) {
            $this->section = FormSection::find($section);
            $this->name = $this->section->name;
            $this->icon = $this->section->icon;
            $this->description = $this->section->description;
            $this->institutionId = $this->section->institution_id;
        }

        $this->isOpen = true;
    }

    public function close()
    {
        $this->isOpen = false;
    }

    public function create()
    {
        FormSection::create([
            'name' => $this->name,
            'icon' => $this->icon,
            'description' => $this->description,
            'institution_id' => $this->institutionId,
        ]);

        $this->dispatch('refresh-form-builder');
    }

    public function update()
    {
        $this->section->update([
            'name' => $this->name,
            'icon' => $this->icon,
            'description' => $this->description,
            'institution_id' => $this->institutionId,
        ]);

        $this->dispatch('refresh-section.{$this->section->id}');
    }

    public function save()
    {
        $this->validate();

        $this->section ? $this->update() : $this->create();

        $this->close();
    }

    public function render()
    {
        $institutions = Institution::all();

        return view('livewire.form-builder.modals.section-modal', compact('institutions'));
    }
}
