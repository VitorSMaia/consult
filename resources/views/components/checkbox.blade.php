@props([
    'label' => '',
    'name' => '',
    'disabled' => false,
])

<div {{ $attributes->merge(['class' => 'flex flex-col']) }}>
    <label
            class="relative flex cursor-pointer items-center rounded-full"
            for="{{ $name }}"
            data-ripple-dark="true"
    >
        <input
                type="checkbox"
                wire:model.defer="state.{{ $name }}"
                class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-md border border-yellow-gray-200 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-yellow-gray-500 before:opacity-0 before:transition-opacity checked:border-yellow-900 checked:bg-yellow-500 checked:before:bg-yellow-500 hover:before:opacity-10"
                id="{{ $name }}"
                name="{{ $name }}"
        />

        <p class="ml-1">{{ $label }}</p>

    </label>
    @error($name) <x-input-error messages="{{ $message }}" class="mt-2" /> @enderror
</div>
