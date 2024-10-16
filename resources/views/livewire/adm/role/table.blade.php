<div>
    <section class="p-1 lg:p-5">
        <div class="flex justify-end items-center">
            @permission(['role_create'])
            <x-button
                wire:click="openModal('adm.role.form', { title: 'Cadastro de grupo de permissão' })"
                label="Cadastrar"
                icon="add"
                class="bg-success mt-1 text-white"
            />
            @endpermission
        </div>
        <div class="md:flex md:items-end md:justify-between">
            <div class="md:flex md:items-end md:justify-start gap-x-3">
                <div class="flex flex-col gap-y-1">
                    <span class="w-max px-3 py-1 text-xs text-blue-600 bg-blue-100 rounded-full dark:bg-gray-800 dark:text-blue-400">
                        {{ $permissions->total() }} Grupos
                    </span>
                    <div class="relative flex items-center mt-4 md:mt-0">
                        <span class="absolute right-0">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-5 h-5 mx-3 text-gray-400 dark:text-gray-600"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"
                                />
                            </svg>
                        </span>
                        <input
                            wire:model="search"
                            type="text"
                            placeholder="Search"
                            class="block w-full py-1.5 pr-5 text-gray-700 bg-white border border-gray-200 rounded-lg md:w-80 placeholder-gray-400/70 rtl:pr-11 rtl:pl-5 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40"
                        />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="w-full overflow-x-auto px-1 lg:px-5">
        <div class="shadow-lg">
            <table class="w-full text-left">
                <thead>
                <tr>
                    <th scope="col" class="px-4 py-2">Nome</th>
                    @permission(['role_edit', 'role_view', 'role_delete'])
                    <th scope="col" class="px-4 py-2">Ações</th>
                    @endpermission
                </tr>
                </thead>
                <tbody>
                @foreach($permissions as $permission)
                    <tr>
                        <td class="px-4 py-2">{{ $permission->name }}</td>
                        @permission(['role_edit', 'role_view', 'role_delete'])
                        <td class="px-4 py-2 flex gap-x-2">
                            @permission(['role_edit'])
                            <x-button-icon
                                classTxt="text-white bg-black"
                                classIcon="text-black"
                                wire:click="openModal('adm.role.form', { id: {{ $permission->id }}, title: 'Editar permissão' })"
                                class="bg-[#FDC14A] text-black"
                                icon="edit"
                                label="Editar"
                            />
                            @endpermission
                            @permission(['role_view'])
                            <x-button-icon
                                classTxt="text-white bg-black"
                                classIcon="text-black"
                                wire:click="openModal('adm.role.permission.form', { id: {{ $permission->id }}, title: 'Editar permissão' })"
                                class="bg-[#FDC14A] text-black"
                                icon="edit"
                                label="Permissões"
                            />
                            @endpermission
                            @permission(['role_delete'])
                            <x-button-icon
                                classTxt="text-black bg-amber-400"
                                classIcon="text-amber-400"
                                wire:click="destroy({{ $permission->id }})"
                                class="bg-danger text-black"
                                icon="delete_amber"
                                label="Deletar"
                            />
                            @endpermission
                        </td>
                        @endpermission
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <section class="p-1 lg:p-5 flex justify-center md:justify-between items-end">
        <div class="w-full">
            {{ $permissions->links() }}
        </div>
    </section>
</div>
