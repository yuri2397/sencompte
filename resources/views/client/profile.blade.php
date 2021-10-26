@extends('layouts.app')



<!-- End Hero -->
@section('content')
    <section id="hero" style="height: 100%" class="d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-lg-12 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1"
                    data-aos="fade-up" data-aos-delay="200">

                    <!-- ======= Why Us Section ======= -->
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
                                        <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" role="button"
                                            class="shadow btn-get-started scrollto">Ajouter un abonnement 🎬</a>
                                    </div>
                                </div>
                                @if (isset($profiles) && count($profiles) != 0)
                                    <div class="content">
                                        <h3><strong>Vous avez {{ count($profiles) }} en cours</strong>
                                        </h3>
                                    </div>
                                    <div class="accordion-list">
                                        <ul>
                                            @forelse ($profiles as $profile)
                                                <li>
                                                    <a data-bs-toggle="collapse" class="collapse"
                                                        data-bs-target="#accordion-list-{{ $profile->pin }}"><span>{{ $profile->number }}</span>
                                                        Voir les informations de connexion
                                                        <i class="bx bx-chevron-down icon-show"></i><i
                                                            class="bx bx-chevron-up icon-close"></i></a>
                                                    <div id="accordion-list-{{ $profile->pin }}" class="collapse show"
                                                        data-bs-parent=".accordion-list">
                                                        <ul class="mt-3">
                                                            <li>
                                                                Adresse email : <strong
                                                                    class="badge bg-success">{{ $profile->account->email }}</strong>
                                                            </li>
                                                            <li>Mot de passe du compte : <strong
                                                                    class="badge bg-warning">{{ $profile->account->password }}</strong>
                                                            </li>
                                                            <li>Numéro de profile : <strong
                                                                    class="badge bg-primary">{{ $profile->number }}</strong>
                                                            </li>
                                                            <li>Code pin : <strong
                                                                    class="badge bg-danger">{{ $profile->pin }}</strong>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            @empty
                                                <p>Ajouter abonnement</p>
                                            @endforelse
                                        </ul>
                                    </div>
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
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ajouter un abonnement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/abonner" method="post">
                            <div class="row my-2">
                                <div class="form-group col-md-12">
                                    <label for="abonnement">Nombre d'abonnement</label>
                                    <input type="number" class="form-control" name="abonnement" id="abonnement"
                                        value="{{ old('abonnement') }}" required>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="form-group col-md-12">
                                    <label for="password">Montant</label>
                                    <input disabled type="text" value="2.000 FCFA" class="form-control" id="password"
                                        required>
                                </div>
                            </div>
                            <a type="submit" class="shadow btn-get-started scrollto">S'abonner</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
