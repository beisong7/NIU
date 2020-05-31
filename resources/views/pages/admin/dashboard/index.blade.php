@extends('layouts.main')

@section('content')
    <!-- Page-Title -->
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title mb-1">Dashboard</h4>
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
                                    <h5>Welcome Back!</h5>
                                    <p class="text-muted">{{ $person->name }}</p>

                                    <div class="mt-4">
                                        <p class="font-weight-bold">{{ empty($person->adminType)?'Analyst':'Super Admin' }}</p>
                                    </div>
                                </div>

                                <div class="col-5 ml-auto">
                                    <div>
                                        <img src="{{ url('admin/images/widget-img.png') }}" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="header-title mb-4">Lawyer Report</h5>
                            <div class="media">
                                <div class="media-body">
                                    <p class="text-muted mb-2">Total Lawyers on System</p>
                                    <h4>{{ $total }}</h4>
                                    <hr>
                                    <p class="text-muted mb-2">Inactive Lawyers </p>
                                    <h4>{{ $inactive }}</h4>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <form class="form-inline float-right">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control form-control-sm datepicker-here" data-range="true"  data-multiple-dates-separator=" - " data-language="en" placeholder="Select Date" />
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="far fa-calendar font-size-12"></i></span>
                                    </div>
                                </div>
                            </form>
                            <h5 class="header-title mb-4">Lawyers Report</h5>
                            <div id="yearly-sale-chart" class="apex-charts"></div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header bg-transparent p-3">
                            <h5 class="header-title mb-0">Lawyers Status</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="media my-2">

                                    <div class="media-body">
                                        <p class="text-muted mb-2">Active</p>
                                        <h5 class="mb-0">{{ $active }}</h5>
                                    </div>
                                    <div class="icons-lg ml-2 align-self-center">
                                        <i class="uim uim-check-circle"></i>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="media my-2">
                                    <div class="media-body">
                                        <p class="text-muted mb-2">Approved</p>
                                        <h5 class="mb-0">{{ $approved }}</h5>
                                    </div>
                                    <div class="icons-lg ml-2 align-self-center">
                                        <i class="uim uim-clock-nine"></i>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="media my-2">
                                    <div class="media-body">
                                        <p class="text-muted mb-2">Approved-Court</p>
                                        <h5 class="mb-0">{{ $approved }}</h5>
                                    </div>
                                    <div class="icons-lg ml-2 align-self-center">
                                        <i class="uim uim-clock-eight"></i>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="media my-2">
                                    <div class="media-body">
                                        <p class="text-muted mb-2">Submitted</p>
                                        <h5 class="mb-0">{{ $submitted }}</h5>
                                    </div>
                                    <div class="icons-lg ml-2 align-self-center">
                                        <i class="uim uim-layers-alt"></i>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="media my-2">
                                    <div class="media-body">
                                        <p class="text-muted mb-2">Rejected</p>
                                        <h5 class="mb-0">{{ $rejected }}</h5>
                                    </div>
                                    <div class="icons-lg ml-2 align-self-center">
                                        <i class="uim uim-exclamation-triangle"></i>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="float-right ml-2">
                                <a href="#">View all</a>
                            </div>
                            <h5 class="header-title mb-4">Lawyers</h5>

                            <div class="table-responsive">
                                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th scope="col">Enrollment Number</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($lawyers as $lawyer)
                                        <tr>
                                            <th scope="row"><a href="#">{{ $lawyer->EnrollmentNumber }}</a></th>
                                            <td>{{ $lawyer->fullname }}</td>
                                            <td>{{ $lawyer->Status }}</td>
                                            <td>{{ date('F d, Y', strtotime($lawyer->Created)) }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="View">
                                                        <i class="mdi mdi-eye"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="mdi mdi-trash-can"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
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





