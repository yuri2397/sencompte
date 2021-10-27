@extends('layouts.admin')

@section('headers')
    <link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('main')

    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Compte netflix</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Compte netflix</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if ($accounts && count($accounts) != 0)
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Adresse email</th>
                                    <th>Mot de passe</th>
                                    <th>Nombre de profils</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accounts as $account)
                                    <tr>
                                        <td class="text-center">{{ $account->id }}</td>
                                        <td class="text-center">{{ $account->email }}</td>
                                        <td class="text-center">{{ $account->password }}</td>
                                        <td class="text-center">{{ count($account->profiles) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="card mb-4 py-3 border-bottom-danger">
                            <div class="card-body">
                                <h3>Aucun compte netflix</h3>
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
