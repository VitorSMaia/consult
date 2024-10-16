<div>
    @if($showToast)
        <div x-data="{ open: @entangle('showToast') }" class="fixed duration-1000 top-10 right-10 z-50 overflow-x-hidden">
            <div x-show="open"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-90"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-90"
                 id="toast-default"
                 class="flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow-xl border border-b-2 border-gray-300 dark:text-gray-400 dark:bg-gray-800"
                 role="alert">
                <div
                        class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-black {{$color}} rounded-lg">
                    <img src="{{ asset('./icons/info.svg') }}" alt="info">
                </div>
                <div class="ml-3 mr-3 text-sm font-normal">{{ $this->message }}</div>
                <button wire:click="$set('showToast', {{ !$this->showToast }})" type="button" class=" ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-collapse-toggle="toast-default" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
        </div>
    @endif
    <script>
        document.addEventListener("DOMContentLoaded", () => {

            Livewire.hook('element.updating', (el, component) => {
                var someValue = @this.showToast;

                if(someValue) {
                    setTimeout(() => {
                        @this.showToast = false;
                    }, 2000);
                }
            })

        });
    </script>
</div>
