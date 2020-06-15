@extends('layouts.frontend.app')

@section('title')
{{ $post->title }}
@endsection

@section('content')
    <div class="container py-8">
        <div class="flex flex-col items-center">
            <div class="w-full flex flex-col md:flex-row items-center md:items-start --mx-5">
                <!-- Left Content-->
                <div class="w-full md:w-3/5 lg:w-2/3 px-5">
                    <div class="card overflow-hidden post mx-auto h-auto w-full text-grey-darkest text-xl">
                        <!-- Post cover image-->
                        <div class="post__image w-full">
                            <img src="{{ $post->image }}" alt="{{ $post->slug}}">
                        </div>
                        <!-- /Post cover image-->
                        <div class="post__content py-8 px-10 lg:py-16 lg:px-20 lg:flex items-start">
                            <div class="w-full">
                                <header class="post__header">
                                    <!-- Post title-->
                                    <h1 class="text-center mb-0">{{ $post->title }}</h1>
                                    <!-- /Post title-->
                                    <div class="post__footer flex items-start justify-center py-2 px-0">
                                        <div class="post__author text-center">
                                            <!-- Author avatar-->
                                            <img class="inline-block rounded-full w-12 mb-2" src="{{ $post->user->image }}">
                                            <!-- Author avatar-->

                                            <!-- Date Time + Author name-->
                                            <div class="author__content leading-none">
                                                <span class="label text-xs mb-0 mx-auto inline-block leading-loose">
                                                    <span class="text-grey">{{ customDateFormat($post->created_at) }}</span>
                                                    <span class="text-grey"> / </span>
                                                    <a class="text-red whitespace-no-wrap hover:text-red-darker transition"
                                                        href="{{ route('author.profile', $post->user->username) }}">{{ $post->user->name }}</a>
                                                </span>
                                            </div>
                                            <!-- /Date Time + Author name-->
                                        </div>
                                    </div>
                                </header>
                                <!-- Content-->
                                {!! $post->body !!}
                                <!-- Tag - Category-->
                                <span class="text-sm mb-0 mx-auto inline-block"><b>Filed in:</b>
                                    <!-- Categories -->
                                    @foreach ($post->categories as $category)
                                        <a class="text-red hover:text-red-darker transition"
                                        href="{{ route('category.posts', $category->slug) }}">{{ $category->name }}</a>
                                        <span class="text-grey"> / </span>
                                    @endforeach

                                    <!-- Tags -->
                                    @foreach ($post->tags as $tag)
                                        <a class="link--black" href="{{ route('tag.posts', $tag->slug) }}">{{ $tag->name }}</a>
                                        @if (!$loop->last)
                                            <span class="text-grey"> / </span>
                                        @endif
                                    @endforeach
                                </span>
                                <!-- /Tag - Category-->
                                <!-- /Content-->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Left Content-->
                <!-- Right sidebar -->
                <div class="w-full md:w-2/5 lg:w-1/3 px-5">
                    @include('layouts.frontend.partials.sidebar')
                </div>
                <!-- /Right sidebar -->
            </div>
        </div>
    </div>
    <!-- Pagination left-right with link-->
    @include('layouts.frontend.partials.next_prev_post')
    <!-- /Pagination left-right with link-->
@endsection
