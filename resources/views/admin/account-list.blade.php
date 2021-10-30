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
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accounts as $account)
                                    <tr>
                                        <td class="text-center">{{ $account->id }}</td>
                                        <td class="text-center">{{ $account->email }}</td>
                                        <td class="text-center">{{ $account->password }}</td>
                                        <td class="text-center">{{ count($account->profiles) }}</td>
                                        <td class="d-flex align-items-center justify-content-center">
                                            <a type="button" class="btn btn-primary shadow">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a href="{{ route('show.account', ['id' => $account->id]) }}" type="button"
                                                class="btn btn-warning mx-1 shadow">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a data-toggle="modal" role="button" data-target="#deleteAccountModal" data-del-account="{{ $account->id }}"
                                                class="delete-btn btn btn-danger mx-1 shadow">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
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

    <!-- Delete Account Modal-->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Supprimer le compte</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Si vous supprimer le compte, l'abonnements des clients sur ce compte seront
                    aussi supprimés.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                    <a class="btn btn-primary" onclick="event.preventDefault(); submitDeleteForm()">{{ __('Supprimer') }}</a>
                    <form id="delete-form" method="POST" style="display: none;">
                        @csrf
                    </form>
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
    <script src="/js/app.js"></script>
@endsection
