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
            <div class="row">
                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                    <img src="/img/netflix_welcome.png" class="img-fluid animated" alt="">
                </div>
                <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1"
                    data-aos="fade-up" data-aos-delay="200">
                    <div class="shadow d-flex align-items-stretch contact">
                        <form action="/register" method="post" role="form" class="php-email-form">
                            @csrf

                            <h2 class="text-danger mb-5">Créer un compte</h2>
                            @if ($errors->any())
                                <div class="alert shadow-sm alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="first_name">Prenom</label>
                                    <input type="text" name="first_name" value="{{ old('first_name') }}"
                                        class="form-control @error('first_name') is-invalid @enderror" id="first_name"
                                        required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="last_name">Nom</label>
                                    <input type="text" name="last_name" value="{{ old('last_name') }}"
                                        class="form-control @error('last_name') is-invalid @enderror" id="last_name"
                                        required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="phone_number">N° de téléphone</label>
                                    <input type="number" value="{{ old('phone_number') }}"
                                        class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                                        id="phone_number" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Adresse email</label>
                                    <input type="email" value="{{ old('email') }}"
                                        class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                                        required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="password">Mot de passe</label>
                                    <input type="password" class="form-control " name="password" id="password" required>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            Please select a valid state.
                                        </div>
                                    @enderror
                                </div>


                                <div class="form-group col-md-6">
                                    <label for="password_confirmation">Confirmer le mot de passe</label>
                                    <input type="password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        name="password_confirmation" id="password_confirmation" required>

                                    @error('password_confirmation')
                                        <div class="invalid-feedback">
                                            Please select a valid state.
                                        </div>
                                    @enderror

                                </div>

                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <button type="submit">Créer mon compte</button>
                                </div>
                                <div>
                                    <a href="/login">J'ai déjà un compte</a>
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
