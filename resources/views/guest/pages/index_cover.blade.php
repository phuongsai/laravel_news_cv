@forelse ($mostReadPosts as $post)
    @if($loop->first)
        <!-- Big post -->
        <div class="float-left md-col-7 lg-col-8 card card--lg bg-black">
            <a href="{{ route('post.details', $post) }}"
                class="card__image bg-grey-lighter">
                <img class="block group-hover:opacity-50 transition" src="{{ $post->image }}"
                    alt="{{ $post->slug }}">
            </a>
            <div class="card__content">
                <span class="label text-sm">{{ $post->categories->first()->name }}</span>
                <h3 class="text-4xl mb-2">
                    <a href="{{ route('post.details', $post) }}" class="text-white">
                        {{ $post->title }}
                    </a>
                </h3>
            </div>
        </div>
        <!-- /Big post -->

        <!-- Newsletter -->
        <div class="float-left md-col-5 lg-col-4 card bg-red">
            @include('layouts.frontend.partials.newsletter_form')
        </div>
        <!-- /Newsletter -->
    @endif

    <!-- Post -->
    <div class="float-left md-col-5 lg-col-4 card bg-black">
        <a href="{{ route('post.details', $post) }}" class="card__image bg-grey-lighter">
            <img src="{{ $post->image }}" alt="{{ $post->slug }}">
        </a>
        <div class="card__content">
            <span class="label text-xs">{{ $post->categories->first()->name }}</span>
            <h3 class="text-base leading-none mb-0">
                <a href="{{ route('post.details', $post) }}" class="text-white text-base">
                    {{ $post->title }}
                </a>
            </h3>
        </div>
    </div>
    <!-- /Post -->
@empty

@endforelse
