<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Create Role') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="relative overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">
                <x-validation-errors class="m-4" />
                <form class="p-4" method="POST" action="{{ route('roles.store') }}">
                    @csrf
                    <div>
                        <x-label for="name" value="{{ __('Name') }}" />
                        <x-input class="mt-1 block w-full" id="name" name="name" type="text" :value="old('name')" required autofocus autocomplete="name" />
                    </div>
                    <h3 class="inline-flex py-4 text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">Permissions</h3>
                    <div class="grid grid-cols-4 gap-4">
                        @forelse ($permissions as $permission)
                            <label class="inline-flex" for="permissions">
                                <x-checkbox name="permissions[]" value="{{ $permission->name }}" />
                                <span class="ml-2 text-sm text-gray-600 dark:text-gray-300">{{ __($permission->name) }}</span>
                            </label>
                        @empty
                            {{ __('No Permissions Found') }}
                        @endforelse
                    </div>
                    <div class="mt-4 flex">
                        <x-button>
                            {{ __('Save') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
