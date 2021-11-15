@component('mail::message')
    ## MANQUE DE PROFILS

    # La plateforme n'a aucun profil disponible. <br>
    Merci de crée un nouveau compte netflix.

    @component('mail::button', ['url' => $url])
        Voir les statistiques
    @endcomponent

    Merci,<br>
    {{ config('app.name') }}
@endcomponent
