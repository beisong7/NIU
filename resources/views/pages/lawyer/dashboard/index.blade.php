@extends('layouts.main')

@section('content')
    <!-- Page-Title -->
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title mb-1">Profile</h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Welcome to Legal Mail Version 2</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h5>Welcome Back !</h5>
                                    <p class="text-muted">{{ $person->name }}</p>

                                    <div class="mt-4">
                                        @if($person->san)
                                            <a href="#" class="btn btn-primary btn-sm">SAN<i class="mdi mdi-arrow-right ml-1"></i></a>
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

                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="header-title mb-4">Lawyers Details</h5>
                            <table class="table">
                                <tbody>


                                @if(!empty($lawyer))

                                    <tr>
                                        <td> Username </td>
                                        <td>{{ $lawyer->Username }}</td>
                                    </tr>

                                    <tr>
                                        <td> First Name </td>
                                        <td>{{ $lawyer->FirstName }}</td>
                                    </tr>

                                    <tr>
                                        <td> Last Name </td>
                                        <td>{{ $lawyer->LastName }}</td>
                                    </tr>

                                    <tr>
                                        <td> Email </td>
                                        <td>{{ $lawyer->AlternativeEmail }}</td>
                                    </tr>

                                    <tr>
                                        <td> CreatedBy </td>
                                        <td>{{ $lawyer->CreatedBy }}</td>
                                    </tr>

                                @else
                                    <tr>
                                        <td>No Record Found | Contact Admin</td>
                                    </tr>
                                @endif
                                </tbody>

                            </table>

                        </div>
                    </div>
                </div>

            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- end page-content-wrapper -->
@endsection



