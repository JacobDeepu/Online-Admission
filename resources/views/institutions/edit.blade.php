<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Update Role') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="relative overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">
                <x-validation-errors class="m-4" />
                <form class="p-4" method="POST" action="{{ route('institutions.update', $institution) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4 grid gap-4 sm:grid-cols-2">
                        <div class="row-span-2 flex flex-col items-center justify-end" x-data="{ logoName: null, logoPreview: '{{ old('logo_file_path', $institution->logo_url) }}' }">
                            <input class="hidden" id="logo_file_path" name="logo_file_path" type="file" x-ref="logo"
                                x-on:change="logoName = $refs.logo.files[0].name;
                                                    const reader = new FileReader();
                                                    reader.onload = (e) => {
                                                        logoPreview = e.target.result;
                                                    };
                                                    reader.readAsDataURL($refs.logo.files[0]);
                                            " />
                            <div class="mt-2" style="display: none;" x-show="logoPreview">
                                <span class="block h-36 w-full bg-cover bg-center bg-no-repeat" x-bind:style="'background-image: url(\'' + logoPreview + '\');'">
                                </span>
                            </div>
                            <button
                                class="me-2 mt-2 inline-flex items-center rounded-md border border-indigo-600 bg-indigo-700 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white shadow-sm transition duration-150 ease-in-out hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25"
                                type="button" type="button" x-on:click.prevent="$refs.logo.click()">
                                {{ __('Select A Logo') }}
                            </button>
                            @error('logo_file_path')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row-span-2 flex flex-col items-center justify-end" x-data="{ headerName: null, headerPreview: '{{ old('header_file_path', $institution->header_url) }}' }">
                            <input class="hidden" id="header_file_path" name="header_file_path" type="file" x-ref="header"
                                x-on:change="headerName = $refs.header.files[0].name;
                                                    const reader = new FileReader();
                                                    reader.onload = (e) => {
                                                        headerPreview = e.target.result;
                                                    };
                                                    reader.readAsDataURL($refs.header.files[0]);
                                            " />
                            <div class="mt-2" style="display: none;" x-show="headerPreview">
                                <span class="block h-36 w-full bg-cover bg-center bg-no-repeat" x-bind:style="'background-image: url(\'' + headerPreview + '\');'">
                                </span>
                            </div>
                            <button
                                class="me-2 mt-2 inline-flex items-center rounded-md border border-indigo-600 bg-indigo-700 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white shadow-sm transition duration-150 ease-in-out hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25"
                                type="button" type="button" x-on:click.prevent="$refs.header.click()">
                                {{ __('Select A Header') }}
                            </button>
                            @error('header_file_path')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <x-label for="name" value="{{ __('Name') }}" />
                            <x-input class="mt-1 block w-full" id="name" name="name" type="text" :value="old('name', $institution->name)" required />
                        </div>
                        <div>
                            <x-label for="name" value="{{ __('Code') }}" />
                            <x-input class="mt-1 block w-full" id="code" name="code" type="text" :value="old('code', $institution->code)" required />
                        </div>
                        <div>
                            <x-label for="name" value="{{ __('Email') }}" />
                            <x-input class="mt-1 block w-full" id="email" name="email" type="email" :value="old('email', $institution->email)" required />
                        </div>
                        <div>
                            <x-label for="name" value="{{ __('Phone') }}" />
                            <x-input class="mt-1 block w-full" id="phone" name="phone" type="text" :value="old('phone', $institution->phone)" required />
                        </div>
                        <div>
                            <x-label for="name" value="{{ __('Color Code') }}" />
                            <x-input class="mt-1 block w-full" id="color_code" name="color_code" type="text" :value="old('color_code', $institution->color_code)" required />
                        </div>
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
