@component('mail::message')
# Bonjour {{ $client->first_name }} {{ $client->last_name }}

Votre abonnement n° <span class="badge badge-danger">{{ $profile->number }} </span>est sur le point d'expire.
Il vous reste 4 jours pour le renouvellement.

- Vous pouvez utilisé les moyens de paiements mobile disponible sur notre plateforme.

Merci d'avoir choissi <a href="/">Sencompte</a>,<br>
{{ config('app.name') }}
@endcomponent
