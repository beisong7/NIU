@extends('layouts.errors')
@section('content')
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="mt-4 text-center">
                        <div class="row justify-content-center">
                            <div class="col-md-4 col-6">
                                <img src="{{ url('admin/images/error-img.png') }}" alt="" class="img-fluid mx-auto d-block">
                            </div>
                        </div>

                        <h1 class="mt-5 text-uppercase text-white font-weight-bold mb-3">Secure Session Lost!</h1>
                        <h5 class="text-white-50">Sorry! Your session is no longer secure. Click the Link below to Continue.</h5>
                        <div class="mt-5">
                            <a class="btn btn-dark waves-effect waves-light" href="{{ route('home') }}">Continue</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
    </div>

@endsection