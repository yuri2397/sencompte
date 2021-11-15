@extends('layouts.app')
@section('nav')
    <li><a class="nav-link scrollto" href="/#about">A propos</a></li>
    <li><a class="nav-link scrollto" href="/#services">Services</a></li>
    <li><a class="nav-link scrollto" href="/#contact">Contact</a></li>
@endsection
@section('content')

    <!-- ======= Hero Section ======= -->
    <section id="hero" style="height: 100%" class="d-flex align-items-center">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                    <img src="/img/netflix_welcome.png" class="img-fluid animated" alt="">
                </div>
                <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1"
                    data-aos="fade-up" data-aos-delay="200">
                    <div class="shadow d-flex align-items-stretch contact">
                        <form action="/login" method="post" class="php-email-form">
                            @csrf
                            <h2 class="text-danger">Connectez-vous</h2>
                            @error('login_error')
                                <div class="shadow-sm text-center alert alert-danger">
                                    Email ou mot de passe incorrecte.
                                </div>
                            @enderror
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="email">Adresse email</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        value="{{ old('email') }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="password">Mot de passe</label>
                                    <input type="password" name="password" class="form-control" id="password" required>
                                </div>
                            </div>
                                <div class="d-flex align-items-center mb-2">
                                    <div>
                                        <label class="form-check-label" for="remember">Se souvenir de moi</label>
                                    </div>
                                    <div class="mx-2">
                                        <input type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                    </div>
                                </div>
                            <div class="mb-3">
                                <button type="submit">Se connecter</button>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">

                                <div>
                                    <a href="{{ route('client.registerForm') }}"><u>Créer mon compte</u></a>
                                </div>
                                <div>
                                    <a  href="{{ route('forgotPasswordForm') }}"><u>Mot de passe
                                            oublié?</u></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- End Hero -->


@endsection()
