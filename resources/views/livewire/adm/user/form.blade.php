<div>
    <div class="bg-white rounded-lg px-5 py-3 max-w-[930px] overflow-x-hidden">
        <form autocomplete="on" wire:submit.prevent="save"  class="grid grid-cols-12 gap-5 max-h-[600px] md:max-h-[655px]">
            <h1 class="text-xl col-span-12 pb-3">{{ is_null($idUser) ? 'Cadastro de usuário' : 'Edição de usuário' }}</h1>
            <x-text-input class="col-span-12 md:col-span-5" label="Nome" name="name"/>
            <x-text-input-cpf class="col-span-12 md:col-span-4" label="CPF/CNPJ" name="cpf_cnpj"/>
            <x-text-input-phone class="col-span-12 md:col-span-3" label="Telefone" name="phone"/>
            <x-text-input class="col-span-12 md:col-span-6" label="E-mail" type="email" name="email"/>
            <x-text-input class="col-span-12 md:col-span-3" label="Senha" type="password" name="password"/>
            <x-text-input class="col-span-12 md:col-span-3" label="Confirmar senha" type="password" name="password_confirmation"/>
            <x-select class="col-span-12 md:col-span-3" label="Status" name="status">
                <option value="Ativo">Ativo</option>
                <option value="Inativo">Inativo</option>
            </x-select>
            <x-select class="col-span-12 md:col-span-3" label="Empresa" name="company">
                <option value="SP–Arte">SP–Arte</option>
                <option value="Finarte">Finarte</option>
            </x-select>
            <x-text-input class="col-span-12 md:col-span-3" label="Cargo" name="office"/>
            <x-select class="col-span-12 md:col-span-3" label="Permissão" name="permission">
                @foreach($roles as $itemRole)
                    <option value="{{ $itemRole['name'] }}">{{ $itemRole['name'] }}</option>
                @endforeach
            </x-select>
            <button class="col-span-12 text-white cursor-pointer w-max h-10 shadow-lg bg-[#FDC14A] px-2 rounded-lg flex flex-row justify-center items-center" type="submit">Salvar</button>
        </form>
    </div>
</div>
