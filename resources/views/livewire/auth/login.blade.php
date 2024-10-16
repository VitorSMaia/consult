<div>
    <div class="sm:mx-auto sm:w-full sm:max-w-md flex flex-col items-center justify-center">
        <a href="{{ route('dashboard') }}">
            <x-logo class="h-20" />
        </a>

        <h2 class="mt-6 text-3xl font-enzo text-center text-gray-900 leading-9">
            Faça login em sua conta
        </h2>
        @if (Route::has('register'))
            <p class="mt-2 text-sm text-center text-gray-600 leading-5 max-w">
                Or
                <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                    Criar uma nova conta
                </a>
            </p>
        @endif
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 overflow-x-hidden mt-10">
        <div class="px-5 lg:px-0 lg:col-start-5 col-span-4">
            <form autocomplete="on" wire:submit.prevent="authenticate" class="bg-white p-10 shadow-xl rounded-lg flex flex-col gap-y-10 w-full">
                <x-text-input label="E-mail" class="col-span-12" type="email" name="email"/>

                <x-text-input label="Senha" class="col-span-12" type="password" name="password"/>

                <div class="flex justify-between items-end">
                    <x-checkbox label="Lembrar-me" name="remember"/>
                    <div class="text-sm leading-5">
                        <a href="{{ route('password.request') }}" class="cursor-pointer font-enzo text-black hover:text-amber-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                            Esqueceu sua senha?
                        </a>
                    </div>
                </div>


                <div class="mt-6">
                    <span class="block w-full rounded-md shadow-sm">
                        <button type="submit" class="flex justify-center w-full px-4 py-2 text-lg font-enzo text-white bg-amber-400 border border-transparent rounded-md hover:bg-amber-500 focus:outline-none focus:border-amber-700 focus:ring-indigo active:bg-amber-700 transition duration-150 ease-in-out">
                            Entrar
                        </button>
                    </span>
                </div>
                <div class="flex justify-between items-end">
                    <div></div>
                    <div class="text-sm leading-5">
                        <p class="font-enzo text-black">
                            Não tem conta? <a class="cursor-pointer font-enzo text-blue-400" href="{{ route('register') }}">inscrever-se</a>
                        </p>
                    </div>
                </div>
                <div class="flex flex-col justify-center items-center">
                    <p class="font-enzo text-lg">Logar com</p>
                    <div >
                        <a href="{!! $url_google !!}">
                            <img class="w-10" src="{{ asset('./icons/logo-google.png') }}"/>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>