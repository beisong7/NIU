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
                        <li class="breadcrumb-item text-white">Editing {{ $user->fullName }}</li>
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

                            <h4 class="header-title">Account</h4>
                            <p class="card-title-desc">Edit / Preview account</p>

                            @include('layouts.notice')

                            {{--<form action="{{ route('update.user', $user->uuid) }}" method="post">--}}
                            <form action="#" method="post">
                                @csrf

                                <input type="hidden" name="type" value="admin">
                                <div class="form-group row">
                                    <label for="firstName" class="col-md-2 col-form-label">First Name</label>
                                    <div class="col-md-10">
                                        <input class="form-control" id="firstName" type="text" placeholder="First Name" autocomplete="off" name="firstName" value="{{ $user->first_name }}" required="required">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="lastName" class="col-md-2 col-form-label">Last Name</label>
                                    <div class="col-md-10">
                                        <input class="form-control" id="lastName" type="text" placeholder="Last Name" autocomplete="off" name="lastName" value="{{ $user->last_name }}" required="required">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-2 col-form-label">Email</label>
                                    <div class="col-md-10">
                                        <input class="form-control" id="email" type="email" placeholder="Email" autocomplete="off" name="email" value="{{ $user->email }}" required="required">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="phone" class="col-md-2 col-form-label">Phone</label>
                                    <div class="col-md-10">
                                        <input class="form-control" id="phone" type="text" placeholder="phone number" autocomplete="off" name="phone" value="{{ $user->phone }}" required="required">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="status" class="col-md-2 col-form-label">Category</label>
                                    <div class="col-md-10">
                                        <select name="status" class="form-control" id="status" required="required">
                                            <option value="lead" {{ $user->status==='lead'?'selected':'' }}>Lead</option>
                                            <option value="opportunity" {{ $user->status==='opportunity'?'selected':'' }}>Opportunity</option>
                                            <option value="outright sale" {{ $user->status==='outright sale'?'selected':'' }}>Outright Sale</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="more_info">
                                    @if($user->status !=='lead')
                                    <div class="form-group row _eject ">
                                        <label for="details" class="col-md-2 col-form-label">Commitment</label>
                                        <div class="col-md-10">
                                            <input name="amount" id="details" class="form-control" value="{{ old('amount') }}" required autocomplete="off" placeholder="Amount" />
                                        </div>
                                    </div>
                                        @endif
                                </div>

                                <div class="form-group row">
                                    <label for="firstName" class="col-md-2 col-form-label">Complete</label>
                                    <div class="col-md-10">
                                        <div class="row">
                                            <div class="col-6">
                                                <button class="btn btn-block btn-outline-secondary">Update </button>
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

        $('#status').on('change', function () {
            let elem = $('.more_info');
            let field = `<div class="form-group row _eject ">
                                        <label for="details" class="col-md-2 col-form-label">Commitment</label>
                                        <div class="col-md-10">
                                            <input name="amount" id="details" class="form-control" value="" required autocomplete="off" placeholder="Amount" />
                                        </div>
                                    </div>`;
            if($(this).val()==='opportunity'||$(this).val()==='outright sale'){
                if(elem.children().length < 1){
                    elem.append(field);
                }
            }else{
                $('._eject').remove();
            }
        });
    </script>
@endsection





