<div class="sm:flex sm:items-center pb-8">
    <div class="sm:flex-auto">
        <h1 class="text-xl font-semibold text-gray-900 dark:text-gray-400">{{ $title }}</h1>
        <p class="mt-2 text-sm text-gray-700 dark:text-gray-100">{{ $description }}</p>
    </div>

    @if(isset($btnLabel))
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
            <livewire:components.button
                :btnLabel="$btnLabel"
                :component="$component"
            />
        </div>
    @endif

    @livewire('components.toast')
</div>