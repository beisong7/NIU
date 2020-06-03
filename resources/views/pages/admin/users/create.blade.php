@extends('layouts.main')

@section('content')
    <!-- Page-Title -->
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title mb-1">Accounts</h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Dashboard</li>
                        <li class="breadcrumb-item text-white">New Prospect </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">

                            <h4 class="header-title">New Prospect</h4>
                            <p class="card-title-desc">Create a new Prospect account</p>

                            @include('layouts.notice')

                            <form action="{{ route('create.user') }}" method="post">
                                @csrf
                                <input type="hidden" name="type" value="admin">
                                <div class="form-group row">
                                    <label for="firstName" class="col-md-2 col-form-label">First Name</label>
                                    <div class="col-md-10">
                                        <input class="form-control" id="firstName" type="text" placeholder="First Name" autocomplete="off" name="firstName" value="{{ old('firstName') }}" required="required">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="lastName" class="col-md-2 col-form-label">Last Name</label>
                                    <div class="col-md-10">
                                        <input class="form-control" id="lastName" type="text" placeholder="Last Name" autocomplete="off" name="lastName" value="{{ old('lastName') }}" required="required">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-2 col-form-label">Email</label>
                                    <div class="col-md-10">
                                        <input class="form-control" id="email" type="email" placeholder="Email" autocomplete="off" name="email" value="{{ old('email') }}" required="required">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="phone" class="col-md-2 col-form-label">Phone</label>
                                    <div class="col-md-10">
                                        <input class="form-control" id="phone" type="text" placeholder="phone number" autocomplete="off" name="phone" value="{{ old('phone') }}" required="required">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="status" class="col-md-2 col-form-label">Category</label>
                                    <div class="col-md-10">
                                        <select name="status" class="form-control" id="status" required="required">
                                            <option value="lead">Lead</option>
                                            <option value="opportunity">Opportunity</option>
                                            <option value="outright sale">Outright Sale</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="firstName" class="col-md-2 col-form-label">Create</label>
                                    <div class="col-md-10">
                                        <div class="row">
                                            <div class="col-6">
                                                <button class="btn btn-block btn-outline-secondary">Submit </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>
    <!-- end page-content-wrapper -->
@endsection

@section('custom_js')
    <script src="{{ asset('admin/libs/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('admin/libs/jqvmap/maps/jquery.vmap.usa.js') }}"></script>

    <script src="{{ asset('admin/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('admin/js/pages/dashboard.init.js') }}"></script>

    {{--<script src="{{ asset('admin/js/pages/datatables.init.js') }}"></script>--}}

    <script>
        $('#datatable').DataTable();
    </script>
@endsection





