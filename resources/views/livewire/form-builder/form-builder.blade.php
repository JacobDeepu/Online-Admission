<div class="relative overflow-x-auto" x-data="{ selected: 1 }">
    @forelse ($sections as $section)
        <livewire:form-builder.section-component :$section :key="$section->id" />
    @empty
        <div class="px-6 py-4 font-medium text-gray-900">
            {{ __('No Forms Found') }}
        </div>
    @endforelse

    <div class="group fixed bottom-10 right-10 flex items-end justify-end p-2">
        <button class="absolute z-50 flex items-center justify-center rounded-full bg-gradient-to-r from-cyan-500 to-blue-500 p-6 text-white shadow-xl" wire:click="$dispatch('open-section-modal')">
            <i class="ph-bold ph-plus transition duration-[0.6s] group-hover:rotate-90"></i>
        </button>
    </div>

    @livewire('form-builder.modals.section-modal', ['institutionId' => $institution->id])
    @livewire('form-builder.modals.sub-section-modal')
    @livewire('form-builder.modals.field-modal')
</div>
