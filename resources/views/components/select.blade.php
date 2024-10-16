@props([
    'label' => '',
    'name' => '',
    'disabled' => false
])


<div {{ $attributes->merge(['class' => 'relative z-0 w-full mb-2']) }}>
    <select
        {{ $disabled ? 'disabled' : '' }}
        required
        name="{{ $name }}"
        wire:model="state.{{ $name }}"
        value=""
        onclick="this.setAttribute('value', this.value);"
        class="w-full h-max block p-0 m-0 bg-transparent border-0 border-b-2 appearance-none z-1 focus:outline-none focus:ring-0 focus:border-black border-gray-200"
    >
        <option value="" selected disabled hidden></option>
        {{ $slot }}
    </select>

    <label for="{{ $name }}" class="w-full absolute duration-300 -top-0.5 -z-1 origin-0 text-gray-500">{{ $label }}</label>
    @error('state.' . $name) <x-input-error messages="{{ $message }}" class="mt-2" /> @enderror
    @error($name) <x-input-error messages="{{ $message }}" class="mt-2" /> @enderror
</div>
