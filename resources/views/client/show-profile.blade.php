@extends('layouts.app')

@section('content')
    <section id="hero" style="height: 100%">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1"
                    data-aos="fade-up" data-aos-delay="200">
                    <div class="row">
                        <div class="col-lg-12 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1"
                            data-aos="fade-up" data-aos-delay="200">

                            <div class="why-us section-bg shadow-lg">
                                <div class="row">
                                    <div class="col-lg-12 d-flex flex-column justify-content-center align-items-stretch ">
                                        @if (isset($profile))
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-3">
                                                            <img src="/img/netflix_welcome.png" class="card-img-top" alt="IMAGE DE NETFLIX">
                                                        </div>
                                                        <div class="col-md-5">
                                                            <h1 class="text-primary">Netflix Premium HD</h1>

                                                            <h4 class="mb-2 alert alert-danger"><span>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $profile->date_end)->diffInDays(now()) }}</span> jours avant la fin d'abonnement</h4>
                                                            <p class="mb-1">Date d'abonnement : <b>{{ date('d-m-Y H:s:i', strtotime($profile->updated_at)) }}</b></p>
                                                            <p class="mb-1">
                                                                Date d'expiration :
                                                                <b >{{ date('d-m-Y H:s:i', strtotime($profile->date_end)) }}</b>
                                                            </p>
                                                        </div>
                                                        <div class="col-md-4 align-self-start">
                                                            <h3 class="text-primary"><a>Détails du compte</a></h3>

                                                                <div class="form-group mt-3">
                                                                    <label >Numéro de
                                                                        profil</label>
                                                                    <input type="text" class="form-control" disabled
                                                                    value="{{ $profile->number }}">
                                                                </div>
                                                                <div class="form-group my-2">
                                                                    <label  >Adresse Email</label>
                                                                    <input type="text" class="form-control" disabled
                                                                    value="{{ $profile->account->email }}">
                                                                </div>
                                                                <div class="form-group my-2">
                                                                    <label  >Mot de passe</label>
                                                                    <input type="text" class="form-control" disabled
                                                                    value="{{ $profile->account->password }}">
                                                                </div>
                                                                <div class="form-group mt-3">
                                                                    <label  >Code Pin</label>
                                                                    <input type="text" class="form-control" disabled
                                                                        value="{{ $profile->pin }}">
                                                                </div>
                                                                <a href="{{ route("renouvellement", ['id' => $profile->hash]) }}" class="mt-3 shadow btn btn-primary btn-block">Renouvellement (+30 jours)</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="accordion-list">
                                                <div data-aos="zoom-in" data-aos-delay="70">
                                                    <div class="icon-box">
                                                        <div class="icon"><i class="bx bxl-dribbble"></i></div>
                                                        <h4>Vous n'avez aucun n'abonnement en cours</h4>
                                                        <p>Prenez un abonnement pour ne rater aucuns des nouveaux séries et
                                                            films en
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
            </div>
        </div>
    </section>
@endsection

@section('script')
@endsection
