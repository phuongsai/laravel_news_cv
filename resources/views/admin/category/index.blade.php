@extends('layouts.backend.app')

@section('title','Category')

@push('css')
<!-- JQuery DataTable Css -->
<link href="{{ asset('assets/backend/vendor/datatables/dataTables.bootstrap4.min.css') }}"
    rel="stylesheet">
@endpush

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">ALL CATEGORIES</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Categories
            <span class="badge badge-primary">{{ $categories->count() }}</span>
        </h6>
        <a class="btn btn-primary" href="{{ route('admin.category.create') }}">Add New</a>
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
                    @forelse($categories as $key => $category)
                    <tr class="text-center">
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->posts->count() }}</td>
                        <td>{{ $category->created_at }}</td>
                        <td>{{ $category->updated_at }}</td>
                        <td class="text-center">
                            @if (strtolower($category->name) == 'other')
                            <button class="btn btn-info" type="button" disabled>
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-danger" type="button" disabled
                                onclick="deleteCategory({{ $category->id }})">
                                <i class="fa fa-trash-alt"></i>
                            </button>
                            @else
                            <a href="{{ route('admin.category.edit',$category) }}" class="btn btn-info">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button class="btn btn-danger" type="button"
                                onclick="deleteCategory({{ $category->id }})">
                                <i class="fa fa-trash-alt"></i>
                            </button>
                            <form id="delete-form-{{ $category->id }}"
                                action="{{ route('admin.category.destroy',$category->id) }}" method="POST"
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
    function deleteCategory(id) {
        confirmSubmit('delete', id);
    }
</script>
@endpush