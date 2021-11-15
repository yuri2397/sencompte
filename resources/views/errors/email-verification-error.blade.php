@extends('layouts.app')



<!-- End Hero -->
@section('content')

    <section id="hero" style="height: 100%" class="d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-lg-12 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1"
                    data-aos="fade-up" data-aos-delay="200">

                    <div class="why-us section-bg">
                        <div class="row card card-body">
                            <div class="jumbotron">
                                <h1 class="display-3 text-danger">Confirmation d'adresse mail</h1>
                                <p class="lead">Merci d'utiliser le mail qu'on vous a envoyé pour la vérification</p><br>
                                <p class="lead">Si vous n'avez pas reçu d'email, merci de contacter le <a href="/">service client</a></p>
                                <hr class="my-2">
                                <p>Merci pour votre confiance</p>
                                @if (Auth::guard('client')->check())
                                    <p class="lead">
                                        <a href="/client" class="btn btn-primary btn-lg" href="Jumbo action link"
                                            role="button">Voir
                                            votre
                                            profile</a>
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
