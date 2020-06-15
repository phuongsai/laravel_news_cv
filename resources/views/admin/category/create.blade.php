@extends('layouts.backend.app')

@section('title','Category')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">New Category</h1>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h4>Create New Record</h4>
                    <a class="btn btn-danger" href="{{ route('admin.category.index') }}">BACK</a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.category.store') }}" id="formData">
                        @csrf
                        <div class="form-group row mb-6">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') ?? ''}}"
                                    autofocus>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Row -->
@endsection

@push('js')
    <!-- global variable -->
    <script type="text/javascript">
        var form = $('#formData');
    </script>

    <!-- JQuery check changed -->
    <script defer src="{{ asset('assets/backend/js/checkChange.js') }}"></script>
@endpush