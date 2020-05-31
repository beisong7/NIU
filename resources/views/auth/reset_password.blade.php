@extends('layouts.app')

@section('content')

    <form class="login100-form validate-form" method="post" action="{{ route('password.reset.start') }}">
        {{ csrf_field() }}

        <div class=" flex-column flex-sm-row align-items-center justify-content-center">
            <img src="{{ asset('images/logo.png') }}" class="home-logo" alt="logo icon">
            <div class="texthead">Password Reset</div>
            <div style="color: #1b5e20; font-size: 10px" class="description mt-2">Kindly Supply your Username and the last fout (4) digits of your phone number.</div>
            @include('layouts.notice')
        </div>

        <div class="wrap-input100 mt-5">
            <input class="input100" type="text" name="user_name" value="{{ old('user_name') }}" required="required" autocomplete="off" autofocus>
            <span class="focus-input100"></span>
            <span class="label-input100">Username</span>
        </div>

        <div class="wrap-input100 ">
            <input class="input100 allowed_characters" onkeypress="return allowCharacters(4)" type="text" required="required" name="last_four" autocomplete="off">
            <span class="focus-input100"></span>
            <span class="label-input100">Last Four (4) Digits of Phone Number</span>
        </div>

        <div class="container-login100-form-btn">
            <button class="login100-form-btn">
                Reset Password
            </button>
        </div>

        <a href="{{ route('home') }}" class="google btn btn-block btn-dark-info my-2 mx-auto" aria-label="LOG IN">
            <span> <span>I have an account</span></span>
        </a>
    </form>


@endsection


@section('custom_js')
    <script>
        function allowCharacters(length) {
            let field = $('.allowed_characters');
            if(field.val().length >= length){
                return false;
            }else{
                return true
            }
        }
    </script>

@endsection




