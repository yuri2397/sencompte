@extends('layouts.admin')

@section('headers')
    <link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('main')
    <div class="container">
        @isset($client)
        <div class="card card-body shadow">
            <div class="row justify-content-center">
                <div class="col-md-8 align-items-center">
                    <h1 class="alert alert-primary text-center">
                        Informations du client
                    </h1>
                    <span class="card-title text-dark h3"><i class="fas fa-user"></i> {{ $client->first_name }}
                        {{ $client->last_name }}</span><br><br>
                    <span class="card-title text-dark h3"><i class="fas fa-envelope"></i>
                        {{ $client->email }}</span><br><br>
                    <span class="card-title text-dark  h3"><i class="fas fa-video"></i>
                        {{ count($client->profiles) ?? 0 }} Abonnements</span>
                </div>
            </div>
            <hr>
            <div class="row mt-3">
                @if (count($client->profiles) != 0)
                    @foreach ($client->profiles as $profile)
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                            <div class="col mb-3">
                                <div class="card shadow">
                                    <img class="card-img-top" src="/img/netflix_welcome.png" alt="IMAGE" />
                                    <div class="card-body">
                                        <ul class="nav flex-column">
                                            <li class="nav-item h5">
                                                <i class="fas fa-at"></i>
                                                <strong class="badge badge-info">
                                                    {{ $profile->account->email }}
                                                </strong>
                                            </li>
                                            <li class="nav-item h5">
                                                <i class="fas fa-unlock-alt"></i>
                                                <strong class="badge badge-info">
                                                    {{ $profile->account->password }}
                                                </strong>
                                            </li>
                                            <li class="nav-item h5">
                                                <i class="fas fa-key"></i>
                                                <strong class="badge badge-info">{{ $profile->pin }}
                                                </strong>
                                            </li>
                                            <li class="nav-item h5"><strong class="badge badge-danger"> Expire dans
                                                    <span class="date_end">{{ $profile->date_end }}</span>
                                                    JOURS</strong> </li>
                                            <li class="nav-item h5">
                                                <a href="#">
                                                    <strong class="badge badge-primary"> Historiques des paiements</strong>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="d-flex justify-content-center">
                        <div class="alert alert-primary h3">
                            Ce client n'a aucun abonnement en cours.
                        </div>
                    </div>
                @endif
            </div>
        </div>
        @endisset
    </div>
@endsection

@section('script')
    <script src="/js/app.js"></script>

@endsection
