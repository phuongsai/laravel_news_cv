<div class="px-12 post__pagination bg-white flex clearfix">
    <div class="container">
        <!-- Previous Post -->
        @if(isset($prevPost))
        <a href="{{ route('post.details', $prevPost) }}" class="pagination__left float-left flex items-start my-8 lg:my-12"
            style="max-width: 425px">
            <svg class="mr-8 h-16 w-6 text-red hover:red-darker transition">
                <use xlink:href="#icon-arrow-thin-left" /></svg>
            <div class="text-sm text-grey-lighter">
            <h4 class="text-grey-darkest text-base font-sans mb-1">{{ $prevPost->title }}</h4>
                <p>{{ \Illuminate\Support\Str::limit($prevPost->body, 150) }}</p>
            </div>
        </a>
        @endif

        <!-- Next Post -->
        @if(isset($nextPost))
        <a href="{{ route('post.details', $nextPost) }}" class="pagination__right float-right text-right flex items-start my-8 lg:my-12"
            style="max-width: 425px">
            <div class="text-sm text-grey-lighter">
            <h4 class="text-grey-darkest text-base font-sans mb-1">{{ $nextPost->title }}</h4>
                <p>{{ \Illuminate\Support\Str::limit($nextPost->body, 150) }}</p>
            </div>
            <svg class="ml-8 h-16 w-6 text-red hover:red-darker transition">
                <use xlink:href="#icon-arrow-thin-right" /></svg>
        </a>
        @endif
    </div>
</div>