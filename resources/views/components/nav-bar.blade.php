<div class="sticky top-0 z-10 flex h-16 flex-shrink-0 shadow pr-10 {!! session()->get('color')[0] ?? 'bg-white' !!}">
    <button
        @click="menuVisibility=true;"
        type="button"
        class="bo border-gray-200 px-4 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 md:hidden"
    >
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
        </svg>
    </button>
    <div class="flex flex-1 justify-between">
        <div class="w-full md:w-0 flex justify-end md:justify-start items-center md:ml-6">
            <x-logo class="h-10"></x-logo>
        </div>

        <div class="ml-4 hidden md:flex items-center md:ml-6 gap-x-2">
            <a  href="{{ route('dashboard') }}" wire:navigate class="{{ request()->routeIs('dashboard') ? "bg-gray-900 text-white gap-x-1" : "text-black bg-white gap-x-1" }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                <svg width="20" height="17" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2 16H5V10H11V16H14V7L8 2.5L2 7V16ZM0 18V6L8 0L16 6V18H9V12H7V18H0Z" fill="{{ request()->routeIs('dashboard') ? 'white' : 'black' }}"/>
                </svg>
                Dashboard
            </a>
        </div>


        <div class="ml-4 hidden md:flex items-center md:ml-6 z-50">
            <div class="flex sm:items-center sm:ml-6">
                @permission(['meeting_rooms_view'])
                    <div class="ml-4 hidden md:flex items-center md:ml-6 gap-x-2">
                        <a  href="{{ route('admMeeting') }}" wire:navigate class="{{ request()->routeIs('admMeeting') ? "bg-gray-900 text-white gap-x-1" : "text-black bg-white gap-x-1" }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                            <svg width="20" height="17" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 16H5V10H11V16H14V7L8 2.5L2 7V16ZM0 18V6L8 0L16 6V18H9V12H7V18H0Z" fill="{{ request()->routeIs('admMeeting') ? 'white' : 'black' }}"/>
                            </svg>
                            Salas de Reunião
                        </a>
                    </div>
                @endpermission

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150"
                        >

                            <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.85 10L3.55 8.5C3.35 8.41667 3.1625 8.32917 2.9875 8.2375C2.8125 8.14583 2.63333 8.03333 2.45 7.9L1 8.35L0 6.65L1.15 5.65C1.11667 5.43333 1.1 5.21667 1.1 5C1.1 4.78333 1.11667 4.56667 1.15 4.35L0 3.35L1 1.65L2.45 2.1C2.63333 1.96667 2.8125 1.85417 2.9875 1.7625C3.1625 1.67083 3.35 1.58333 3.55 1.5L3.85 0H5.85L6.15 1.5C6.35 1.58333 6.5375 1.67083 6.7125 1.7625C6.8875 1.85417 7.06667 1.96667 7.25 2.1L8.7 1.65L9.7 3.35L8.55 4.35C8.58333 4.56667 8.6 4.78333 8.6 5C8.6 5.21667 8.58333 5.43333 8.55 5.65L9.7 6.65L8.7 8.35L7.25 7.9C7.06667 8.03333 6.8875 8.14583 6.7125 8.2375C6.5375 8.32917 6.35 8.41667 6.15 8.5L5.85 10H3.85ZM4.85 7C5.4 7 5.87083 6.80417 6.2625 6.4125C6.65417 6.02083 6.85 5.55 6.85 5C6.85 4.45 6.65417 3.97917 6.2625 3.5875C5.87083 3.19583 5.4 3 4.85 3C4.3 3 3.82917 3.19583 3.4375 3.5875C3.04583 3.97917 2.85 4.45 2.85 5C2.85 5.55 3.04583 6.02083 3.4375 6.4125C3.82917 6.80417 4.3 7 4.85 7ZM12.8 21L12.35 18.9C12.0667 18.8 11.8042 18.6792 11.5625 18.5375C11.3208 18.3958 11.0833 18.2333 10.85 18.05L8.85 18.7L7.45 16.3L9.05 14.9C9.01667 14.6 9 14.3 9 14C9 13.7 9.01667 13.4 9.05 13.1L7.45 11.7L8.85 9.3L10.85 9.95C11.0833 9.76667 11.3208 9.60417 11.5625 9.4625C11.8042 9.32083 12.0667 9.2 12.35 9.1L12.8 7H15.6L16.05 9.1C16.3333 9.2 16.5958 9.32083 16.8375 9.4625C17.0792 9.60417 17.3167 9.76667 17.55 9.95L19.55 9.3L20.95 11.7L19.35 13.1C19.3833 13.4 19.4 13.7 19.4 14C19.4 14.3 19.3833 14.6 19.35 14.9L20.95 16.3L19.55 18.7L17.55 18.05C17.3167 18.2333 17.0792 18.3958 16.8375 18.5375C16.5958 18.6792 16.3333 18.8 16.05 18.9L15.6 21H12.8ZM14.2 17C15.0333 17 15.7417 16.7083 16.325 16.125C16.9083 15.5417 17.2 14.8333 17.2 14C17.2 13.1667 16.9083 12.4583 16.325 11.875C15.7417 11.2917 15.0333 11 14.2 11C13.3667 11 12.6583 11.2917 12.075 11.875C11.4917 12.4583 11.2 13.1667 11.2 14C11.2 14.8333 11.4917 15.5417 12.075 16.125C12.6583 16.7083 13.3667 17 14.2 17Z" fill="black"/>
                            </svg>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>

                        <div class="border-b-2 border-gray-200"></div>
                        <div>
                            @permission(['role_view'])
                            <x-dropdown-link :href="route('admRole')">
                                {{ __('Permissões') }}
                            </x-dropdown-link>
                            @endpermission
                            @permission(['user_view'])
                            <x-dropdown-link :href="route('admUser')">
                                {{ __('Usuários') }}
                            </x-dropdown-link>
                            @endpermission
                        </div>
                    </x-slot>

                </x-dropdown>
            </div>
        </div>
    </div>
</div>