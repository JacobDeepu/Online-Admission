<div x-data="{ currentTab: $wire.entangle('currentTab').live, isSubmitted: $wire.entangle('isSubmitted').live }">
    <div class="px-2">
        <ul class="-mb-px flex flex-wrap text-center text-sm font-medium text-gray-500">
            @foreach ($formSections as $section)
                <li class="mr-2" @click="currentTab = {{ $loop->iteration }}">
                    <button class="group inline-flex items-center justify-center rounded-t-lg border-b-2 p-4"
                        :class="currentTab === {{ $loop->iteration }} ? 'text-{{ $institution->color_code }}-600 border-{{ $institution->color_code }}-600' :
                            'border-transparent hover:text-gray-600 hover:border-gray-300'">
                        <i class="{{ $section->icon }} mr-2 text-xl"
                            :class="currentTab === {{ $loop->iteration }} ? 'text-{{ $institution->color_code }}-600' : 'text-gray-400 group-hover:text-gray-500'"></i>{{ $section->name }}
                    </button>
                </li>
            @endforeach
        </ul>
    </div>
    @if (session('status'))
        <script>
            alert(@js(session('status')))
        </script>
    @endif
    <form wire:submit="submitForm">
        <div class="rounded-lg border-2 border-gray-200 p-5">
            @foreach ($formSections as $section)
                <div class="grid gap-4 sm:grid-cols-12" x-show="currentTab === {{ $loop->iteration }}">
                    @if ($section->subSections->isNotEmpty())
                        @foreach ($section->subSections as $subSection)
                            <div class="bg-{{ $institution->color_code }}-500 mt-0 rounded p-2 sm:col-span-12">
                                <h6 class="text-sm font-medium text-white">
                                    {{ $subSection->name }}
                                </h6>
                            </div>
                            @foreach ($subSection->fields as $field)
                                <x-dynamic-field :field="$field" />
                            @endforeach
                        @endforeach
                    @endif
                    @foreach ($section->fields as $field)
                        <x-dynamic-field :field="$field" />
                    @endforeach
                </div>
            @endforeach
            <div class="mt-4 flex items-center justify-end">
                <x-secondary-button class="ml-4" x-show="currentTab > 1" @click="currentTab--">
                    {{ __('Previous') }}
                </x-secondary-button>
                <x-secondary-button class="ml-4" x-show="currentTab < {{ count($formSections) }}" wire:click="nextSection">
                    {{ __('Next') }}
                </x-secondary-button>
                <x-button class="ml-4" x-show="currentTab === {{ count($formSections) }} && !isSubmitted">
                    {{ __('Submit') }}
                </x-button>
            </div>
        </div>
        <div class="fixed bottom-0 left-0 right-0 top-0 z-50 h-screen w-full flex-col items-center justify-center overflow-hidden bg-gray-700 opacity-75" wire:loading.flex>
            <svg class="fill-{{ $institution->color_code }}-600 mr-2 inline h-24 w-24 animate-spin text-center text-gray-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                <path
                    d="M136,32V64a8,8,0,0,1-16,0V32a8,8,0,0,1,16,0Zm88,88H192a8,8,0,0,0,0,16h32a8,8,0,0,0,0-16Zm-45.09,47.6a8,8,0,0,0-11.31,11.31l22.62,22.63a8,8,0,0,0,11.32-11.32ZM128,184a8,8,0,0,0-8,8v32a8,8,0,0,0,16,0V192A8,8,0,0,0,128,184ZM77.09,167.6,54.46,190.22a8,8,0,0,0,11.32,11.32L88.4,178.91A8,8,0,0,0,77.09,167.6ZM72,128a8,8,0,0,0-8-8H32a8,8,0,0,0,0,16H64A8,8,0,0,0,72,128ZM65.78,54.46A8,8,0,0,0,54.46,65.78L77.09,88.4A8,8,0,0,0,88.4,77.09Z">
                </path>
            </svg>
        </div>
        <x-dialog-modal wire:model="showModal">
            <x-slot name="title">
                Application Successful
            </x-slot>

            <x-slot name="content">
                Application Submitted Successfully. Please check the email. Also Print the Application.
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="download()" wire:loading.attr="disabled">
                    Print
                </x-secondary-button>
            </x-slot>
        </x-dialog-modal>
    </form>
</div>
<script>
    function addFocus(e) {
        e.target.focus();
    }
</script>
