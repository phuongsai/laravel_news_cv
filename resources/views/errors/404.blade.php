@extends('layouts.frontend.app')

@section('title','404 Not Found')

@section('content')
<div class="py-24 bg-white text-center">
    <div class="container px-5">
        <div class="md:w-2/3 mx-auto">
            <p class="text-2xl md:text-3xl font-miriam text-grey-darkest mb-12">And so for a time it looked as if all
                the adventures were coming to and end; but that was not to be.</p>
            <a href="{{ url('/') }}" class="btn btn--teal">Visit the home page</a>
        </div>
    </div>
</div>
@endsection