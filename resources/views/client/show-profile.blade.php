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
                                                    <div class="row">
                                                        <div class="col-md-7">

                                                        </div>
                                                        <div class="col-md-5">
                                                            <form>
                                                                <div class="form-group mt-3">
                                                                    <label for="exampleInputPassword1">Numéro de
                                                                        profil</label>
                                                                    <input type="text" class="form-control" disabled
                                                                        placeholder="{{ $profile->number }}">
                                                                </div>
                                                                <div class="form-group my-2">
                                                                    <label for="exampleInputEmail1">Adresse Email</label>
                                                                    <input type="text" class="form-control" disabled
                                                                        placeholder="{{ $profile->account->email }}">
                                                                </div>
                                                                <div class="form-group my-2">
                                                                    <label for="exampleInputPassword1">Mot de passe</label>
                                                                    <input type="text" class="form-control" disabled
                                                                        id="exampleInputPassword1"
                                                                        placeholder="{{ $profile->account->password }}">
                                                                </div>
                                                                <div class="form-group mt-3">
                                                                    <label for="exampleInputPassword1">Code Pin</label>
                                                                    <input type="text" class="form-control" disabled
                                                                        id="exampleInputPassword1"
                                                                        placeholder="{{ $profile->pin }}">
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
