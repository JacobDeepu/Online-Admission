<div class="relative border-b border-gray-200">
    <div class="flex items-center justify-between border-b px-8 py-6">
        <h4 class="text-xl font-semibold">{{ $section->name }}</h4>
        <div class="space-x-2">
            <button class="inline-flex items-center gap-2 rounded-lg bg-indigo-50 px-4 py-2 text-indigo-600 duration-150 hover:bg-indigo-100 active:bg-indigo-200"
                wire:click="$dispatch('open-sub-section-modal', {formSectionId: {{ $section->id }}})">
                <i class="ph-bold ph-plus"></i>
                Sub Section
            </button>
            <button class="inline-flex items-center gap-2 rounded-lg bg-indigo-50 px-4 py-2 text-indigo-600 duration-150 hover:bg-indigo-100 active:bg-indigo-200"
                wire:click="$dispatch('open-field-modal', {formableId: {{ $section->id }},formableType: 'section'})">
                <i class="ph-bold ph-plus"></i>
                Field
            </button>
            <button class="inline-flex items-center gap-2 rounded-lg bg-indigo-50 px-4 py-2 text-indigo-600 duration-150 hover:bg-indigo-100 active:bg-indigo-200"
                wire:click="$dispatch('open-section-modal', {section: {{ $section->id }}})">
                <i class="ph-bold ph-pencil-simple-line"></i>
                Edit
            </button>
            <button class="inline-flex items-center gap-2 rounded-lg bg-red-50 px-4 py-2 text-red-600 duration-150 hover:bg-red-100 active:bg-red-200" wire:click="delete"
                wire:confirm="Are you sure you want to delete this field?">
                <i class="ph-bold ph-trash text-lg"></i>
                Delete
            </button>
            <button class="w-16" type="button" @click="selected !== {{ $section->id }} ? selected = {{ $section->id }} : selected = null">
                <i class="ph-bold ph-caret-double-down"></i>
            </button>
        </div>
    </div>
    <div class="relative max-h-0 overflow-y-scroll transition-all duration-700" style="" x-ref="container{{ $section->id }}"
        x-bind:style="selected == {{ $section->id }} ? 'max-height: ' + $refs.container{{ $section->id }}.scrollHeight + 'px' : ''">
        <div class="m-4 space-y-4 rounded-lg border-2 border-indigo-600" x-data="{ selected: null }">
            @if ($section->subSections->isNotEmpty())
                @foreach ($section->subSections as $subSection)
                    <livewire:form-builder.sub-section-component :$subSection :key="$subSection->id" />
                @endforeach
            @else
                <div class="px-6 py-4 font-medium text-gray-900">
                    {{ __('No Sub Sections Found') }}
                </div>
            @endif
        </div>
        <div class="m-4 space-y-4 rounded-lg border-2 border-indigo-600 py-4">
            @if ($section->fields->isNotEmpty())
                @foreach ($section->fields as $field)
                    <livewire:form-builder.field-component :$field :key="$field->id" />
                @endforeach
            @else
                <div class="px-6 py-4 font-medium text-gray-900">
                    {{ __('No Fields Found') }}
                </div>
            @endif
        </div>
    </div>
</div>
