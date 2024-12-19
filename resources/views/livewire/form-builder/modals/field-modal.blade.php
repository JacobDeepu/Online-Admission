<x-dialog-modal wire:model="isOpen">
    <x-slot name="title">
        {{ __('Add Field') }}
    </x-slot>

    <x-slot name="content">
        <div class="grid gap-4 sm:grid-cols-2">
            <div class="mt-0">
                <x-input-float-label class="block w-full" name="label" type="text" wire:model.blur="label" label="{{ __('Field Label') }}" />
            </div>
            <div class="mt-0">
                <x-input-float-label class="block w-full" name="name" type="text" wire:model="name" label="{{ __('Field Identifier') }}" />
            </div>
            <div class="mt-0">
                <x-select class="block w-full" name="type" wire:model="type" label="{{ __('Field Type') }}">
                    <option value="">Select Field Type</option>
                    <option value="text">Text</option>
                    <option value="number">Number</option>
                    <option value="date">Date</option>
                    <option value="email">Email</option>
                    <option value="textarea">Textarea</option>
                    <option value="select">Select</option>
                    <option value="radio">Radio</option>
                    <option value="checkbox">Checkbox</option>
                </x-select>
            </div>
            <div class="mt-0">
                <x-input-float-label class="block w-full" name="options" type="text" wire:model="options" label="{{ __('Field Options') }}" />
            </div>
            <div class="mt-0">
                <div class="inline-flex">
                    <label class="text-sm font-medium text-gray-500" for="isRequired">Required</label>
                    <input
                        class="before:size-6 relative h-7 w-[3.25rem] cursor-pointer rounded-full border-transparent bg-gray-100 p-px text-transparent transition-colors duration-200 ease-in-out before:inline-block before:translate-x-0 before:transform before:rounded-full before:bg-white before:shadow before:ring-0 before:transition before:duration-200 before:ease-in-out checked:border-blue-600 checked:bg-none checked:text-blue-600 checked:before:translate-x-full checked:before:bg-blue-200 focus:ring-blue-600 focus:checked:border-blue-600 disabled:pointer-events-none disabled:opacity-50"
                        name="isRequired" type="checkbox" wire:model.blur="isRequired" />
                </div>
            </div>
            <div class="mt-0">
                <x-input-float-label class="block w-full" name="validationRules" type="text" wire:model="validationRules" label="{{ __('Validation Rules') }}" />
            </div>
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="close">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-button class="ml-3" wire:click="save">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-dialog-modal>
