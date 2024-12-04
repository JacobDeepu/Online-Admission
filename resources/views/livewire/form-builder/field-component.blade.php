<div class="mx-4 rounded-lg border-2 border-gray-200 p-4">
    <div class="grid gap-4 sm:grid-cols-3">
        <div class="mt-0">
            <x-input-float-label class="block w-full" name="name" type="text" value="{{ $field->name }}" label="{{ __('Field Identifier') }}" readonly />
        </div>
        <div class="mt-0">
            <x-input-float-label class="block w-full" name="label" type="text" value="{{ $field->label }}" label="{{ __('Field Label') }}" readonly />
        </div>
        <div class="mt-0">
            <x-input-float-label class="block w-full" name="label" type="text" value="{{ $field->type }}" label="{{ __('Field Label') }}" readonly />
        </div>
        <div class="mt-0">
            <x-input-float-label class="block w-full" name="options" type="text" value="{{ is_array($field->options) ? implode(',', $field->options) : $field->options }}"
                label="{{ __('Field Options') }}" readonly />
        </div>
        <div class="mt-0">
            <x-input-float-label class="block w-full" name="validation_rules" type="text" value="{{ $field->validation_rules }}" label="{{ __('Validation Rules') }}" readonly />
        </div>
        <div class="mt-0 flex items-center justify-between gap-2">
            <div class="inline-flex">
                <label class="text-md me-2 font-medium text-gray-700" for="isRequired">Required</label>
                <input
                    class="before:size-6 relative h-7 w-[3.25rem] cursor-pointer rounded-full border-transparent bg-gray-100 p-px text-transparent transition-colors duration-200 ease-in-out before:inline-block before:translate-x-0 before:transform before:rounded-full before:bg-white before:shadow before:ring-0 before:transition before:duration-200 before:ease-in-out checked:border-blue-600 checked:bg-none checked:text-blue-600 checked:before:translate-x-full checked:before:bg-blue-200 focus:ring-blue-600 focus:checked:border-blue-600 disabled:pointer-events-none disabled:opacity-50"
                    name="isRequired" type="checkbox" @checked($field->is_required) disabled />
            </div>
            <div class="space-x-2">
                <button class="inline-flex items-center gap-2 rounded-lg bg-indigo-50 px-4 py-2 text-indigo-600 duration-150 hover:bg-indigo-100 active:bg-indigo-200"
                    wire:click="$dispatch('open-field-modal', {field: {{ $field->id }}})">
                    <i class="ph-bold ph-pencil-simple-line"></i>
                    Edit
                </button>
                <button class="inline-flex items-center gap-2 rounded-lg bg-red-50 px-4 py-2 text-red-600 duration-150 hover:bg-red-100 active:bg-red-200" wire:click="delete"
                    wire:confirm="Are you sure you want to delete this field?">
                    <i class="ph-bold ph-trash text-lg"></i>
                    Delete
                </button>
            </div>
        </div>
    </div>
</div>
