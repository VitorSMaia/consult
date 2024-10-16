@props([
    'label' => '',
    'classIcon' => '',
    'classTxt' => '',
    'icon' => '',
    'icon_list' => [
        'add' => './icons/add.png',
        'edit' => './icons/edit.png',
        'delete' => './icons/delete.svg',
        'delete_white' => './icons/delete_white.svg',
        'delete_amber' => './icons/delete_FDC14A.svg',
        'comment' => './icons/comment.svg',
        'view' => './img/view.png',
        'wysiwyg' => './icons/wysiwyg.svg',
    ]
])

<div>
    <button {{ $attributes->merge(['class' => 'btn-default hover:relative']) }} >
        <div class="w-5 h-5">
            <img src="{{ asset($icon_list[$icon]) }}" class="h-5 " alt="{{ $icon }}">
        </div>

        @if($label)
            <div class="absolute -top-5 -z-0 {{ $classTxt }} px-1 py-0.5 shadow-xl rounded-md left-2">
                <span>{{ $label }}</span>
                <svg class="absolute {{ $classIcon }} h-5 left-3 ml-0 top-5" x="0px" y="0px" viewBox="0 0 255 255" xml:space="preserve"><polygon class="fill-current" points="0,0 127.5,127.5 255,0"/></svg>
            </div>
        @endif
    </button>
</div>