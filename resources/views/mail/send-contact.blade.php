@component('mail::message')
# {{ $nome }} obrigado por entrar em contato
Acese Aqui:
@component('mail::button', ['url' => $url])
VER
@endcomponent
@endcomponent