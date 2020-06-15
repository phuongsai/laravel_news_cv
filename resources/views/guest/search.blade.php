@extends('layouts.frontend.app')

@section('title', {{ $query ?? 'Search' }})

@section('content')
    <div class="container py-16 px-5">
        <div class="text-center mb-4 w-full">
        </div>
        <div class="gutter lg:flex items-start justify-between">
            <!-- Left 2/3 -->
            <div class="lg:w-2/3">
                <!-- Header information result search-->
                <div class="md:flex items-end justify-between mb-4">
                    <h2 class="text-3xl mb-0 leading-none">Results for: "{{ $query }}" </h2>
                    {{-- <div class="flex items-center">Powered by <img class="w-16" src="fonts/algolia.svg"></div> --}}
                </div>
                <!-- /Header information result search-->

                <!-- Show 12 results-->
                <div class="flex flex-wrap items-start justify-between gutter">
                    @forelse ($posts as $post)
                        <a href="{{ route('post.details', $post) }}" class="w-1/2 card min-h-0">
                            <div class="card__image">
                                <img src="{{ $post->image }}" alt="{{ $post->slug }}">
                            </div>
                            <div class="card__content">
                                <span class="label text-sm">{{ customDateFormat($post->created_at) }}</span>
                                <h4>{{ $post->title }}</h4>
                            </div>
                        </a>
                    @empty
                        <p>No post found!</p>
                    @endforelse
                </div>
                <!-- /Show 12 results-->

                <!-- Pagination Left-Right-->
                {!! $posts->links() !!}
                <!-- /Pagination Left-Right-->
            </div>
            <!-- /Left 2/3 -->

            <!-- Right Sidebar 1/3 -->
            @include('layouts.frontend.partials.sidebar')
            <!-- /Right Sidebar 1/3 -->
        </div>
    </div>
@endsection
