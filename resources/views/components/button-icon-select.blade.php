@props([
    'label' => '',
    'name' => '',
    'classIcon' => '',
    'icon' => '',
    'icon_list' => [
        'add' => './icons/add.png',
        'edit' => './icons/edit.png',
        'delete' => './icons/delete.svg',
        'delete_white' => './icons/delete_white.svg',
        'comment' => './icons/comment.svg',
        'view' => './icons/view.svg',
        'wysiwyg' => './icons/wysiwyg.svg',
    ]
])

<div>
    <button {{ $attributes->merge(['class' => 'btn-default hover:relative']) }} >

        @if($label)
            <div class="absolute -top-6 z-10 bg-amber-400 text-black px-1 py-0.5 shadow-xl rounded-br-lg rounded-t-lg left-5">
                <span>{{ $label }}</span>
            </div>
        @endif

        <img src="{{ asset($icon_list[$icon]) }}" class="h-5 {{ $classIcon }}" alt="{{ $icon }}">

            <div class="relative">
                <li class="w-32 h-64 bg-amber-400 absolute top-10 ">
                    <ol>Avaliação da obra de arte</ol>
                    <ol>Elaboração da apólice</ol>
                    <ol>Revisão e aceitação da apólice</ol>
                    <ol>Pagamento do prêmio</ol>
                    <ol>Emissão da apólice</ol>
                    <ol>Gestão contínua do seguro</ol>
                </li>
            </div>

    </button>
</div>