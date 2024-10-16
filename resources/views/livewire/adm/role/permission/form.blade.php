<div>
    <div class="bg-white rounded-lg px-5 py-3 max-w-[930px] overflow-x-hidden mx-auto">
        <form autocomplete="on" wire:submit.prevent="save" class="grid grid-cols-12 gap-5 max-h-[600px] md:max-h-[655px]">
            <h1 class="text-xl col-span-12 pb-3">
                {{ is_null($idRole) ? 'Cadastro de grupo de permissão' : 'Edição de grupo de permissão' }}
            </h1>

            @foreach($groupPermission as $item)
                <div class="col-span-12 lg:col-span-3 w-max p-2 border border-gray-200 rounded-md shadow-sm bg-gray-50">
                    <p class="text-xl font-semibold">{{ $item['name'] }}</p>
                    @foreach($item['permission'] as $itemPermission)
                        <div class="py-2">
                            <x-checkbox
                                class="form-checkbox"
                                label="{{ $itemPermission['label'] }}"
                                name="{{ $itemPermission['name'] }}"
                                wire:model="state.{{ $itemPermission['name'] }}" />
                        </div>
                    @endforeach
                </div>
            @endforeach

            <button
                class="col-span-12 cursor-pointer w-full h-10 shadow-lg bg-[#FDC14A] px-2 py-2 rounded-lg flex justify-center items-center text-white"
                type="submit">
                Salvar
            </button>
        </form>
    </div>
</div>
