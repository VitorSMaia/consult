<div class="flex h-full">
    <div {{ $attributes->merge(['class' => 'relative z-0 h-full w-full mb-2']) }}>
        <select
                name="limit"
                wire:model="limit"
                value=""
                onclick="this.setAttribute('value', this.value);"
                class="w-14 h-max block p-0 m-0 bg-transparent border-0 border-b-2 appearance-none z-1 focus:outline-none focus:ring-0 focus:border-black border-gray-200"
        >
            <option value="" selected disabled hidden></option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
        </select>

        <label for="limit" class="absolute duration-300 -top-0.5 -z-1 origin-0 text-gray-500">Limite</label>
    </div>

</div>