<x-dialog-modal wire:model="isOpen">
    <x-slot name="title">
        {{ __('Add Sub Section') }}
    </x-slot>

    <x-slot name="content">
        <div class="grid gap-4 sm:grid-cols-2">
            <div class="mt-0">
                <x-input-float-label class="block w-full" name="name" type="text" wire:model="name" label="{{ __('Name') }}" />
            </div>
            <div class="mt-0">
                <x-input-float-label class="block w-full" name="icon" type="text" wire:model="icon" label="{{ __('Icon') }}" />
            </div>
            <div class="mt-0 sm:col-span-2">
                <x-input-float-label class="block w-full" name="description" type="text" wire:model="description" label="{{ __('Description') }}" />
            </div>
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="closeModal">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-button class="ml-3" wire:click="save">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-dialog-modal>
