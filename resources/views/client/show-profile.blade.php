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
                                                            <img src="/img/netflix_welcome.png" class="card-img-top"
                                                                alt="IMAGE DE NETFLIX">
                                                        </div>
                                                        <div class="col-md-5">
                                                            <h1 class="text-primary">Netflix Premium HD</h1>

                                                            <h4 class="mb-2 alert alert-danger">
                                                                <span>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $profile->date_end)->diffInDays(now()) }}</span>
                                                                jours avant la fin d'abonnement
                                                            </h4>
                                                            <h5 class="my-3">
                                                                Date d'expiration :
                                                                <b>{{ date('d / m / Y', strtotime($profile->date_end)) }}</b>
                                                            </h5>
                                                        </div>
                                                        <div class="col-md-4 align-self-start">
                                                            <h3 class="text-primary"><a>Détails du compte</a></h3>

                                                            <div class="form-group mt-3">
                                                                <label>Numéro de
                                                                    profil</label>
                                                                <input type="text" class="form-control" disabled
                                                                    value="{{ $profile->number }}">
                                                            </div>
                                                            <div class="form-group my-2">
                                                                <label>Adresse Email</label>
                                                                <input type="text" class="form-control" disabled
                                                                    value="{{ $profile->account->email }}">
                                                            </div>
                                                            <div class="form-group my-2">
                                                                <label>Mot de passe</label>
                                                                <input type="text" class="form-control" disabled
                                                                    value="{{ $profile->account->password }}">
                                                            </div>
                                                            <div class="form-group mt-3">
                                                                <label>Code Pin</label>
                                                                <input type="text" class="form-control" disabled
                                                                    value="{{ $profile->pin }}">
                                                            </div>
                                                            <button class="mt-2 shadow btn btn-primary btn-block"
                                                                data-toggle="modal" role="button"
                                                                data-target="#addMonthModal">Renouveller
                                                                votre abonnement</button>
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

        <!-- Renouvellement Modal-->
        <div class="modal fade" id="addMonthModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Renouveller
                            votre abonnement
                        </h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form id="add-month-form" action="/client/payement" method="POST">
                            @csrf

                            <input style="display: none;" type="text" name="hash" id="hash" value="{{ $profile->hash }}" required>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="nombre_mois">Nombre de mois (1 à 12) </label>
                                    <input onchange="onNumberMonthChanger(this)" type="number" min="1" max="12"
                                        class="form-control" name="nombre_mois" id="nombre_mois" value="1" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="montant_a_payer">Montant à payer</label>
                                    <input type="text" disabled class="form-control" name="montant_a_payer"
                                        id="montant_a_payer" value="2000 FCFA">
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                        <a class="btn btn-primary" onclick="event.preventDefault();
                                    document.getElementById('add-month-form').submit();">{{ __('Renouveller') }}</a>

                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('script')
    <!-- Bootstrap core JavaScript-->
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/js/app.js"></script>
@endsection
