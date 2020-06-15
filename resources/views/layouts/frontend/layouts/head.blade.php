<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="referrer" content="always">
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">

    <title>@yield('title') - {{ config('app.name', 'Laravel News') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Font -->
    <link
        href='https://fonts.googleapis.com/css?family=Miriam+Libre:400,700|Source+Sans+Pro:400,700,600,400italic,700italic'
        rel='stylesheet' type='text/css'>

    <!-- Main CSS -->
    <link href="{{ asset('assets/frontend/css/css.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/app.css') }}">

    <!-- Toastr Css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/vendor/izitoast/css/iziToast.min.css')}}" />
    <!-- Custom CSS -->
    @stack('css')

    <!-- Jquery Core Js -->
    <script src="{{ asset('assets/frontend/js/jquery.min.js') }}"></script>

    <script>
        window.dataLayer = window.dataLayer || [];
        if (top !== self) top.location.replace(self.location.href);
        window.Config = {};
    </script>
</head>