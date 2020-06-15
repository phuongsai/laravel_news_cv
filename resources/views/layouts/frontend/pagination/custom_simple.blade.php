<!-- Pagination simple width-4 -->
@if ($paginator->hasPages())
    <nav class="flex items-center justify-between mt-10 mb-4 w-full">
    @if($paginator->previousPageUrl())
        <a href="{{ $paginator->previousPageUrl() }}"
            class="btn px-4 py-2 text-xs arrow--left bg-red hover:bg-red-darker transition"><svg
                class="align-middle w-3 h-3 mr-2 inline-block">
                <use xlink:href="#icon-arrow-left"></use>
            </svg> Newer Posts</a>
    @else
        <a class="btn px-4 py-2 text-xs arrow--left btn--disabled hover:bg-grey-lightest"><svg
                class="align-middle w-3 h-3 mr-2 inline-block">
                <use xlink:href="#icon-arrow-left"></use>
            </svg> Newer Posts</a>
    @endif

    @if($paginator->nextPageUrl())
        <a href="{{ $paginator->nextPageUrl() }}"
            class="btn px-4 py-2 text-xs arrow--right bg-red hover:bg-red-darker transition">Older Posts <svg
                class="align-middle w-3 h-3 mr-2 inline-block">
                <use xlink:href="#icon-arrow-right"></use>
            </svg>
    </a>
    @else
        <a class="btn px-4 py-2 text-xs arrow--right btn--disabled hover:bg-grey-lightest">Older Posts <svg
                class="align-middle w-3 h-3 mr-2 inline-block">
                <use xlink:href="#icon-arrow-right"></use>
            </svg>
    </a>
    @endif
    </nav>
@endif
<!-- /Pagination simple width-4 -->
