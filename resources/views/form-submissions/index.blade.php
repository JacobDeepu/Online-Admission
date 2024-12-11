<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Form Submissions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto bg-white p-4 shadow-xl dark:bg-gray-800 sm:rounded-lg">
                <livewire:form-submissions-table />
            </div>
        </div>
    </div>
</x-app-layout>
