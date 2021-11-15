@extends('layouts.admin')

@section('headers')
    <link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    @toastr_css
@endsection

@section('main')

    <div class="container">
        <div class="card card-body">
            <div class="row">
                <div class="col-4">
                    <div class="card shadow-sm card-body">
                        <img class="rounded-circle" src="/img/undraw_profile.svg">
                        <hr>
                        <div class="card-title h3 text-center">
                            {{ $admin->name }}
                        </div>
                        <div class="card-title h5 text-primary text-center">
                            {{ $admin->email }}
                        </div>
                        <div class="card-title h5 badge badge-primary p-3 text-center">
                            @if (Auth::guard('admin')->check())
                                super administrateur
                            @else
                                administrateur
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="card shadow-sm card-body">
                        <h3>Modifier votre mot de passe</h3>
                        <form class="my-2" action="/admin/change-password" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="password">Mot de passe actuel</label>
                                <input type="text" class="form-control" name="password" id="password"
                                    placeholder="Mot de passe actuel">
                            </div>
                            <div class="form-group">
                                <label for="new_password">Nouveau mot de passe</label>
                                <input type="text" class="form-control" name="new_password" id="new_password"
                                    placeholder="nouveau mot de passe">
                            </div>
                            <button name="submit_btn" id="submit_btn" class="btn btn-primary shadow-sm"
                                role="button">Valider</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <!-- Page level custom scripts -->
    <script src="/js/demo/datatables-demo.js"></script>
    <script src="/js/app.js"></script>
    @toastr_js
    @toastr_render
@endsection
