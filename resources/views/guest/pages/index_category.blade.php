<div class="category mb-10">
    <header class="category__header">
        <h2 class="category__title"><a href="{{ route('category.posts', 'tutorials') }}">Laravel Tutorials</a></h2>
        <a class="category__link link--black" href="{{ route('category.posts', 'tutorials') }}">View all Tutorials</a>
    </header>
    <!-- 3 Posts -->
    <div class="gutter flex flex-wrap items-stretch justify-center sm:justify-start">
        @forelse ($tutorial_posts as $post)
            <a href="{{ route('post.details', $post) }}" class="card col w-1/3">
                <div class="card__image">
                    <img src="{{ $post->image }}" alt="{{ $post->slug }}">
                </div>
                <div class="card__content">
                    <span class="label text-xs">{{ customDateFormat($post->created_at) }}</span>
                    <h4>{{ $post->title }}</h4>
                </div>
            </a>
        @empty
        <div class="text-center">
            <p class="font-miriam mb-12">No post found!</p>
        </div>
        @endforelse
    </div>
    <!-- /3 Posts -->
</div>