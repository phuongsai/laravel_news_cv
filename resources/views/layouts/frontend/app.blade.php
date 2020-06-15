<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<!-- Head -->
@include('layouts.frontend.layouts.head')
<!-- /Head -->

<!-- Index Homepage-->
@if(Request::is('/'))
    <body id="site-layout" class="bg-white font-sans text-base text-grey-darker leading-loose">

@else
<!-- Other Page -->
    <body class="bg-off-white font-sans text-base text-grey-darker leading-loose">
@endif
    <!-- Navbar -->
    @include('layouts.frontend.layouts.navbar')
    <!-- /Navbar -->

    <!-- Main wrap page -->
    <main class="site-main" style="height: auto !important;">
        <!-- Content -->
        @yield('content')
        <!-- Content -->
    </main>
    <!-- /Main wrap page -->

    <!-- Newsletter -->
    @yield('newsletter')
    {{-- @include('layouts.frontend.partials.newsletter') --}}
    <!-- /Newsletter -->

    <!-- Footer -->
    @include('layouts.frontend.layouts.footer')

    <!-- Main JS -->
    <script src="{{ asset('assets/frontend/js/app.js') }}"></script>
</body>

</html>