<!DOCTYPE html>
<html class="scroll-smooth" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Soluções para o mercado">
    <meta name="author" content="DevTechLoSantos">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url(asset('./img/logo.jpg')) }}">

    <title>{{ config('app.name') }} - Soluções para o mercado</title>

    @vite(['resources/js/app.js', 'resources/sass/app.scss'])
    @livewireStyles
</head>
<body class="bg-gray-600 text-gray-900" >

    <!-- Cabeçalho -->
    <header class="bg-gray-900 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">DevTechLoSantos</h1>
            <nav>
                <ul class="flex space-x-4">
                    <li><a href="#services" class="hover:underline">Serviços</a></li>
                    <li><a href="#examples" class="hover:underline">Exemplos</a></li>
                    <li><a href="#contact" class="hover:underline">Contato</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Seção Hero -->
    <section class="bg-gray-100 text-black text-center p-20">
        <div class="container mx-auto">
            <h2 class="text-4xl font-bold">Bem-vindo à DevTechLoSantos</h2>
            <p class="mt-4 text-lg">Soluções de software sob medida utilizando Laravel, Flutter e NodeJS</p>
            <button class="mt-8 bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Saiba Mais</button>
        </div>
    </section>

    <!-- Seção de Serviços -->
    <section id="services" class="p-10 bg-gray-900">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-left mb-8 text-white">Nossos Serviços</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <article class="text-center p-6 bg-gray-100 rounded shadow-md">
                    <h3 class="text-xl font-bold mb-4">Desenvolvimento Web</h3>
                    <p>Utilizando Laravel para criar aplicações web robustas e escaláveis.</p>
                </article>
                <article class="text-center p-6 bg-gray-100 rounded shadow-md">
                    <h3 class="text-xl font-bold mb-4">Aplicativos Mobile</h3>
                    <p>Desenvolvimento de aplicativos nativos e híbridos utilizando Flutter.</p>
                </article>
                <article class="text-center p-6 bg-gray-100 rounded shadow-md">
                    <h3 class="text-xl font-bold mb-4">Back-end</h3>
                    <p>Criação de APIs e serviços back-end eficientes com NodeJS.</p>
                </article>
            </div>
        </div>
    </section>

    <!-- Seção de Exemplos -->
    <section id="examples" class="bg-gray-100 p-10">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center mb-8">Exemplos de Nossos Projetos</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <article class="bg-white rounded shadow-md overflow-hidden">
                    <img src="{{ asset('./img/website01.webp') }}" alt="Projeto Laravel" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Projeto Web com Laravel</h3>
                        <p>Uma aplicação web completa com autenticação, CRUD e mais.</p>
                    </div>
                </article>
                <article class="bg-white rounded shadow-md overflow-hidden">
                    <img src="{{ asset('./img/website02.webp') }}" alt="Aplicativo Flutter" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Aplicativo Mobile em Flutter</h3>
                        <p>Um aplicativo móvel multiplataforma com design moderno.</p>
                    </div>
                </article>
                <article class="bg-white rounded shadow-md overflow-hidden">
                    <img src="{{ asset('./img/website03.webp') }}" alt="Projeto NodeJS" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Projeto Back-end com NodeJS</h3>
                        <p>APIs rápidas e seguras utilizando NodeJS e Express.</p>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- Seção de Contato -->
    <section id="contact" class="bg-gray-900 text-white p-10">
        <div class="container mx-auto">
            @if(session()->has('messageContactFailed'))
                <div class="bg-red-300 py-2 px-3 border border-red-600 w-max mx-auto rounded-md">
                    {{ session()->get('messageContactFailed') }}
                </div>
            @endif
            <h2 class="text-3xl font-bold text-center mb-8">Entre em Contato</h2>
            <form method="POST" action="{{route('send.contact.form')}}" class="max-w-lg mx-auto">
                @csrf
                @method('POST')
                <div class="mb-4">
                    <x-text-input required="true" label="Nome" type="text" name="name" id="nameID"/>
                </div>
                <div class="mb-4">
                    <x-text-input required="true" label="Email" type="email" name="email" id="emailID"/>
                </div>
                <div class="mb-4">
                    <x-text-input-phone required="true" label="Telefone" type="text" name="phone" id="phoneID"/>
                </div>
                <div class="mb-4">
                    <label for="messageID" class="block text-sm font-bold mb-2">Mensagem:</label>
                    <textarea required name="message" id="messageID" class="w-full p-2 rounded text-black"></textarea>
                </div>
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Enviar</button>
            </form>
        </div>
    </section>

    <!-- Rodapé -->
    <footer class="bg-gray-900 text-white text-center p-4">
        <p>&copy; 2024 DevTechLoSantos. Todos os direitos reservados.</p>
    </footer>
{{--    @livewire('components.modal')--}}
    @livewire('components.toast')
    @livewireScripts
</body>
</html>
