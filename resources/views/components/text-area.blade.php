@props([
    'label' => '',
    'type' => 'text',
    'name' => '',
    'disabled' => false,
    'rows' => ''
])

<div {{ $attributes->merge(['class' => 'relative z-0 w-full mb-5']) }}>
    <textarea
        type="{{ $type }}"
        id="{{ $name }}"
        wire:model.defer="state.{{ $name }}"
        name="{{ $name }}"
        placeholder=""
        rows="{{ $rows }}"
        {{ $disabled ? 'disabled' : '' }}
        class="pt-3 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200"
    ></textarea>
    <label for="{{ $name }}" class="absolute duration-300 -top-1 -z-1 origin-0 text-gray-500">{{ $label }}</label>
    @error('state.' . $name) <x-input-error messages="{{ $message }}" class="mt-2" /> @enderror
    @error($name) <x-input-error messages="{{ $message }}" class="mt-2" /> @enderror
</div>