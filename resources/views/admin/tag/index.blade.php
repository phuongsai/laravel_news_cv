@extends('layouts.backend.app')

@section('title','Tag')

@push('css')
<!-- JQuery DataTable Css -->
<link href="{{ asset('assets/backend/vendor/datatables/dataTables.bootstrap4.min.css') }}"
    rel="stylesheet">
@endpush

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">ALL TAGS</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Tags
            <span class="badge badge-primary">{{ $tags->count() }}</span>
        </h6>
        <a class="btn btn-primary" href="{{ route('admin.tag.create') }}">Add New</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Name</th>
                        <th>Post Count</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Name</th>
                        <th>Post Count</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @forelse($tags as $key => $tag)
                    <tr class="text-center">
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $tag->name }}</td>
                        <td>{{ $tag->posts_count }}</td>
                        <td>{{ $tag->created_at }}</td>
                        <td>{{ $tag->updated_at }}</td>
                        <td class="text-center">
                            @if (strtolower($tag->name) == 'other')
                            <button class="btn btn-info" disabled>
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-danger" type="button" disabled>
                                <i class="fa fa-trash-alt"></i>
                            </button>
                            @else
                            <a href="{{ route('admin.tag.edit',$tag) }}" class="btn btn-info">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button class="btn btn-danger" type="button"
                                onclick="deleteTag({{ $tag->id }})">
                                <i class="fa fa-trash-alt"></i>
                            </button>
                            <form id="delete-form-{{ $tag->id }}"
                                action="{{ route('admin.tag.destroy',$tag->id) }}" method="POST"
                                style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
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
    function deleteTag(id) {
        confirmSubmit('delete', id);
        }
</script>
@endpush