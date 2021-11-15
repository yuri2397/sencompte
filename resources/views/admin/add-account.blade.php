@extends('layouts.admin')

@section('headers')
@endsection

@section('main')
    <div class="row container ">
        <div class="card card-body">
            <div class="col-lg-12">
                <div class="p-5 d-flex justify-content-center">
                    <div class="col-12  ">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Ajouter un nouveau compte netflix</h1>
                        </div>
                        <form class="user" action="{{ route('add.account') }}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="account_email">Adresse email du compte</label>
                                    <input type="email" required
                                        class="form-control form-control-user @if ($errors->has('account_password')) is-invalid @endif"
                                        value{{ old('account_email') }} name="account_email" id="account_email">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="account_password">Mot de passe du compte</label>
                                    <input required type="text"
                                        class="form-control form-control-user @if ($errors->has('account_password')) is-invalid @endif"
                                        value="{{ old('account_password') }}" name="account_password"
                                        id="account_password">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user">
                                Ajouter le compte
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
