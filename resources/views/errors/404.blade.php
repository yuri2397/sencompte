@extends('layouts.app')
@section('nav')
    @toastr_css

@endsection
@section('content')
    <section id="hero" style="height: 100%" class="d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-lg-12 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1"
                    data-aos="fade-up" data-aos-delay="200">

                    <div class="why-us section-bg">
                        <div class="row">
                            <div class="col-lg-12 text-center d-flex flex-column justify-content-center">
                                <div>
                                    <img style="width:40%" src="
                                    /img/404.jpg" alt="404 PAGE NOT FOUND">
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
