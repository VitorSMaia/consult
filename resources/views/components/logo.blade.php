@props([
    'class' => ''
])

<div class="flex flex-shrink-0 items-center px-4 py-4 cursor-pointer">
    <a href="{{ route('dashboard') }}">
        <img class="{{ $class }}" src="{{ asset("./img/logo.jpg") }}" alt="Your Company">
    </a>
</div>