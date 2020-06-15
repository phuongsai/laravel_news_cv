@extends('layouts.frontend.app')

@section('title','Category')

@section('content')
 <!-- Header description -->
 <div class="pt-24 pb-20 lg:px-8 bg-white">
    <div class="container px-5 lg:flex items-start justify-between">
       <div class="lg:w-2/3 lg:pr-12">
           <h1 class="font-bold text-3xl md:text-6xl text-red leading-tight">{{ $category->name }}</h1>
           <p class="font-miriam text-grey-darkest text-2xl md:text-3xl">Interested in learning more about
               Laravel? This section features tutorials on everything from
               getting started with Laravel, to expert topics, and everything in between.</p>
       </div>
       <div class="lg:w-1/3 mt-8 lg:mt-0">
           <div class="carbon-small carbon-shadow">
           </div>
       </div>
    </div>
</div>
<!-- /Header description -->

<div class="container px-5" style="height: auto !important;">
    @if ($posts->onFirstPage())
        @php
            $popular_posts = $category->posts()->approved()->published()->orderBy('view_count', 'desc')->take(6)->get();
        @endphp
        <!-- Popular Laravel 6 Block-->
        <div class="category pt-20">
            <header class="category__header">
                <h2 class="category__title">Popular {{ $category->name }}</h2>
            </header>
            <div class="gutter flex flex-wrap items-start">
                @forelse ($popular_posts as $post)
                    <a href="{{ route('post.details', $post) }}" class="card col w-1/3 mx-auto">
                        <div class="card__image">
                            <img src="{{ $post->image }}"
                                alt="{{ $post->slug }}">
                        </div>
                        <div class="card__content">
                            <span class="label text-xs">{{ customDateFormat($post->created_at) }}</span>
                            <h4>{{ $post->title }}</h4>
                        </div>
                    </a>
                @empty
                    <div class="lg:w-3/3 lg:pr-12">
                        <p>No post found!</p>
                    </div>
                @endforelse
            </div>
        </div>
        <!-- /Popular Laravel 6 Block-->
    @endif

    <!-- 12 Block blog-->
    <div class="category">
        <header class="category__header">
            <h2 class="category__title">Latest {{ $category->name }}</h2>
        </header>
        <!-- 12 Block -->
        <div class="gutter flex flex-wrap items-start">
            @forelse ($posts as $post)
                <a href="{{ route('post.details', $post) }}" class="card col w-1/3 mx-auto">
                    <div class="card__image">
                        <img src="{{ $post->image }}" alt="{{ $post->slug }}">
                    </div>
                    <div class="card__content">
                        <span class="label text-xs">{{ customDateFormat($post->created_at) }}</span>
                        <h4>{{ $post->title }}</h4>
                    </div>
                </a>
            @empty
                <div class="lg:w-3/3 lg:pr-12">
                    <p>No post found!</p>
                </div>
            @endforelse
            <!-- Pagination Left-Right -->
                {!! $posts->links() !!}
            <!-- /Pagination Left-Right -->
        </>
        <!-- /12 Block -->
    </div>
    <!-- /12 Block blog-->
</div>
<!-- 3 Block NewsLetter - End of post-->
@include('layouts.frontend.partials.sponsor')
@endsection