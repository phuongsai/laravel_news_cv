@extends('layouts.frontend.app')

@section('title','Profile')

@section('content')
    <!-- Header Profile -->
<div class="pt-24 pb-20 lg:px-8 bg-white">
    <div class="container px-5 lg:flex items-start justify-between">
        <div class="lg:w-2/3 lg:pr-12">
            <!-- Avatar + name-->
            <h1 class="font-bold text-3xl md:text-6xl text-red leading-tight">
                <img class="float-left w-16 h-16 rounded-sm mr-3" src="{{ $author->image }}" alt="{{ $author->username }}">
                {{ $author->name }}
            </h1>
            <!-- /Avatar + name-->
            <!-- About text -->
            <div class="text-2xl font-miriam text-grey-darkest mb-8">
                <p>{!! $author->about !!}</p>
            </div>
            <!-- /About text -->
            <!-- Social Connect-->
            {{-- <div class="mb-6">
                <div class="social inline-block">
                    <span class="label text-black text-xs">Follow</span>
                    <div class="flex items-center">
                        <a class="block mr-3 rounded-full p-2 flex items-center justify-center text-white hover:bg-black bg-twitter transition"
                            href="https://twitter.com/@dailylaravel">
                            <svg class="w-3 h-3 block">
                                <use xlink:href="#icon-twitter" /></svg>
                        </a>
                        <a class="block mr-3 rounded-full p-2 flex items-center justify-center text-white hover:bg-black bg-github transition"
                            href="https://github.com/laraveldaily">
                            <svg class="w-3 h-3 block">
                                <use xlink:href="#icon-github" /></svg>
                        </a>
                    </div>
                </div>
            </div> --}}
            <!-- /Social Connect-->
        </div>
        <div class="lg:w-1/3 mt-8 lg:mt-0 relative sponsor">
            <div class="carbon-small carbon-shadow">
            </div>
        </div>
    </div>
</div>
<!-- /Header Profile -->

<!-- 12 Post Related-->
<div class="container px-5">
    <div class="category pt-20">
        <header class="category__header">
            <h2 class="category__title">All Posts by {{ $author->name }}</h2>
        </header>
        <!-- 12 block post -->
        <div class="gutter flex flex-wrap items-start">
            @forelse ($posts as $post)
                <a href="{{ route('post.details',$post) }}" class="card w-1/3">
                    <div class="card__image">
                        <img src="{{ $post->image }}" alt="{{ $post->slug }}">
                    </div>
                    <div class="card__content">
                        <span class="label text-xs">{{ customDateFormat($post->created_at)}}</span>
                        <h4>{{ $post->title }}</h4>
                    </div>
                </a>
            @empty
                <p>No post found!</p>
            @endforelse
        </div>
        <!-- /12 block post -->
        <!-- pagination left-right -->
            {!! $posts->links() !!}
        <!-- /pagination left-right -->
    </div>
</div>
<!-- /12 Post Related-->
@endsection
