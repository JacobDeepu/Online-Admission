<?php

namespace App\Livewire\FormBuilder\Modals;

use App\Models\FormSection;
use App\Models\Institution;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SectionModal extends Component
{
    public $isOpen = false;

    public $section;

    #[Locked]
    public $institutionId;

    #[Validate('required|string|max:255')]
    public $name;

    #[Validate('nullable|string|max:255')]
    public $icon;

    #[Validate('nullable|string|max:255')]
    public $description;

    public function mount($institutionId)
    {
        $this->institutionId = $institutionId;
    }

    #[Computed()]
    public function institution()
    {
        return Institution::find($this->institutionId);
    }

    #[On('open-section-modal')]
    public function open($section = null)
    {
        $this->institutionId = $this->pull('institutionId');

        if ($section) {
            $this->section = FormSection::find($section);
            $this->name = $this->section->name;
            $this->icon = $this->section->icon;
            $this->description = $this->section->description;
        }

        $this->isOpen = true;
    }

    public function close()
    {
        $this->isOpen = false;
    }

    public function create()
    {
        $this->institution->sections()->create([
            'name' => $this->name,
            'icon' => $this->icon,
            'description' => $this->description,
        ]);

        $this->dispatch('refresh-form-builder');
    }

    public function update()
    {
        $this->section->update([
            'name' => $this->name,
            'icon' => $this->icon,
            'description' => $this->description,
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
        return view('livewire.form-builder.modals.section-modal');
    }
}
