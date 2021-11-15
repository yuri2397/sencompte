@component('mail::message')
# Bonjour

Vous avez demandé une réinitialisation de votre mot de passe sur <a href="www.sencompte.sn">Sencompte</a>.
Si cette requête ne vient pas de vous, veuillez nous contacter pour regler ce problème.

@component('mail::button', ['url' => $url])
Créer un nouveau mot de passe.
@endcomponent

Merci,<br>
{{ config('app.name') }}
@endcomponent
