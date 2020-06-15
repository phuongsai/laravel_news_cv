@extends('layouts.frontend.app')

@section('title','Tags')

@section('content')
<div class="container px-5" style="height: auto !important;">
    <!-- 12 Block blog-->
    <div class="category">
        <header class="category__header">
            <h2 class="category__title">Latest {{ $tag->name }}</h2>
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
