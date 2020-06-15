<nav x-data="{ navIsOpen: false, toggleNav: toggleNav }" :class="navIsOpen ? 'h-full' : ''"
    class="md:relative w-full bg-white fixed md:top-0 z-300 lg:border-t-4 border-red shadow">
    <div class="lg:flex items-center container">
        <!-- Logo -->
        <div class="px-5 flex flex-shrink-0 items-center justify-between">
            <a class="text-red py-4 flex items-center hover:text-red-darker" href="{{ url('/') }}">
                <img src="{{ asset('assets/frontend/images/logo_index.png') }}" alt="" class="inline-block w-11 rounded-sm">
                <h4 class="font-bold text-grey-darkest mb-0 ml-4 tracking-tight">Laravel News</h4>
            </a>
            <button type="button" class="nav__hamburger lg:hidden focus:outline-none" @click="toggleNav()">
                <div class="hamburger-box">
                    <div class="hamburger-inner"></div>
                </div>
            </button>
        </div>
        <!-- /Logo -->

        <div :class="navIsOpen ? '' : 'hidden'"
            class="lg:flex overflow-y-auto items-center bg-grey-darkest lg:bg-transparent h-full w-full fixed lg:static">
            <!-- Search Box-->
            <div
                class="border-t-2 lg:border-t-0 border-off-white bg-white flex items-center lg:justify-end w-full lg:w-auto order-3">
                <form class="lg:border-l-2 border-off-white bg-white flex items-center lg:justify-end w-full lg:w-auto"
                    method="POST" action="{{ route('guest.search') }}">
                    <input type="text" placeholder="Search..." value="{{ isset($query) ? $query : '' }}"
                        name="query" class="placeholder-red flex-1 py-8 pl-8 lg:py-6 focus:outline-none">
                    <button type="submit" class="block py-8 pr-8 lg:py-6 focus:outline-none">
                        <svg class="block w-4 h-4 text-grey hover:text-red">
                            <use xlink:href="#icon-search">
                            </use>
                        </svg>
                    </button>
                </form>
            </div>
            <!-- /Search Box-->

            <!-- Category List -->
            <div
                class="font-miriam text-2xl lg:text-base my-6 lg:my-0 px-5 w-full lg:w-auto order-1 text-white md:text-grey">
                <ul class="list-none pl-0 sm:flex flex-wrap items-center justify-center text-center">
                    <li class="sm:mr-8"><a class="text-inherit hover:text-red"
                        href="{{ route('category.posts','news') }}">News</a></li>
                    <li class="sm:mr-8"><a class="text-inherit hover:text-red"
                        href="{{ route('category.posts','tutorials') }}">Tutorials</a></li>
                    <li class="sm:mr-8"><a class="text-inherit hover:text-red"
                        href="{{ route('category.posts','books') }}">Books</a>
                    </li>
                </ul>
            </div>
            <!-- /Category List -->

            <!-- Social icon -->
            <ul class="list-none pl-0 flex items-center justify-center lg:justify-end flex-1 lg:pl-0 lg:pr-3 order-2">
                <li class="m-3 xl:ml-0"><a href="#"
                        class="flex items-center justify-center rounded-full p-2 lg:p-0 text-white lg:text-grey lg:hover:text-twitter bg-twitter lg:bg-transparent hover:bg-black lg:hover:bg-transparent transition"><svg
                            class="w-4 h-4 block leading-none">
                            <use xlink:href="#icon-twitter">
                            </use>
                        </svg></a></li>
                <li class="m-3"><a href="#"
                        class="flex items-center justify-center rounded-full p-2 lg:p-0 text-white lg:text-grey lg:hover:text-facebook bg-facebook lg:bg-transparent hover:bg-black lg:hover:bg-transparent transition"><svg
                            class="w-4 h-4 block leading-none">
                            <use xlink:href="#icon-facebook">
                            </use>
                        </svg></a></li>
                <li class="m-3"><a rel="nofollow" href="#"
                        class="flex items-center justify-center rounded-full p-2 lg:p-0 text-white lg:text-grey lg:hover:text-linkedin bg-linkedin lg:bg-transparent hover:bg-black lg:hover:bg-transparent transition"><svg
                            class="w-4 h-4 block leading-none">
                            <use xlink:href="#icon-linkedin">
                            </use>
                        </svg></a></li>
            </ul>
            <!-- /Social icon -->

            <!-- Category Mobile mode -->
            <div class="my-8 lg:hidden">
                <ol class="list-none pl-0 sm:flex flex-wrap items-center justify-center text-center font-sans">
                    <li class="block" style="letter-spacing: 2.2px;"><a
                            class="block text-xs text-grey uppercase mx-4 my-3"
                            href="{{ route('category.posts','news') }}">News</a></li>
                    <li class="block" style="letter-spacing: 2.2px;"><a
                            class="block text-xs text-grey uppercase mx-4 my-3"
                            href="{{ route('category.posts','tutorials') }}">Tutorials</a></li>
                    <li class="block" style="letter-spacing: 2.2px;"><a
                            class="block text-xs text-grey uppercase mx-4 my-3"
                            href="{{ route('category.posts','books') }}">Books</a></li>
                </ol>

                <!-- Footer Logo -->
                <div class="text-center pb-8">
                <img class="m-8 w-32 mx-auto inline-block" src="{{ asset('assets/frontend/images/dark-ln-elephant.png') }}">
                </div>
                <!-- /Footer Logo -->
            </div>
            <!-- /Category Mobile mode -->
        </div>
    </div>
</nav>