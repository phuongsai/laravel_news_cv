@extends('layouts.backend.app')

@section('title','Dashboard')

@push('css')
<!-- JQuery DataTable Css -->
<link href="{{ asset('assets/backend/vendor/datatables/dataTables.bootstrap4.min.css') }}"
    rel="stylesheet">
@endpush

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- TOTAL POSTS -->
        <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">TOTAL POSTS</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_posts }}</div>
                </div>
                <div class="col-auto">
                <i class="fas fa-book fa-2x text-gray-300"></i>
                </div>
            </div>
            </div>
        </div>
        </div>

        <!-- PENDING POSTS -->
        <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">PENDING POSTS</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_pending_posts }}</div>
                </div>
                <div class="col-auto">
                <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                </div>
            </div>
            </div>
        </div>
        </div>

        <!-- TOTAL VIEWS -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">TOTAL VIEWS</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $all_views }}</div>
                    </div>
                    <div class="col-auto">
                    <i class="fas fa-eye fa-2x text-gray-300"></i>
                    </div>
                </div>
                </div>
            </div>
        </div>


    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-8 col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">TOP 5 POPULAR POSTS</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th>Rank List</th>
                                    <th>Title</th>
                                    <th>Views</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($popular_posts as $key => $post)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ str_limit($post->title,30) }}</td>
                                    <td>{{ $post->view_count }}</td>
                                    <td>
                                        @if($post->status == true)
                                            <span class="label bg-green">Published</span>
                                        @else
                                            <span class="label bg-red">Pending</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                    <p>No data!</p>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@include('layouts.backend.partials.dataTable')
@endpush