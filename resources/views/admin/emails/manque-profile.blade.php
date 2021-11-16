@component('mail::message')
# Manque de profil

La plateforme n'a plus de profils disponible.<br/> Merci d'ajouter de nouveaux comptes.

@component('mail::button', ['url' => $url,])
Se connecter
@endcomponent

Merci, équipe téchnique<br>
{{ config('app.name') }}
@endcomponent
