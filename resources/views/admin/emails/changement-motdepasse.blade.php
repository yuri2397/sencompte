@component('mail::message')
# Changemenet de mot de passe

- Liste des comptes à changer leur mot de passe. <strong>{{ date() }}</strong>

<table class="table">
    <thead>
        <tr>
            <th>Adresse email</th>
            <th>Mot de passe actuel</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($accounts as $account)
        <tr>
            <td>{{ $account->email }}</td>
            <td>{{ $account->password }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@component('mail::button', ['url' => $url])
Voir les statistiques
@endcomponent

Merci,<br>
{{ config('app.name') }}
@endcomponent
