@extends('layouts.admin')

@section('headers')
    <link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('main')

    <div class=" mx-3 card shadow">
        <div class="card-header h3">
            Email : <strong class="badge badge-primary">{{ $account->email }}</strong> - Passe : <strong
                class="badge badge-primary">{{ $account->password }}</strong>
        </div>
        <div class="card-body">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @isset($account)
                    @foreach ($account->profiles as $profile)
                        <div class="col mb-3">
                            <div class="card shadow">
                                <img src="/img/netflix_welcome.png" alt="IMAGE" />
                                <div class="card-body">
                                    <ul class="nav flex-column">
                                        <li class="nav-item h5"><strong class="badge badge-info"> Pin :
                                                {{ $profile->pin }}</strong></li>
                                        @if ($profile->client_id != null)
                                            <li class="nav-item h5"><strong class="badge badge-danger"> Expire dans
                                                    <span class="date_end">{{ $profile->date_end }}</span> JOURS</strong> </li>
                                        @endif
                                        <li class="nav-item h5">
                                            @if ($profile->client_id != null)

                                                <a href="{{ route('showClientProfile', ['id' => $profile->client->id]) }}">
                                                    <strong class="badge badge-primary"> Client :
                                                        {{ $profile->client->first_name }}
                                                        {{ $profile->client->last_name }}
                                                    </strong>
                                                </a>
                                            @else
                                                <strong class="badge badge-warning">
                                                    NEAN
                                                </strong>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endisset
            </div>
        </div>
    </div>

@endsection

@section('script')
    <!-- Page level plugins -->
    <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="/js/demo/datatables-demo.js"></script>
    <script src="/js/app.js"></script>
@endsection
