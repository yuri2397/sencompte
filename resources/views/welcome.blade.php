@extends('layouts.app')

@section('nav')
    <li><a class="nav-link scrollto" href="#about">A propos</a></li>
    <li><a class="nav-link scrollto" href="#services">Services</a></li>
    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
@endsection
@section('content')

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1"
                    data-aos="fade-up" data-aos-delay="200">
                    <h1 style="font-size: 60px; letter-spacing: 3px">Dépensez moins, profitez plus !</h1>
                    <br>
                    <h2>Regardez des millions de films et séries.
                    </h2>
                    @if (!Auth::guard('admin')->check() && !Auth::guard('client')->check())
                        <div class="d-flex justify-content-center justify-content-lg-start">
                            <a href="{{ route('login') }}" class="btn-get-started scrollto">Se connecter</a>
                            <a href="{{ route('client.registerForm') }}" class="btn-watch-video"><i
                                    class="bi bi-box-arrow-in-right"></i><span>Créer
                                    votre
                                    compte</span></a>
                        </div>
                    @endif
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                    <img src="/img/netflix_welcome.png" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>

    </section>

    <!-- End Hero -->

    <main id="main">

        <!-- ======= Why Us Section ======= -->
        <section id="about" class="why-us section-bg">
            <div class="container-fluid" data-aos="fade-up">
                <div class="section-title">
                    <h2>QUI
                        SOMMES-NOUS ?</h2>
                </div>

                <div class="row">

                    <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">

                        <div class="content">
                            <h3 class="text-dark">
                                Netflix Sénégal a été mis en place par des sénégalais dont le souhait est de permettre a
                                tout un chacun de profiter de la plateforme Netflix afin de suivre ses films et séries
                                préférés à bas prix .
                            </h3>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End Why Us Section -->

        <!-- ======= Services Section ======= -->
        <section id="services" class="services section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Pourquoi
                        nous choisir ?</h2>
                </div>

                <div class="row">
                    <div class="col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bxl-dribbble"></i></div>
                            <h4><a href="">DES TARIFS IMBATTABLES</a></h4>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in"
                        data-aos-delay="200">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-file"></i></div>
                            <h4><a href="">UN SERVICES CLIENTS TRÈS RÉACTIFS</a></h4>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in"
                        data-aos-delay="300">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-tachometer"></i></div>
                            <h4><a href="">DES COMPTES DE QUALITÉ PREMIUM À VOTRE DISPOSITION
                                </a></h4>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in"
                        data-aos-delay="400">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-layer"></i></div>
                            <h4><a href="">UN SUIVI CONTINU DE VOS COMPTES
                                </a></h4>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Services Section -->

        <!-- ======= Pricing Section ======= -->
        <section id="pricing" class="pricing">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>LES
                        CHIFFRES</h2>
                </div>
                <div class="row">


                    <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="200">
                        <div class="box featured">

                            <h4 class="h1">3</h4>
                            <h3>
                                ANS
                                D'EXISTENCE
                            </h3>
                        </div>
                    </div>

                    <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="300">
                        <div class="box featured">

                            <h4>{{ $clients_number }}</h4><h3>
                                CLIENTS SATISFAITS
                            </h3>
                        </div>
                    </div>

                    <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="400">
                        <div class="box featured">

                            <h4>{{ $profiles_number }}</h4>
                            <h3>
                                PROFIL
                                CRÉÉS
                            </h3>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End Pricing Section -->

        <!-- ======= Pricing Section ======= -->
        <section id="contact" class="contact">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>CONTACTER NOUS</h2>
                    <div>
                        <a href="https://wa.me/221777647322?text=Je%20suis%20intéressé%20par%20votre%20abonnement%20netflix.%20Le%20prix%20svp" class="shadow card card-body btn-watch-video">
                            <i class="bi bi-whatsapp h1"></i><span> Retrouver nous sur whatsapp</span></a>
                    </div>
                </div>

                <div class="row">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                                <img src="/img/service-client.jpg" class="img-fluid animated" alt="">
                            </div>
                            <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1"
                                data-aos="fade-up" data-aos-delay="200">
                                <div class="shadow d-flex align-items-stretch contact">
                                    <form action="/contact-us" method="post" class="php-email-form">
                                        @csrf
                                        @error('message')
                                            <div class="shadow-sm text-center alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="row p-0">
                                            <div class="form-group col-md-12">
                                                <label for="email">Votre adresse email</label>
                                                <input type="email" class="form-control" name="email" id="email"
                                                    value="{{ old('email') }}" required>
                                            </div>
                                        </div>
                                        <div class="row p-0">
                                            <div class="form-group col-md-12">
                                                <label for="password">Votre message</label>
                                                <textarea type="text" rows="5" name="message" class="form-control" required></textarea>
                                            </div>
                                        </div>

                                        <div class="mb-1">
                                            <button type="submit">Envoyer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End Pricing Section -->

    </main>

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

@endsection

