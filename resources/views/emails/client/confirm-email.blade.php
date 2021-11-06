@component('mail::message')
# Bonjour {{ $client->first_name }}

Votre adresse mail a été utilisé pour créer un compte sur <a href='/'>sencompte.sn</a>.
Merci de confirmer votre adresse email.

@component('mail::button', ['url' => $url])
Confirmer mon adresse mail
@endcomponent

Merci,<br>
{{ config('app.name') }}
@endcomponent
