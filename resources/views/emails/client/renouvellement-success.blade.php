@component('mail::message')
# Bonjour {{ $client->first_name }}

Votre abonnement a été renouvellé avec succès.<br>

Merci de récupérer les indentifiants de connexion.

- Adresse email : <strong>{{ $profile->account->email }}</strong>
- Mot de passe : <strong>{{ $profile->account->password }}</strong>
- Code pin : <strong>{{ $profile->pin }}</strong>
- N° du profil : <strong>{{ $profile->number }}</strong>

# {{ \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $profile->date_end)->diffInDays(now()) }} jours avant la fin d'abonnement

<br>
Merci, et bonne visionnage sur <a href="www.netflix.com">Netflix Premium HD</a><br>
{{ config('app.name') }}
@endcomponent
