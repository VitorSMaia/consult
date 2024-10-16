@props([
    'label' => '',
    'name' => '',
    'disabled' => false,
    'required' => false,
])

<div  class="relative z-10 w-full bg-transparent border-0">

    <input
        wire:ignore
        {{ $disabled == 'true' ? 'disabled' : '' }}
        {{ $required == 'true' ? 'required' : '' }}
        id="{{ $name }}"
        type="text"
        wire:model.lazy="state.{{ $name }}"
        name="{{ $name }}"
        placeholder=""
        autocomplete="true"
        x-mask:dynamic="$input.length > 14
        ? '99.999.999/9999-99' : '999.999.999-99'"
        class="w-full h-max block p-0 m-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200"
    />
    <label for="{{ $name }}" class="w-screen absolute duration-300 top-0 -z-1 origin-0 text-gray-500">{{ $label }}</label>
    @error('state.' . $name) <x-input-error messages="{{ $message }}" class="mt-2" /> @enderror
    @error($name) <x-input-error messages="{{ $message }}" class="mt-2" /> @enderror
</div>