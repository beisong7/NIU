<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>NIU </title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="{{ asset('images/niu.png') }}"/>

    <!-- datepicker -->
    <link href="{{ asset('admin/libs/air-datepicker/css/datepicker.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- jvectormap -->
    <link href="{{ asset('admin/libs/jqvmap/jqvmap.min.css') }}" rel="stylesheet" />

    <!-- Bootstrap Css -->
    @if($person->theme === 'dark')
    @else
    @endif
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/bootstrap-dark.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    {{--<link href="{{ asset('admin/css/app.min.css') }}" rel="stylesheet" type="text/css" />--}}
    <link href="{{ asset('admin/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" />


</head>
<body data-topbar="colored">

    <div id="layout-wrapper">

        @include('layouts.admin.topbar')

        @include('layouts.admin.sidebar')

        <div class="main-content">

            <div class="page-content">
                @yield('content')
            </div>

            @include('layouts.admin.footer')
        </div>

    </div>

    {{--@include('layouts.admin.side')--}}


<script src="{{ asset('admin/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin/libs/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ asset('admin/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('admin/libs/node-waves/waves.min.js') }}"></script>

    <script src="https://unicons.iconscout.com/release/v2.0.1/script/monochrome/bundle.js"></script>

<!-- datepicker -->
<script src="{{ asset('admin/libs/air-datepicker/js/datepicker.min.js') }}"></script>
<script src="{{ asset('admin/libs/air-datepicker/js/i18n/datepicker.en.js') }}"></script>

<!-- apexcharts -->
<script src="{{ asset('admin/libs/apexcharts/apexcharts.min.js') }}"></script>

<script src="{{ asset('admin/libs/jquery-knob/jquery.knob.min.js') }}"></script>

<!-- Jq vector map -->

    @yield('custom_js')


<script src="{{ asset('admin/js/app.js') }}"></script>

</body>
</html>