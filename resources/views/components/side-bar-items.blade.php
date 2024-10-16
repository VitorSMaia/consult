<nav class="flex-1 space-y-1 px-2 py-4">
    <a  href="{{ route('dashboard') }}" wire:navigate class="{{ request()->routeIs('dashboard') ? "bg-gray-900 text-white w-60" : "text-black" }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
        <svg class="mr-3 flex-shrink-0 h-6 w-6" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="{{ request()->routeIs('dashboard') ? 'white' : 'black' }}"><path d="M80-120v-80h800v80H80Zm40-120v-280h120v280H120Zm200 0v-480h120v480H320Zm200 0v-360h120v360H520Zm200 0v-600h120v600H720Z"/></svg>
        Dashboard
    </a>
    @permission(['user_view','role_view'])
        @permission(['role_view'])
            <a  href="{{ route('admRole') }}" wire:navigate class="{{ request()->routeIs('admRole') ? "bg-gray-900 text-white w-60" : "text-black" }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                <svg class="mr-3 flex-shrink-0 h-6 w-6" xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="{{ request()->routeIs('admRole') ? 'white' : 'black' }}"><path d="M482-244.67q17.67 0 29.83-12.16Q524-269 524-286.67q0-17.66-12.17-29.83-12.16-12.17-29.83-12.17-17.67 0-29.83 12.17Q440-304.33 440-286.67q0 17.67 12.17 29.84 12.16 12.16 29.83 12.16Zm-35.33-148.66h64q0-28.34 6.83-49 6.83-20.67 41.17-50.34 29.33-26 43-50.5 13.66-24.5 13.66-55.5 0-54-36.66-85.33-36.67-31.33-93.34-31.33-51.66 0-88.5 26.33Q360-662.67 344-620l57.33 22q9-24.67 29.5-42t52.5-17.33q33.34 0 52.67 18.16 19.33 18.17 19.33 44.5 0 21.34-12.66 40.17-12.67 18.83-35.34 37.83-34.66 30.34-47.66 54-13 23.67-13 69.34ZM480-80q-82.33 0-155.33-31.5-73-31.5-127.34-85.83Q143-251.67 111.5-324.67T80-480q0-83 31.5-156t85.83-127q54.34-54 127.34-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 82.33-31.5 155.33-31.5 73-85.5 127.34Q709-143 636-111.5T480-80Zm0-66.67q139.33 0 236.33-97.33t97-236q0-139.33-97-236.33t-236.33-97q-138.67 0-236 97-97.33 97-97.33 236.33 0 138.67 97.33 236 97.33 97.33 236 97.33ZM480-480Z"/></svg>
                Permissões
            </a>
        @endpermission

        @permission(['user_view'])
            <a  href="{{ route('admUser') }}" wire:navigate class="{{ request()->routeIs('admUser') ? "bg-gray-900 text-white w-60" : "text-black" }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 flex-shrink-0 h-6 w-6" height="24px" viewBox="0 -960 960 960" width="24px" fill="{{ request()->routeIs('admUser') ? 'white' : 'black' }}"><path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z"/></svg>
                Usuários
            </a>
        @endpermission
    @endpermission
</nav>