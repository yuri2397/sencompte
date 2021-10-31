@extends('layouts.app')



<!-- End Hero -->
@section('content')
    <section id="hero" style="height: 100%" class="d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-lg-12 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1"
                    data-aos="fade-up" data-aos-delay="200">

                    <div class="why-us section-bg">
                        <div class="row">
                            <div class="col-lg-12 d-flex flex-column justify-content-center align-items-stretch ">

                                <div class="content">
                                    <h3>Heureux de vous revoir <strong>{{ $name }}</strong>
                                    </h3>
                                    <p>
                                        De nouveaux séries et films uniquement pour vous 🌟
                                    </p>
                                    <div class="mb-3">
                                        <a type="button" data-bs-toggle="modal" data-bs-target="#abonnementModal" role="button"
                                            class="btn btn-primary shadow">Ajouter un abonnement 🎬</a>
                                    </div>
                                </div>
                                @if (isset($profiles) && count($profiles) != 0)
                                    <div class="content">
                                        <h3><strong>Vous avez {{ count($profiles) }} en cours</strong>
                                        </h3>
                                    </div>

                                    <ul class="row align-items-center justify-content-center my-2">
                                        @forelse ($profiles as $profile)
                                        <div class="card shadow-sm col-sm-4 col-xs-12 col-md-3 m-2">
                                            <img src="assets/img/netflix.png" class="card-img-top" alt="...">
                                            <div class="card-body">
                                              <h5 class="card-title">Netflix Premium HD</h5>
                                              <p class="card-text">Date d'expiration <strong class="text-danger" >{{ date('d-m-Y', strtotime($profile->date_end)); }}</strong></p>
                                              <div class="text-center mt-2">
                                                <a type="button" href="{{ route('client.show', ['id' => $profile->id] )}}" role="button"
                                                    class="btn btn-primary shadow">Voir plus</a>
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
                                                <h4><a href="">Vous n'avez aucun n'abonnement en cours</a></h4>
                                                <p>Prenez un abonnement pour ne rater aucuns des nouveaux séries et films en
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


        <!-- Modal AJOUTER UN ABONNEMENT-->
        <div class="modal fade" id="abonnementModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ajouter un abonnement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route("client.abonnement") }}" method="post">
                            @csrf
                            <div class="row my-2">
                                <div class="form-group col-md-12">
                                    <label for="password">Montant de l'abonnement</label>
                                    <input disabled type="text" value="2.000 FCFA" class="form-control" id="password"
                                        required>
                                </div>
                            </div>
                            <button type="submit"  class="btn btn-primary shadow">S'abonner</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
