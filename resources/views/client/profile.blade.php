@extends('layouts.app')
@section('nav')
    @toastr_css

@endsection
@section('content')
    <section id="hero" style="height: 100%" class="d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-lg-12 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1"
                    data-aos="fade-up" data-aos-delay="200">

                    <div class="why-us section-bg">
                        <div class="row">
                            <div class="col-lg-12 d-flex flex-column justify-content-center align-items-stretch ">

                                <div class="content align-items-center">
                                    <h3>Heureux de vous revoir <strong><a
                                                href="{{ route('client.params') }}">{{ $user->first_name }} <i
                                                    class="bi bi-box-arrow-in-right"></i></a></strong>
                                    </h3>
                                    <p>
                                        De nouveaux séries et films uniquement pour vous 🌟
                                    </p>
                                    @if ($user->email_verified_at != null)
                                        <div class="mb-3">
                                            <a type="button" href="{{ route('client.abonnement') }}"
                                                class="btn btn-primary shadow">Ajouter un abonnement à 2 000 FCFA 🎬</a>
                                        </div>
                                    @else
                                        <div class="my-5 alert alert-danger shadow-sm">
                                            <span >Merci de vérifier votre adresse
                                                email pour pouvoir ajouter un nouveau abonnement. </span>
                                        </div>
                                    @endif
                                </div>
                                @if (isset($profiles) && count($profiles) != 0)
                                    <ul class="row my-2">
                                        @forelse ($profiles as $profile)
                                            <div class="card shadow-sm col-auto m-2">
                                                <img src="assets/img/netflix.png" class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title">Netflix Premium HD</h5>
                                                    <p class="card-text">Date d'expiration <strong
                                                            class="text-danger">{{ date('d-m-Y', strtotime($profile->date_end)) }}</strong>
                                                    </p>
                                                    <div class="text-center mt-2">
                                                        <a type="button"
                                                            href="{{ route('client.show', ['id' => $profile->hash]) }}"
                                                            role="button" class="btn btn-primary shadow">Voir plus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <p>Ajouter abonnement</p>
                                        @endforelse
                                    </ul>
                                @else
                                    <div class="accordion-list">
                                        <div data-aos="zoom-in" data-aos-delay="100">
                                            <div class="icon-box">
                                                <div class="icon"><i class="bx bxl-dribbble"></i></div>
                                                <h4>Vous n'avez aucun n'abonnement en cours</h4>
                                                <p>Prenez un abonnement pour ne rater aucun des nouveaux séries et films en
                                                    {{ date('Y') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </div>

                        </div>
                    </div><!-- End Why Us Section -->

                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    @jquery
    @toastr_js
    @toastr_render
@endsection
