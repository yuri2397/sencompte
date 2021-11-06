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
                        <form action="{{ route('forgotPassword') }}" method="post" class="php-email-form">
                            @csrf
                            <h2 class="text-danger">Demande de réinitialisation de mot de passe</h2>
                            @error('message')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="email">Adresse email</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button type="submit">Envoyer</button>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">

                                <div>
                                    <a href="{{ route('client.registerForm') }}"><u>Créer mon compte</u></a>
                                </div>
                                <div>
                                    <a href="{{ route('login') }}"><u>Se connecter</u></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
