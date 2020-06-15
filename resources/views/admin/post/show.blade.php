@extends('layouts.backend.app')

@section('title','Post Detail')

@push('css')
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
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Post Detail</h1>
</div>

<!-- Content Row -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <a href="{{ route('auth.posts.index') }}" class="btn btn-danger"><i class="fa fa-chevron-left" aria-hidden="true"></i> BACK</a>
                <div>
                    <form method="post" action="{{ route('admin.post.approve',$post->id) }}"
                        id="approval-form-{{ $post->id }}" style="display: none">
                        @csrf
                        @method('PUT')
                    </form>
                </div>
                @if($post->is_approved == false)
                <button type="button" class="btn btn-success pull-right" onclick="approvePost({{ $post->id }})">
                    <i class="fa fa-check"></i>
                    <span>Approve</span>
                </button>
                @else
                <button type="button" class="btn btn-success pull-right" onclick="approvePost({{ $post->id }})">
                    <i class="fa fa-undo"></i>
                    <span>Un-Approved</span>
                </button>
                @endif

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="form-group row mb-4">
                            <label class="text-md-right col-12 col-md-3 col-lg-3">Title:</label>
                            <div class="col-sm-12 col-md-6">
                                <span><strong>{{ $post->title }}</strong></span>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="text-md-right col-12 col-md-3 col-lg-3">Author:</label>
                            <div class="col-sm-12 col-md-6">
                                <span><i>{{ $post->user->name }}</i></span>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="text-md-right col-12 col-md-3 col-lg-3">Created at:</label>
                            <div class="col-sm-12 col-md-6">
                                <span>{{ $post->created_at }}</span>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="text-md-right col-12 col-md-3 col-lg-3">Category:</label>
                            <div class="col-sm-12 col-md-6">
                                @foreach($post->categories as $category)
                                <span class="badge badge-primary">{{ $category->name }}</span>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="text-md-right col-12 col-md-3 col-lg-3">Tag:</label>
                            <div class="col-sm-12 col-md-6">
                                @foreach($post->tags as $tag)
                                <span class="badge badge-secondary">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="form-group row mb-4">
                            <label class="text-md-right col-12 col-md-4 col-lg-4">Cover Image:</label>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="col-sm-12 col-md-6">
                                <img class="img-responsive thumbnail previewImg" src="{{ $post->image }}" alt="{{$post->slug}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-xl-12 col-md-12 mb-10">
                        <label class="col-12 col-md-3 col-lg-3">Content:</label>
                        <div class="col-sm-12 col-md-12">
                            {!! $post->body !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content Row -->

@endsection

@push('js')
<!-- JS confirm submit form -->
<script defer src="{{ asset('assets/backend/js/confirmSubmit.js') }}"></script>
<!-- sweetalert2 -->
<script defer src="{{ asset('assets/backend/js/sweetalert2.all.min.js') }}"></script>
<script>
    function approvePost(id) {
        confirmSubmit('approval', id);
    }
</script>

@endpush