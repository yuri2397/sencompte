@extends('layouts.app')



<!-- End Hero -->
@section('content')
    <section id="hero" style="height: 100%" class="d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-lg-12 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1"
                    data-aos="fade-up" data-aos-delay="200">
                    <div class="row">
                        <div class="col-lg-12 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1"
                            data-aos="fade-up" data-aos-delay="200">

                            <!-- ======= Why Us Section ======= -->
                            <div class="why-us section-bg shadow-lg">
                                <div class="row">
                                    <div class="col-lg-12 d-flex flex-column justify-content-center align-items-stretch ">
                                        @if (isset($profile))
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-3">
                                                            <img src="/assets/img/netflix.png" class="card-img-top" alt="...">
                                                        </div>
                                                        <div class="col-md-5">
                                                            <h1 class="text-primary"><a>Netflix Premium HD</a></h1>
                                                            <h4 class="mb-2 alert alert-danger">{{ $mounth }} jours avant la fin d'abonnement</h4>
                                                            <p class="mb-1">Date d'abonnement : <b>{{ date('d-m-Y', strtotime($profile->updated_at  )) }}</b></p>
                                                            <p class="mb-1">
                                                                Date d'expiration :
                                                                <b>{{ date('d-m-Y', strtotime($profile->date_end)) }}</b>
                                                            </p>
                                                        </div>
                                                        <div class="col-md-4 align-self-start">
                                                            <h3 class="text-primary"><a>Détails du compte</a></h3>

                                                            <form>
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

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="accordion-list">
                                                <div data-aos="zoom-in" data-aos-delay="100">
                                                    <div class="icon-box">
                                                        <div class="icon"><i class="bx bxl-dribbble"></i></div>
                                                        <h4><a href="">Vous n'avez aucun n'abonnement en cours</a></h4>
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
