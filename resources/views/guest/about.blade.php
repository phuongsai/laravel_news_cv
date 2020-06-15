@extends('layouts.frontend.app')

@section('title','About')

@section('content')
<div class="container py-8 px-5">
    <div class="gutter flex flex-col items-center justify-start md:items-start md:flex-row --mx-4">
        <div class="md:w-3/5 lg:w-2/3 flex items-start justify-center">
            <div class="flex-1 card card--post mx-0 md:w-full">
                <div class="post__content text-grey-darkest p-6 md:p-10">
                    <h2 class="font-bold">About This Website</h2>
                    <p>A cloned website of <a href="https://laravel-news.com">Laravel News</a> for studying purpose only. Thank you!</p>
                    <address>
                        Email:
                        <p>phuonghoang.s21@gmail.com</p>
                    </address>
                </div>
            </div>
        </div>
        <div class="flex-1 md:w-2/5 lg:w-1/3 sidebar flex flex-col justify-center">
            @include('layouts.frontend.partials.sidebar')
        </div>
    </div>
</div>
@endsection