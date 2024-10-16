<div
    x-show="menuVisibility"
    class="relative z-40 md:hidden" role="dialog" aria-modal="true">

    <div
        x-show="menuVisibility"
        @click="menuVisibility = false"
        x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-gray-600 bg-opacity-75"></div>

    <div class="fixed inset-0 z-40 flex">

        <div
            x-show="menuVisibility"
            @click.outside="menuVisibility = false"
            x-transition:enter="transition ease-in-out transform duration-300"
            x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in-out transform duration-300"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            class="relative flex w-full max-w-xs flex-1 flex-col bg-white pt-5 pb-4">
            <div
                x-show="menuVisibility"
                x-transition:enter="transition-opacity ease-linear duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-linear duration-300"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="absolute top-0 right-0 -mr-12 pt-2">
                <button
                    @click="menuVisibility = false"
                    type="button"
                    class="ml-1 flex h-10 w-10 items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                >
                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="h-20 w-44">
                <x-logo />
            </div>

            <div class="mt-5 h-full flex flex-col justify-between items-start overflow-y-auto">
                <x-side-bar-items />

                <a  href="{{ route('profile') }}" wire:navigate class="{{ request()->routeIs('profile') ? "bg-gray-900 text-white w-60" : "text-black" }} group flex items-center mx-2 px-2 py-2 text-sm font-medium rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 flex-shrink-0 h-6 w-6" height="24px" viewBox="0 -960 960 960" width="24px" fill="{{ request()->routeIs('profile') ? 'white' : 'black' }}"><path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z"/></svg>
                    Perfil
                </a>
                <form class="group flex items-center mx-2 px-2 py-2 text-sm font-medium rounded-md" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="flex items-center">
                        <img src="{{ asset('./icons/logout.svg') }}" class="text-white mr-3 flex-shrink-0 h-6 w-6" alt="logout">

                        Sair
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="hidden md:fixed md:inset-y-0 md:flex md:w-64 md:flex-col">
    <div class="flex min-h-0 flex-1 flex-col bg-gray-800">

        <div class="flex flex-shrink-0 items-center px-4 py-4">
            <x-logo/>
        </div>

        <div class="flex flex-1 flex-col overflow-y-auto">
            <x-side-bar-items />
        </div>
    </div>
</div>