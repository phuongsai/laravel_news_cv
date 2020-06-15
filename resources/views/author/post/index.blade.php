@extends('layouts.backend.app')

@section('title','Post')

@push('css')
<!-- JQuery DataTable Css -->
<link href="{{ asset('assets/backend/vendor/datatables/dataTables.bootstrap4.min.css') }}"
    rel="stylesheet">
@endpush

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">ALL POSTS</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Posts
            <span class="badge badge-primary">{{ $posts->count() }}</span>
        </h6>
        <a class="btn btn-primary" href="{{ route('auth.posts.create') }}">Add New</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>View</th>
                        <th>Is Approved</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>View</th>
                        <th>Is Approved</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @forelse($posts as $key => $post)
                    <tr class="text-center">
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->user->name }}</td>
                        <td>{{ $post->view_count }}</td>
                        <td>
                            @if($post->is_approved == true)
                                <span class="badge badge-pill badge-secondary">Approved</span>
                            @else
                                <span class="badge badge-pill badge-warning">Pending</span>
                            @endif
                        </td>
                        <td>
                            @if ($post->deleted_at != null)
                                <span class="badge badge-pill badge-danger">Deleted</span>
                            @else
                                @unless($post->status != 1)
                                    <span class="badge badge-pill badge-primary">Published</span>
                                @else
                                    <span class="badge badge-pill badge-info">Draft</span>
                                @endunless
                            @endif
                        </td>
                        <td>{{ $post->created_at }}</td>
                        <td class="text-center">
                            @if (Auth::id() == 1)
                                @unless ($post->deleted_at != null)
                                <a href="{{ route('admin.post.show', $post) }}" class="btn btn-info">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{ route('auth.posts.edit',$post) }}" class="btn btn-secondary">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button class="btn btn-danger" type="button"
                                    onclick="deletePost({{ $post->id }})">
                                    <i class="fa fa-trash-alt"></i>
                                </button>
                                <form id="delete-form-{{ $post->id }}"
                                    action="{{ route('admin.post.destroy',$post) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                @else
                                <button class="btn btn-danger" type="button"
                                    onclick="restorePost({{ $post->id }})">
                                    <i class="fa fa-undo"></i>
                                </button>
                                <form id="restore-form-{{ $post->id }}"
                                    action="{{ route('admin.post.update',$post->id) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('PUT')
                                </form>
                                @endunless
                            @else
                                @if($post->is_approved == true)
                                <a href="{{ route('post.details',$post) }}" class="btn btn-info">
                                    <i class="fa fa-eye"></i>
                                </a>
                                @else
                                <button class="btn btn-danger" type="button"
                                    onclick="reviewPost({{ $post->id }})">
                                    <i class="fa fa-share" aria-hidden="true"></i>
                                </button>
                                <form id="review-form-{{ $post->id }}"
                                    action="{{ route('auth.posts.review',$post) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                                @endif
                            <a href="{{ route('auth.posts.edit',$post) }}" class="btn btn-info">
                                <i class="fa fa-edit"></i>
                            </a>
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
@endsection

@push('js')
@include('layouts.backend.partials.dataTable')
<script type="text/javascript">
    // confirm delete function
function deletePost(id){
        confirmSubmit('delete', id);
    }
function restorePost(id){
        confirmSubmit('restore', id);
    }
function reviewPost(id){
        confirmSubmit('review', id);
    }
</script>

@endpush