<div class="bg-white py-16 px-5">
    <div class="container py1">
        <div class="gutter clearfix flex flex-wrap items-start justify-center">
            <!-- NewsLetter Register Form -->
            <div class="col w-1/3 card bg-red mx-auto">
                @include('layouts.frontend.partials.newsletter_form')
            </div>
            <!-- /NewsLetter Register Form -->

            <!-- Laravel Sponsor -->
            <div class="col w-1/3 card bg-black mx-auto">
                <a href="https://confidentlaravel.com/?ref=laravelnews" rel="nofollow"
                    class="card__image bg-grey-lighter">
                    <img src="{{ asset('assets/frontend/images/confident-laravel.jpg') }}">
                </a>
                <div class="card__content">
                    <span class="label text-xs">Sponsor</span>
                    <h3 class="text-base leading-none mb-0">
                        <a href="https://confidentlaravel.com/?ref=laravelnews" rel="nofollow"
                            class="text-white text-base">
                            Learn to start testing your existing codebase with Confident Laravel
                        </a>
                    </h3>
                </div>
            </div>
            <!-- /Laravel Sponsor -->

            <!-- Laravel Jobs -->
            {{-- <div class="col w-1/3 card bg-teal-darker mx-auto">
                <div class="card__header ml-8 py-5 pr-6 flex items-center justify-between border-b border-semi-white">
                    <h2 class="text-white mb-0 text-4xl leading-tight">Laravel Jobs</h2>
                    <img class="header__icon block" src="images/icon-chair.png">
                </div>
                <div class="card__content">
                    <p class="mb-4">
                        <a href="https://larajobs.com/job/1575" class="text-white hover:opacity-75 transition"
                            rel="nofollow">
                            Senior Developer/Team Leader
                        </a>
                    </p>
                    <p class="mb-4">
                        <a href="https://larajobs.com/job/1565" class="text-white hover:opacity-75 transition"
                            rel="nofollow">
                            Full Time - Backend Laravel Developer
                        </a>
                    </p>
                    <div class="m-0">
                        <a href="https://larajobs.com"
                            class="text-teal hover:text-black hover:opacity-75 transition">View more Jobs</a>
                        <a href="https://larajobs.com"
                            class="text-teal hover:text-black hover:opacity-75 transition float-right">Post a
                            Job</a>
                    </div>
                </div>
            </div> --}}
            <!-- /Laravel Jobs -->
        </div>
    </div>
</div>