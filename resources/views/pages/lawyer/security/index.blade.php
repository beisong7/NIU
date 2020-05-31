@extends('layouts.main')

@section('content')
    <!-- Page-Title -->
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title mb-1">Security</h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Update Security Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h5>Password Settings</h5>
                                    <p class="text-muted">{{ $person->name }}, Update your password information from here.</p>

                                    <div class="mt-4">
                                        @if($person->san)
                                            <a href="#" class="btn btn-primary btn-sm">SAN!<i class="mdi mdi-arrow-right ml-1"></i></a>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-5 ml-auto">
                                    <div>
                                        <img src="{{ url('images/svg/lawyer.svg') }}" alt="" class="img-fluid float-right" style="width: 100px;">
                                        {{--<img src="{{ url('admin/images/widget-img.png') }}" alt="" class="img-fluid">--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="header-title mb-4">Password Change</h5>
                            @include('layouts.notice')
                            <form action="{{ route('lawyer.change.password') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 mb-4">
                                            <label for="">Current Password</label>
                                            <input type="password" placeholder="Current Password" name="current" class="form-control" value="{{ old('current') }}">
                                        </div>
                                        <hr>
                                        <div class="col-12 mb-4">
                                            <label for="">New Password</label>
                                            <input type="password" placeholder="New Password" class="form-control" name="new_password" value="{{ old('new_password') }}">
                                        </div>
                                        <div class="col-12 mb-4">
                                            <label for="">Confirm New Password</label>
                                            <input type="password" placeholder="Confirm New Password" class="form-control" name="new_password_confirm" value="{{ old('new_password_confirm') }}">
                                        </div>

                                        <div class="col-12 mb-4">
                                            <button class="btn btn-primary">Update Password</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- end page-content-wrapper -->
@endsection



