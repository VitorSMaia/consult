@props([
    'label' => '',
    'type' => 'text',
    'name' => '',
    'id' => '',
    'disabled' => 'false',
    'required' => 'false',
])

<div class="relative z-10 w-full bg-transparent border-0">
    <input
        {{ $disabled == 'true' ? 'disabled' : '' }}
        {{ $required == 'true' ? 'required' : '' }}
        type="{{ $type }}"
        id="{{ $id }}"
        wire:model.lazy="state.{{ $name }}"
        name="{{ $name }}"
        placeholder=""
        autocomplete="true"
        class="w-full h-max block p-0 m-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 border-gray-200"
    />
    <label for="{{ $id }}" class="w-full absolute duration-300 top-0 -z-1 origin-0 text-gray-500">{{ $label }}</label>
    @error($name) <x-input-error messages="{{ $message }}" class="mt-2" /> @enderror
</div>