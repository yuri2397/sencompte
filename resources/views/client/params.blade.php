@extends('layouts.app')
@section('nav')
    @toastr_css

@endsection
@section('content')
    <section id="hero" style="height: 100%" class="d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-lg-12 d-flex flex-column justify-content-center   pt-lg-0 order-2 order-lg-1"
                    data-aos="fade-up" data-aos-delay="200">
                    <div>
                        <div class="card card-body">
                            <div class="row">
                                <div class="col-md-4 my-3">
                                    <div class="card shadow-sm card-body">
                                        <img class="rounded-circle" src="/img/undraw_profile.svg">
                                        <hr>
                                        <div class="card-title h3 text-center">
                                            {{ $client->first_name }} {{ $client->last_name }}
                                        </div>
                                        <div class="card-title h5 text-primary text-center">
                                            {{ $client->email }}
                                        </div>
                                        <div class="card-title h5 p-3 text-center">
                                            @if ($client->email_verified_at != null)
                                                    compte activé
                                            @else

                                                    <div class="alert alert-danger">
                                                        compte non activé
                                                    </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card shadow-sm card-body">
                                        <h3>Modifier votre mot de passe</h3>
                                        <form class="my-2" action="/client/change-password" method="post">
                                            @csrf
                                            @error('message')
                                                <div class="shadow-sm text-center alert alert-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            @error('success')
                                                <div class="shadow-sm text-center alert alert-success">
                                                    {{ $success }}
                                                </div>
                                            @enderror
                                            <div class="form-group my-3">
                                                <label for="password">Mot de passe actuel</label>
                                                <input type="text" class="form-control" name="password" id="password"
                                                    placeholder="Mot de passe actuel">
                                            </div>
                                            <div class="form-group my-3">
                                                <label for="new_password">Nouveau mot de passe</label>
                                                <input type="text" class="form-control" name="new_password"
                                                    id="new_password" placeholder="nouveau mot de passe">
                                            </div>
                                            <button name="submit_btn" id="submit_btn" class="btn btn-primary shadow-sm"
                                                role="button">Valider</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    @jquery
    @toastr_js
    @toastr_render
@endsection
