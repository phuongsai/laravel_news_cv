@extends('layouts.frontend.app')

@section('title','Homepage')

@section('content')
    <!-- Cover -->
    <div class="px-5 md:p-10">
        <div class="container">
            <div class="gutter clearfix">
                @include('guest/pages/index_cover')
            </div>
        </div>
    </div>
    <!-- /Cover -->

    <div class="bg-off-white px-5 md:px-8 py-10 md:py-24" style="height: auto !important;">
        <div class="container" style="height: auto !important;">
            <!-- Latest Posts -->
            @include('guest/pages/index_latest_post')
            <!-- Latest Posts -->

            <!-- Trending Posts -->
            @include('guest/pages/index_trending_post')
            <!-- /Trending Posts -->

            <!-- Tutorial -->
            @include('guest/pages/index_category')
            <!-- /Tutorial -->

            <!-- Event -->
            <!-- /Event -->

            <!-- Links -->
            {{-- @include('guest/index_links') --}}
            <!-- /Links -->
        </div>
    </div>
@endsection