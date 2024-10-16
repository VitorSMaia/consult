@props([
    'label' => '',
    'type' => 'text',
    'name' => '',
    'id' => '',
    'disabled' => false,
    'required' => false,
])

<div class="relative z-10 w-full bg-transparent border-0">
    <input
        {{ $disabled == 'true' ? 'disabled' : '' }}
        {{ $required == 'true' ? 'required' : '' }}
        type="text"
        wire:model="state.{{ $name }}"
        name="{{ $name }}"
        id="{{ $id }}"
        placeholder=""
        x-ref="input"
        autocomplete="true"
        x-init="VMasker($refs.input).maskMoney({
                        precision: 2,
                        separator: ',',
                        delimiter: '.',
                        unit: '',
                        suffixUnit: '',
                    })"

        class="w-full h-max block p-0 m-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200"
    />

    <label for="{{ $name }}" class="w-screen absolute duration-300 top-0 -z-1 origin-0 text-gray-500">{{ $label }}</label>
    @error($name) <x-input-error messages="{{ $message }}" class="mt-2" /> @enderror
</div>