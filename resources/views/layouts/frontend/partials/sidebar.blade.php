<!-- NewsLetter -->
<div class="mx-0 card w-full bg-red">
    @include('layouts.frontend.partials.newsletter_form')
</div>
<!-- /NewsLetter -->

<!-- Tags info-->
<div class="mx-0 card w-full bg-grey-darkest text-white h-auto">
    <header class="card__header ml-8 py-5 pr-6 flex items-center justify-between border-b border-semi-white">
        <h2 class="text-white mb-0 text-3xl leading-tight">Tags</h2>
    </header>
    <div class="card__content h-auto">
        <dl class="list-unstyled">
            @forelse ($tags as $tag)
                <dt>
                    <a href="{{ route('tag.posts',$tag) }} class="font-bold text-white hover:text-grey-lighter transition"
                        rel="nofollow"><i> #{{ $tag->name }}</i>
                    </a>
                </dt>
            @empty
                <dd class="text-sm text-grey mb-4">
                    No Tag!
                </dd>
            @endforelse
        </dl>
    </div>
</div>
<!-- /Tags info-->