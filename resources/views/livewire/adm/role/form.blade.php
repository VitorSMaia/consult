<div>
    <div class="bg-white rounded-lg px-5 py-3 max-w-[930px] overflow-x-hidden">
        <form autocomplete="on" wire:submit.prevent="save"  class="grid grid-cols-12 gap-5 max-h-[600px] md:max-h-[655px]">
            <h1 class="text-xl col-span-12 pb-3">{{ is_null($idRole) ? 'Cadastro de grupo de permissão' : 'Edição de grupo de permissão' }}</h1>
            <x-text-input label="Role" class="col-span-12" name="name"/>

            <button class="cursor-pointer w-max h-10 shadow-lg bg-[#FDC14A] px-2 rounded-lg flex flex-row justify-center items-center  text-white" type="submit">Salvar</button>
        </form>
    </div>
</div>