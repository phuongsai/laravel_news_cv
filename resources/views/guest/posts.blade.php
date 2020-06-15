@extends('layouts.frontend.app')

@section('title','Posts')

@section('content')
    <div class="container py-8">
        <div class="flex flex-col md:flex-row items-center md:items-start justify-center --mx-5">
            <div class="w-full md:w-3/5 lg:w-2/3 px-5 mb-6">
                <h1 class="md:text-6xl mb-2">News</h1>
                @forelse ($posts as $post)
                   <div class="card w-full card--post mx-0">
                        <div class="post__image">
                            <a href="{{ route('post.details', $post) }}">
                                <img src="{{ $post->image }}" alt="{{ $post->slug }}">
                            </a>
                        </div>
                        <div class="post__content truncate text-grey">
                            <span class="label text-xs">
                                News
                                <span class="text-grey"> / </span>
                                <span class="text-grey">{{ customDateFormat($post->created_at) }}</span>
                            </span>
                            <h2 class="text-2xl md:text-4xl"><a class="text-red hover:text-red-dark transition"
                                href="{{ route('post.details', $post) }}">{{ $post->title }}</a></h2>
                            <p>{!! \Illuminate\Support\Str::words(strip_tags($post->body), 19, ' ...') !!}</p>
                            <a class="absolute bottom-0 z-200 text-grey-lighter text-sm hover:text-red transition"
                                href="{{ route('post.details', $post) }}">Read more…</a>
                        </div>
                        <div class="post__footer sm:flex items-end justify-between border-t border-grey-lightest py-4">
                            <div class="post__author flex items-center">
                                <img class="block rounded-full w-12 mr-4" src="{{ $post->user->image }}">
                                <div class="author__content leading-none">
                                    <h4 class="font-sans text-black font-bold mb-2">by
                                        <a class="text-red hover:text-red-darker transition" href="{{ route('author.profile', $post->user->username) }}">{{ $post->user->name }}</a>
                                        </h4>
                                    {{-- <div class="flex items-center text-sm author__links">
                                        <span class="inline-block"><a class="text-grey inline-block"
                                                href="https://twitter.com/@paulredmond" rel="nofollow"><svg
                                                    class="w-3 h-3 inline-block">
                                                    <use xlink:href="#icon-twitter" /></svg></a></span>
                                        <span class="inline-block"><a class="text-grey inline-block"
                                                href="https://github.com/paulredmond" rel="nofollow"><svg
                                                    class="w-3 h-3 inline-block">
                                                    <use xlink:href="#icon-github" /></svg></a></span>
                                    </div> --}}
                                </div>
                            </div>
                            <ul class="pt-3 sm:pt-0 flex items-center list-none pl-0">
                            </ul>
                        </div>
                    </div>
                @empty
                <div class="card w-full card--post mx-0">
                    <p>No post found!</p>
                </div>
                @endforelse

                <!-- Pagination left-right simple-->
                    {!! $posts->links() !!}
                <!-- Pagination left-right simple-->
            </div>
            <!-- Right sidebar-->
            <div class="w-full md:w-2/5 lg:w-1/3 px-5">
                @include('layouts.frontend.partials.sidebar')
            </div>
            <!-- /Right sidebar-->
        </div>
    </div>
@endsection
