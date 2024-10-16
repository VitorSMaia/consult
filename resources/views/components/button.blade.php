@props([
    'label' => '',
    'classIcon' => '',
    'icon' => '',
    'icon_list' => [
        'add' => './icons/add.png',
        'edit' => './icons/edit.png',
        'delete' => './icons/delete.svg',
        'view' => './icons/view.svg',
    ]
])

<div>
    <button {{ $attributes->merge(['class' => 'btn-default']) }} >
{{--        <img src="{{ asset($icon_list[$icon]) }}" class="h-5 text-blue-600 {{ $classIcon }}" alt="{{ $icon }}">--}}

        @if($label)
            <span>{{ $label }}</span>
        @endif
    </button>
</div>