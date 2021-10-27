@extends('layouts.admin')

@section('headers')
    <link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('main')

    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Compte client</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Compte client</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if ($clients && count($clients) != 0)
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Prénoms</th>
                                    <th>Nom</th>
                                    <th>Adresse email</th>
                                    <th>Abonnements</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clients as $client)
                                    <tr>
                                        <td class="text-center">{{ $client->id }}</td>
                                        <td class="text-center">{{ $client->first_name }}</td>
                                        <td class="text-center">{{ $client->last_name }}</td>
                                        <td class="text-center">{{ $client->email }}</td>
                                        <td class="text-center">{{ count($client->profiles) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="card mb-4 py-3 border-bottom-danger">
                            <div class="card-body">
                                <h3>Aucun client</h3>
                            </div>
                        </div>
                    @endif

                </div>
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
@endsection
