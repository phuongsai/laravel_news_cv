@extends('layouts.backend.app')

@section('title','Post')

@push('css')
<!-- Bootstrap Select Css -->
<link href="{{ asset('assets/backend/vendor/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" />
<style>
    .previewImg {
        max-width: 300px;
        max-height: 450px;
        width: auto;
        height: auto;
        margin: 20px;
    }
</style>
@endpush

@section('content')
<!-- Content Row -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h4>Edit Recorded</h4>
                <a class="btn btn-danger" href="{{ route('auth.posts.index') }}">BACK</a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('auth.posts.update', $post) }}" enctype="multipart/form-data" id="formData">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title:</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" id="title" name="title" class="form-control" value="{{ $post->title ?? old('title')}}"
                                        autofocus>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Category:</label>
                                <div class="col-sm-12 col-md-7">
                                    <select name="categories[]" id="category" class="form-control selectpicker"
                                        data-live-search="true" multiple>
                                        @foreach($categories as $category)
                                        <option @foreach($post->categories as $postCategory)
                                            {{ $postCategory->id === $category->id ? 'selected' : '' }}
                                            @endforeach
                                            value="{{ $category->id }}"
                                            {{ (collect(old('categories'))->contains($category->id)) ? 'selected':'' }}>
                                            {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tag:</label>
                                <div class="col-sm-12 col-md-7">
                                    <select name="tags[]" id="tag" class="form-control selectpicker" data-live-search="true"
                                        multiple>
                                        @foreach($tags as $tag)
                                        <option @foreach($post->tags as $postTag)
                                            {{ $postTag->id == $tag->id ? 'selected' :'' }}
                                            @endforeach
                                            value="{{ $tag->id }}"
                                            {{ (collect(old('tags'))->contains($tag->id)) ? 'selected':'' }}>
                                            {{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="text-md-right col-12 col-md-3 col-lg-3">Publish:</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="checkbox" id="publish" class="filled-in" name="status" value="1"
                                    {{ $post->status == true ? 'checked' : '' }}>
                                </div>
                            </div>
                            @if (Auth::id() !== 1)
                            <div class="form-group row mb-4">
                                <label class="text-md-right col-12 col-md-3 col-lg-3">Request review:</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="checkbox" id="review" class="filled-in" name="review" value="1">
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="form-group row mb-4">
                                <label class="text-md-right col-12 col-md-3 col-lg-3">Cover Image:</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*"
                                    onchange="loadPreview(this);">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <div class="col-sm-12 col-md-7">
                                    <img id="preview_img" class="previewImg" src="{{ $post->image }}" alt="{{ $post->slug}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-xl-12 col-md-12 mb-10">
                            <label class="col-12 col-md-3 col-lg-3">Content:</label>
                            <textarea id="editor" name="body">{{ $post->body ?? old('body') }}</textarea>
                        </div>
                        <div class="col-xl-10 col-md-10 mb-10">
                            <button type="submit" class="btn btn-primary m-t-15">SUBMIT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Content Row -->

@endsection

@include('layouts.backend.partials.editor')