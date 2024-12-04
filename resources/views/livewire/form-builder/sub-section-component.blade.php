<div class="relative">
    <div class="flex items-center justify-between border-b border-indigo-600 px-6 py-4">
        <h4 class="text-lg font-semibold">{{ $subSection->name }}</h4>
        <div class="space-x-2">
            <button class="inline-flex items-center gap-2 rounded-lg bg-indigo-50 px-4 py-2 text-indigo-600 duration-150 hover:bg-indigo-100 active:bg-indigo-200"
                wire:click="$dispatch('open-field-modal', {formableId: {{ $subSection->id }},formableType: 'subsection'})">
                <i class="ph-bold ph-plus"></i>
                Field
            </button>
            <button class="inline-flex items-center gap-2 rounded-lg bg-indigo-50 px-4 py-2 text-indigo-600 duration-150 hover:bg-indigo-100 active:bg-indigo-200"
                wire:click="$dispatch('open-sub-section-modal', {subSection: {{ $subSection }}})">
                <i class="ph-bold ph-pencil-simple-line"></i>
                Edit
            </button>
            <button class="inline-flex items-center gap-2 rounded-lg bg-red-50 px-4 py-2 text-red-600 duration-150 hover:bg-red-100 active:bg-red-200" wire:click="delete"
                wire:confirm="Are you sure you want to delete this section?">
                <i class="ph-bold ph-trash text-lg"></i>
                Delete
            </button>
            <button class="w-16" type="button" @click="selected !== {{ $subSection->id }} ? selected = {{ $subSection->id }} : selected = null">
                <i class="ph-bold ph-caret-double-down"></i>
            </button>
        </div>
    </div>
    <div class="relative max-h-0 overflow-hidden transition-all duration-700" style="" x-ref="container{{ $subSection->id }}"
        x-bind:style="selected == {{ $subSection->id }} ? 'max-height: ' + $refs.container{{ $subSection->id }}.scrollHeight + 'px' : ''">
        <div class="space-y-4 py-4">
            @foreach ($subSection->fields as $field)
                <livewire:form-builder.field-component :field="$field" :key="$field->id" />
            @endforeach
        </div>
    </div>
</div>
