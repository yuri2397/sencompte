@extends('layouts.app')

@section('content')
    <section id="hero" style="height: 100%" class="d-flex align-items-center">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                    <img src="/img/netflix_welcome.png" class="img-fluid animated" alt="">
                </div>
                <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1"
                    data-aos="fade-up" data-aos-delay="200">
                    <div class="shadow d-flex align-items-stretch contact">
                        <form action="{{ route('newPassword') }}" method="post" class="php-email-form">
                            @csrf
                            <h2 class="text-danger">Créer un nouveau mot de passe</h2>
                            @if ($errors->any())
                                <div class="shadow-sm text-center alert alert-danger">
                                    Le mail qu'on vous a envoyé a expiré. Merci de faire un nouveau demande de
                                    réinitialisation de mot de passe.
                                </div>
                            @endif
                                    <input type="text" hidden name="token" id="token"
                                        value="{{ $token }}" required>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="email">Adresse email</label>
                                    <input class="form-control" name="email" id="email"
                                        value="{{ $email }}" required >
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="password">Mot de passe</label>
                                    <input type="text" name="password" class="form-control" id="password" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="password_confirmation">Mot de passe</label>
                                    <input type="text" name="password_confirmation" class="form-control" id="password_confirmation" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <button type="submit">Valider</button>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">

                                <div>
                                    <a href="{{ route('client.registerForm') }}"><u>Créer mon compte</u></a>
                                </div>
                                <div>
                                    <a class="text-dark" href="{{ route('login') }}"><u>Se connecter</u></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
