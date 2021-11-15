@component('mail::message')
# Bonjour {{ $client->first_name }}

Votre abonnement enregistré avec succès.<br>
Votre compte sera activé d'ici 24 heures. Un nouveau mail vous sera envoyé dès que votre profile sera disponible.
Merci pour votre confiance.

Merci,<br>
{{ config('app.name') }}
@endcomponent
