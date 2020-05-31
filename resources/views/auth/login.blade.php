@extends('layouts.app')

@section('content')

    <form class="login100-form validate-form" method="post" action="{{ route('lawyer.validate') }}">
        {{ csrf_field() }}

        <div class=" flex-column flex-sm-row align-items-center justify-content-center">
            <img src="{{ asset('images/logo.png') }}" class="home-logo" alt="logo icon">
            <div class="texthead text-gold">Welcome Back to NIU Customer Relationship Management platform</div>
            <div class="description mt-2 text-gold">Kindly Supply your Username and Password to login</div>
            @include('layouts.notice')
        </div>

        <div class="wrap-input100 mt-5">
            <input class="input100" type="text" name="user_name" value="{{ old('user_name') }}" required="required" autocomplete="off" autofocus>
            <span class="focus-input100"></span>
            <span class="label-input100">Username</span>
        </div>


        <div class="wrap-input100 validate-input" data-validate="Password is required">
            <input class="input100" type="password" required="required" name="pass_word">
            <span class="focus-input100"></span>
            <span class="label-input100">Password</span>
        </div>

        <div class="flex-sb-m w-full p-t-3 p-b-32">
            <div class="contact100-form-checkbox">
                <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                <label class="label-checkbox100" for="ckb1">
                    Remember me
                </label>
            </div>

            <div>
                <a href="#" class="txt1">
                    Forgot Password?
                </a>
            </div>
        </div>


        <div class="container-login100-form-btn">
            <button class="login100-form-btn">
                Login
            </button>
        </div>

    </form>


@endsection



