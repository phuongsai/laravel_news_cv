@extends('layouts.backend.app')

@section('title','Settings')

@push('css')
<style>
    .previewImg {
        max-width: 150px;
        max-height: 150px;
        width: auto;
        height: auto;
        margin: 20px;
    }
</style>
@endpush

@section('content')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h3 class="m-0 font-weight-bold text-primary">
                    SETTINGS
                </h3>
            </div>
            <div class="card-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#profile_with_icon_title"><i
                                class="fa fa-user-circle"></i> UPDATE PROFILE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#change_password_with_icon_title"><i
                                class="fa fa-info-circle"></i> CHANGE PASSWORD</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div id="profile_with_icon_title" class="container tab-pane active">
                        <div class="form-group">
                            <div class="form-line">
                            </div>
                        </div>
                        <form method="POST" action="{{ route('profile.update') }}" class="form-horizontal"
                            enctype="multipart/form-data" id="formData">
                            @csrf
                            @method('PUT')
                            <div class="row clearfix">
                                <div class="text-md-right col-md-3 col-lg-3">
                                    <label for="name">Name:</label>
                                </div>
                                <div class="col-lg-9 col-md-19 col-sm-9 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="name" class="form-control"
                                                placeholder="Enter your name" name="name"
                                                value="{{ Auth::user()->name }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="text-md-right col-md-3 col-lg-3">
                                    <label for="email_address_2">Email Address:</label>
                                </div>
                                <div class="col-lg-9 col-md-19 col-sm-9 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="email_address_2" class="form-control"
                                                placeholder="Enter your email address" name="email"
                                                value="{{ Auth::user()->email }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="text-md-right col-md-3 col-lg-3">
                                    <label for="email_address_2">Profile Image:</label>
                                </div>
                                <div class="col-lg-9 col-md-19 col-sm-9 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="file" class="form-control" id="image" name="image"
                                                accept="image/*" onchange="loadPreview(this);">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div>
                                            <img id="preview_img" class="previewImg" src="{{ Auth::user()->image }}"
                                                alt="{{ Auth::user()->name}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="text-md-right col-md-3 col-lg-3">
                                    <label for="email_address_2">About:</label>
                                </div>
                                <div class="col-lg-9 col-md-19 col-sm-9 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea rows="5" name="about" id="about"
                                                class="form-control">{{ Auth::user()->about }}</textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary m-t-15">UPDATE</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="change_password_with_icon_title" class="container tab-pane fade">
                        <div class="form-group">
                            <div class="form-line">
                            </div>
                        </div>
                        <form method="POST" action="{{ route('password.update') }}" class="form-horizontal">
                            @csrf
                            @method('PUT')
                            <div class="row clearfix">
                                <div class="text-md-right col-md-3 col-lg-3">
                                    <label for="old_password">Old Password:</label>
                                </div>
                                <div class="col-lg-9 col-md-19 col-sm-9 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" id="old_password" class="form-control"
                                                placeholder="Enter your old password" name="old_password">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="text-md-right col-md-3 col-lg-3">
                                    <label for="password">New Password:</label>
                                </div>
                                <div class="col-lg-9 col-md-19 col-sm-9 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" id="password" class="form-control"
                                                placeholder="Enter your new password" name="password">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="text-md-right col-md-3 col-lg-3">
                                    <label for="confirm_password">Confirm Password:</label>
                                </div>
                                <div class="col-lg-9 col-md-19 col-sm-9 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" id="confirm_password" class="form-control"
                                                placeholder="Enter your new password again"
                                                name="password_confirmation">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary m-t-15">UPDATE</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<!-- global variable -->
<script type="text/javascript">
    var form = $('#formData');

    function loadPreview(input) {
        readURL(input);
    }
</script>
<!-- JQuery check changed -->
<script defer src="{{ asset('assets/backend/js/checkChange.js') }}"></script>
<!-- JQuery preview image -->
<script defer src="{{ asset('assets/backend/js/previewImg.js') }}"></script>

@endpush