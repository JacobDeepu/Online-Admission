@props(['field'])
@switch($field['type'])
    @case('text')
        <div class="mt-0">
            <x-input-float-label class="block w-full" name="formData.{{ $field['name'] }}" type="text" wire:model="formData.{{ $field['name'] }}" label="{{ __($field['label']) }}" @mouseenter="addFocus"
                isRequired="{{ $field['is_required'] }}" />
        </div>
    @break

    @case('email')
        <div class="mt-0">
            <x-input-float-label class="block w-full" name="formData.{{ $field['name'] }}" type="email" wire:model="formData.{{ $field['name'] }}" label="{{ __($field['label']) }}" @mouseenter="addFocus"
                isRequired="{{ $field['is_required'] }}" />
        </div>
    @break

    @case('number')
        <div class="mt-0">
            <x-input-float-label class="block w-full" name="formData.{{ $field['name'] }}" type="number" wire:model="formData.{{ $field['name'] }}" label="{{ __($field['label']) }}" @mouseenter="addFocus"
                isRequired="{{ $field['is_required'] }}" />
        </div>
    @break

    @case('textarea')
        <div class="mt-0">
            <x-textarea-float-label class="block w-full" name="formData.{{ $field['name'] }}" wire:model="formData.{{ $field['name'] }}" label="{{ __($field['label']) }}" @mouseenter="addFocus"
                isRequired="{{ $field['is_required'] }}" />
        </div>
    @break

    @case('date')
        <div class="mt-0">
            <x-input-float-label class="block w-full" name="formData.{{ $field['name'] }}" type="date" wire:model="formData.{{ $field['name'] }}" label="{{ __($field['label']) }}" @mouseenter="addFocus"
                isRequired="{{ $field['is_required'] }}" />
        </div>
    @break

    @case('select')
        <div class="mt-0">
            <x-select class="block w-full" name="formData.{{ $field['name'] }}" wire:model="formData.{{ $field['name'] }}" label="{{ __($field['label']) }}" @mouseenter="addFocus"
                isRequired="{{ $field['is_required'] }}">
                @foreach ($field['options'] as $option)
                    <option value="{{ $option }}">{{ $option }}</option>
                @endforeach
            </x-select>
        </div>
    @break

    @case('checkbox')
        <div class="mt-0">
            <input class="mt-1" id="{{ $field['name'] }}" type="checkbox" wire:model="formData.{{ $field['name'] }}" />
        </div>
    @break

    @case('radio')
        <div class="mt-0">
            @foreach (json_decode($field['options']) as $option)
                <label>
                    <input class="mr-2" type="radio" value="{{ $option }}" wire:model="formData.{{ $field['name'] }}" /> {{ $option }}
                </label>
            @endforeach
        </div>
    @break

    @case('file')
        <div class="mt-0">
            <x-input-file class="block w-full" name="formData.{{ $field['name'] }}" wire:model="formData.{{ $field['name'] }}" label="{{ __($field['label']) }}" isRequired="{{ $field['is_required'] }}" />
        </div>
    @break

@endswitch
