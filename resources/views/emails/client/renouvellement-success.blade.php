@component('mail::message')
# Bonjour {{ $client->first_name }}

Votre profile abonnement a été renouvellement de <strong>30 jours</strong>.<br>

Merci de récupérer les indentifiants de connexion.

- Adresse email : <strong>{{ $profile->account->email }}</strong>
- Mot de passe : <strong>{{ $profile->account->password }}</strong>
- Code pin : <strong>{{ $profile->pin }}</strong>
- N° du profil : <strong>{{ $profile->number }}</strong>

<div class="alert alert-danger">
    Veuillez garder ces informations dans un lieu sûr.
</div>

Merci, et bonne visionnage sur <a href="www.netflix.com">Netflix Premium HD</a><br>
{{ config('app.name') }}
@endcomponent
