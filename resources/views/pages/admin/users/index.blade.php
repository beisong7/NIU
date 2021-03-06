@extends('layouts.main')

@section('content')
    <!-- Page-Title -->
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title mb-1">Accounts</h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item text-white">{{ empty($title)?'All Accounts':$title }}</li>
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

                            <h4 class="header-title">{{ empty($title)?'Accounts':$title }}</h4>
                            <?php $info = $users->toArray() ?>
                            <p>Showing : {{ $info['from'] }} - {{ $info['to'] }} <i class="ml-3 mr-3"> of </i> {{ $info['total'] }}</p>

                            @include('layouts.notice')
                            <div class="table-responsive">
                                <table id="" class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>

                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Create Channel</th>
                                        <th scope="col">Assigned To</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Created</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->fullname }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->creatChannel }}</td>
                                            <td>{{ $user->assigned }}</td>
                                            <td>{{ $user->status }}</td>
                                            <td>{{ date('M d, Y', strtotime($user->created_at)) }}</td>
                                            <td>
                                                <div class="btn-group" role="group">

                                                    <a href="{{ route('preview.user', $user->uuid) }}" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Preview">
                                                        <i class="mdi mdi-check-circle"></i>
                                                    </a>
                                                    <a href="{{ route('edit.user', $user->uuid) }}" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <br>
                            {{ $users->links() }}
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





