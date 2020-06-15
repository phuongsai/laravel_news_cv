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
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">PENDING POSTS</div>
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

        <!-- CATEGORIES -->
        <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">CATEGORIES</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $category_count }}</div>
                </div>
                <div class="col-auto">
                <i class="fas fa-th-list fa-2x text-gray-300"></i>
                </div>
            </div>
            </div>
        </div>
        </div>

        <!-- TAGS -->
        <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">TAGS</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tag_count }}</div>
                </div>
                <div class="col-auto">
                <i class="fas fa-tag fa-2x text-gray-300"></i>
                </div>
            </div>
            </div>
        </div>
        </div>

        <!-- TOTAL USERS -->
        <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">TOTAL USERS</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $author_count }}</div>
                </div>
                <div class="col-auto">
                <i class="fas fa-user-circle-o fa-2x text-gray-300"></i>
                </div>
            </div>
            </div>
        </div>
        </div>

        <!-- TODAY USERS -->
        <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">TODAY NEW USERS</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $new_authors_today }}</div>
                </div>
                <div class="col-auto">
                <i class="fas fa-user fa-2x text-gray-300"></i>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">MOST POPULAR POST</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th>Rank</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Views</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($popular_posts as $key => $post)
                                <tr class="text-center">
                                    <td>{{ $key + 1 }}</td>
                                    <td class="text-left">{{ str_limit($post->title,'20') }}</td>
                                    <td>{{ $post->user->name }}</td>
                                    <td>{{ $post->view_count }}</td>

                                    @if($post->is_approved == 1)
                                    <td>
                                        <span class="label bg-green">Published</span>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-primary" target="_blank"
                                            href="{{ route('post.details', $post->slug) }}">View</a>
                                    </td>
                                    @else
                                    <td>
                                        <span class="label bg-red">Pending</span>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-primary" target="_blank"
                                            href="{{ route('admin.post.show', $post) }}">Review</a>
                                    </td>
                                    @endif
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

    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">TOP 10 ACTIVE AUTHOR</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th>Rank List</th>
                                    <th>Name</th>
                                    <th>Posts</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($active_authors as $key=>$author)
                                <tr class="text-center">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $author->name }}</td>
                                    <td>{{ $author->posts_count }}</td>
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