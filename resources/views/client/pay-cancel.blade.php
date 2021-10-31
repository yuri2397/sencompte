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
                                <h1 class="display-3 text-danger">Payement annullé</h1>
                                <p class="lead">Votre abonnement a été anullé</p>
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
