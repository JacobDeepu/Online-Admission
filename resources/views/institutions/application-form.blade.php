<x-guest-layout>
    <div class="min-h-screen bg-gray-300 bg-hero-bg bg-cover bg-center bg-no-repeat">
        <header class="bg-white shadow">
            <div class="bg-{{ $institution->color_code }}-600">
                <div class="mx-auto max-w-screen-xl px-4 py-3">
                    <div class="flex items-center">
                        <ul class="mr-6 mt-0 flex flex-row space-x-8 text-sm font-medium">
                            <li>
                                <a class="text-sm text-white hover:underline" href="mailto:{{ $institution->email }}">{{ $institution->email }}</a>
                            </li>
                            <li>
                                <a class="text-sm text-white hover:underline" href="tel:{{ $institution->phone }}">{{ $institution->phone }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <nav class="bg-white">
                <div class="mx-auto flex max-w-screen-xl flex-wrap items-center justify-between p-4">
                    <a class="flex items-center" href="/">
                        <img class="mr-3 block h-12 w-auto" src="{{ $institution->logo_url }}" />
                    </a>
                </div>
            </nav>
        </header>
        <main class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <div class="border-b border-gray-200 bg-white p-6 lg:p-8">
                        <h1 class="text-{{ $institution->color_code }}-600 text-center text-4xl font-bold uppercase">
                            Application Form
                        </h1>
                        <livewire:application-form :$institution />
                    </div>
                </div>
            </div>
        </main>
        <!-- Instructions Model -->
        <div x-data="{ modelOpen: {{ session('submissionId') ? 'false' : 'true' }} }">
            <div class="fixed inset-0 z-50 overflow-y-auto" role="dialog" aria-labelledby="modal-title" aria-modal="true" x-show="modelOpen">
                <div class="flex min-h-screen items-end justify-center px-4 text-center sm:block sm:p-0 md:items-center">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-40 transition-opacity" aria-hidden="true" x-cloak x-show="modelOpen"
                        x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>
                    <div class="my-20 inline-block w-full max-w-4xl transform overflow-hidden rounded-lg bg-white p-8 text-left shadow-xl transition-all 2xl:max-w-2xl" x-cloak x-show="modelOpen"
                        x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-200 transform"
                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                        <div class="flex flex-col justify-center text-center">
                            <img src="{{ asset($instructionsPath) }}" alt="Instructions For Filling The Application" width="100%" height="100%">
                            <div class="flex justify-end space-x-2 border-t p-6">
                                <button
                                    class="bg-{{ $institution->color_code }}-500 hover:bg-{{ $institution->color_code }}-600 focus:bg-{{ $institution->color_code }}-500 focus:ring-{{ $institution->color_code }}-300 transform rounded-md px-3 py-2 text-sm capitalize tracking-wide text-white transition-colors duration-200 focus:outline-none focus:ring focus:ring-opacity-50"
                                    @click="modelOpen = false">
                                    Continue
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
