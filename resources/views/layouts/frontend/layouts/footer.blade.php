<!-- Back to top button -->
<a href="javascript:void(0)" class="crunchify-top"><i style="display: inline;" aria-hidden="true"></i></a>

<!-- Footer -->
<footer class="bg-grey-darkest font-miriam uppercase tracking-extra text-xs text-center clear-both">
    <div class="container py-10 px-6 md:p-10">
        <!-- Social Share -->
        <ul class="list-none pl-0 flex items-center justify-center">
            <li><a rel="nofollow" href="javascript:void(0)"
                    class="rounded-full flex items-center justify-center m-3 p-3 text-white bg-twitter hover:bg-black transition">
                    <svg class="w-5 h-5 block">
                        <use xlink:href="#icon-twitter" />
                    </svg>
                </a></li>
            <li><a rel="nofollow" href="javascript:void(0)"
                    class="rounded-full flex items-center justify-center m-3 p-3 text-white bg-facebook hover:bg-black transition">
                    <svg class="w-5 h-5 block">
                        <use xlink:href="#icon-facebook" />
                    </svg>
                </a></li>
            <li><a rel="nofollow" href="javascript:void(0)"
                    class="rounded-full flex items-center justify-center m-3 p-3 text-white bg-grey hover:bg-black transition">
                    <svg class="w-5 h-5 block">
                        <use xlink:href="#icon-instagram" />
                    </svg>
                </a></li>
            <li><a rel="nofollow" href="javascript:void(0)"
                    class="rounded-full flex items-center justify-center m-3 p-3 text-white bg-linkedin hover:bg-black transition">
                    <svg class="w-5 h-5 block">
                        <use xlink:href="#icon-linkedin" />
                    </svg>
                </a></li>
        </ul>
        <!-- /Social Share -->

        <!-- First Line -->
        <nav class="my-6">
            <ol class="list-none pl-0 flex flex-wrap justify-center">
                <li class="my-1 mx-6"><a class="text-white hover:text-red transition"
                    href="{{ route('category.posts','news') }}">News</a>
                </li>
                <li class="my-1 mx-6"><a class="text-white hover:text-red transition"
                    href="{{ route('category.posts','tutorials') }}">Tutorials</a>
                </li>
                <li class="my-1 mx-6"><a class="text-white hover:text-red transition"
                    href="{{ route('category.posts','laravel-packages') }}">Packages</a>
                </li>
                <li class="my-1 mx-6"><a class="text-white hover:text-red transition"
                    href="{{ route('category.posts','laravel-books') }}">Books</a>
                </li>
                <li class="my-1 mx-6"><a class="text-white hover:text-red transition"
                    href="https://larajobs.com" rel="nofollow">Jobs</a>
                </li>
                <li class="my-1 mx-6"><a class="text-white hover:text-red transition"
                    href="{{ route('settings') }}" rel="nofollow">Your Account</a>
                </li>
                <li class="my-1 mx-6"><a class="text-white hover:text-red transition"
                    href="{{ route('about') }}">About</a>
                </li>
            </ol>
        </nav>
        <!-- /First Line -->

        <!-- Second Line -->
        {{-- <nav>
            <ol class="list-none pl-0 flex flex-wrap justify-center">
                <li class="my-1 mx-6"><a class="text-grey hover:text-red transition"
                    href="{{ route('category.posts','news') }}">News</a>
        </li>
        <li class="my-1 mx-6"><a class="text-grey hover:text-red transition"
                href="{{ route('category.posts','tutorials') }}">Tutorials</a>
        </li>
        <li class="my-1 mx-6"><a class="text-grey hover:text-red transition"
                href="{{ route('category.posts','laravel-packages') }}">Packages</a>
        </li>
        <li class="my-1 mx-6"><a class="text-grey hover:text-red transition"
                href="{{ route('category.posts','laravel-books') }}">Books</a>
        </li>
        <li class="my-1 mx-6"><a class="text-grey hover:text-red transition"
                href="{{ route('category.posts','interviews') }}">Interviews</a>
        </li>
        <li class="my-1 mx-6"><a class="text-grey hover:text-red transition"
                href="{{ route('category.posts','laravel-applications') }}">Applications</a>
        </li>
        </ol>
        </nav> --}}
        <!-- /Second Line -->

        <!-- Footer Logo -->
        <div class="mt-16 text-center">
            <img src="{{ asset('assets/frontend/images/dark-ln-elephant.png') }}" class="inline-block mb-3" style="max-height: 175px">
            <p class="text-black-lighter">© 2012 - 2020 <a class="text-black-lighter hover:text-red transition"
                    href="{{ url('/') }}">Laravel News</a> — By <a class="text-black-lighter hover:text-red transition"
                    href="https://ericlbarnes.com">Eric L. Barnes</a> - A division of dotdev inc.</p>
        </div>
        <div class="my-8 mx-auto bg-grey-darker opacity-75 w-16" style="height: 2px;"></div>
        <!-- /Footer Logo -->

        <!-- Design Logo -->
        <div class="text-white">
            <p class="mb-3 text-xs">Design &amp; Front-end code by</p>
            <a href="https://zaengle.com/" class="tribute__logo">
                <img src="{{ asset('assets/frontend/images/zaengle-logo.png') }}" class="inline-block"
                    style="max-height: 30px">
            </a>
        </div>
        <!-- /Design Logo -->

        <!-- Clone Version -->
        <div class="text-white">
            <p class="mb-3 text-xs"><br>CLONE VERSION</p>
        </div>
        <!-- /Clone Version -->
    </div>
</footer>
<!-- /Footer -->

<!-- Icons -->
@include('layouts.frontend.layouts.icon')

<!-- Toastr Js -->
<script defer type="text/javascript" src="{{ asset('assets/backend/vendor/izitoast/js/iziToast.min.js')}}"></script>

<!-- Back to top Js -->
<script defer src="{{ asset('assets/frontend/js/backToTop.js') }}"></script>

{!! Toastr::message() !!}
<script>
    @if($errors->any())
    @foreach($errors->all() as $error)
    toastr.error('{{ $error }}', 'Error', {
        closeButton: true,
        progressBar: true,
    });
    @endforeach
    @endif
</script>



<!-- SCRIPTS -->
@stack('js')