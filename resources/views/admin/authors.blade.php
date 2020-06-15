@extends('layouts.backend.app')

@section('title','Authors')

@push('css')
<!-- JQuery DataTable Css -->
<link href="{{ asset('assets/backend/vendor/datatables/dataTables.bootstrap4.min.css') }}"
    rel="stylesheet">
@endpush

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">ALL USERS</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">USERS
            <span class="badge badge-primary">{{ $authors->count() }}</span>
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Name</th>
                        <th>Posts</th>
                        <th>Created At</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Name</th>
                        <th>Posts</th>
                        <th>Created At</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @forelse($authors as $key => $author)
                    <tr class="text-center">
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $author->name }}</td>
                        <td>{{ $author->posts_count }}</td>
                        <td>{{ $author->created_at }}</td>

                        @if($author->deleted_at == null)
                        <td>
                            <span class="badge badge-pill badge-primary">Active</span>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-danger" type="button"
                                onclick="deleteAuthors({{ $author->id }})">
                                <i class="fa fa-trash-alt" aria-hidden="true"></i>
                            </button>
                            <form id="delete-form-{{ $author->id }}"
                                action="{{ route('admin.author.destroy', $author->id) }}" method="POST"
                                style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                        @else
                        <td>
                            <span class="badge badge-pill badge-secondary">Inactive</span>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-warning" type="button"
                                onclick="restoreAuthors({{ $author->id }})">
                                <i class="fa fa-undo" aria-hidden="true"></i>
                            </button>
                            <form id="restore-form-{{ $author->id }}"
                                action="{{ route('admin.author.restore', $author->id) }}" method="POST"
                                style="display: none;">
                                @csrf
                                @method('PUT')
                            </form>
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
@endsection


@push('js')
@include('layouts.backend.partials.dataTable')
<script type="text/javascript">
    function deleteAuthors(id) {
        confirmSubmit('delete', id);
    }

    function restoreAuthors(id) {
        confirmSubmit('restore', id);
    }
</script>

@endpush