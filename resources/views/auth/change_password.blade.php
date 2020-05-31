@extends('layouts.app')

@section('content')

    <form class="login100-form validate-form" method="post" action="{{ route('password.reset.update') }}">
        {{ csrf_field() }}
        <input type="hidden" name="secret" value="{{ $secret }}">
        <div class=" flex-column flex-sm-row align-items-center justify-content-center">
            <img src="{{ asset('images/logo.png') }}" class="home-logo" alt="logo icon">

            <div style="color: #1b5e20" class="description mt-5">Enter new password .</div>
            @include('layouts.notice')
        </div>

        <div class="wrap-input100 validate-input" data-validate="Password is required">
            <input class="input100" type="password" required="required" name="pass_word">
            <span class="focus-input100"></span>
            <span class="label-input100">Password</span>
        </div>

        <div class="wrap-input100 validate-input" data-validate="Password is required">
            <input class="input100" type="password" required="required" name="confirm_pass_word">
            <span class="focus-input100"></span>
            <span class="label-input100">Confirm Password</span>
        </div>

        <div class="container-login100-form-btn">
            <button class="login100-form-btn">
                Reset My Password
            </button>
        </div>

        <a href="{{ route('home') }}" class="google btn btn-block btn-dark-info my-2 mx-auto" aria-label="LOG IN">
            <span> <span>I have an account</span></span>
        </a>
    </form>


@endsection



