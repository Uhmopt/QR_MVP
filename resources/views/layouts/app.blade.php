<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'FoodTiger') }}</title>
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Argon CSS -->
    @if(App::getLocale() == 'ar')
    <link type="text/css" href="{{ asset('argon') }}/css/argon-rtl.css?v=1.0.0" rel="stylesheet">
    @else
    <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">
    @endif    
    <!-- Argon CSS -->
    <link type="text/css" href="{{ asset('custom') }}/css/custom.css" rel="stylesheet">

    <!-- Select2 -->
    <link type="text/css" href="{{ asset('custom') }}/css/select2.min.css" rel="stylesheet">

    <!-- intl-tel-input -->
    <link type="text/css" href="{{ asset('intl-tel-input') }}/css/intlTelInput.css" rel="stylesheet">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="{{ asset('vendor') }}/jasny/css/jasny-bootstrap.min.css">
    <!-- Flatpickr datepicker -->
    <link rel="stylesheet" href="{{ asset('vendor') }}/flatpickr/flatpickr.min.css">
    @yield('head')
    @laravelPWA

    <!-- Custom CSS defined by admin -->
    <link type="text/css" href="{{ asset('byadmin') }}/back.css" rel="stylesheet">

</head>

<body class="{{ $class ?? '' }}">
    @auth()
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    @include('layouts.navbars.sidebar')
    @endauth

    <div class="main-content">
        @include('layouts.navbars.navbar')
        @yield('content')
    </div>

    @guest()
    @include('layouts.footers.guest')
    @endguest

    <!-- Commented because navtabs includes same script -->
    <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>

    <script src="{{ asset('argonfront') }}/js/core/popper.min.js" type="text/javascript"></script>
    <!-- <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script> -->
    @if(!Route::is('qr') && !Route::is('qr.show'))
        <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    @endif

    @stack('js')
    <!-- Navtabs -->
    <script src="{{ asset('argonfront') }}/js/core/jquery.min.js" type="text/javascript"></script>


    <script src="{{ asset('argon') }}/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

    <!-- Nouslider -->
    <script src="{{ asset('argon') }}/vendor/nouislider/distribute/nouislider.min.js" type="text/javascript"></script>

    <!-- Argon JS -->
    <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="{{ asset('vendor') }}/jasny/js/jasny-bootstrap.min.js"></script>
    <!-- Custom js -->
    <script src="{{ asset('custom') }}/js/orders.js"></script>
    <!-- Custom js -->
    <script src="{{ asset('custom') }}/js/mresto.js"></script>
    <!-- AJAX -->

    <!-- SELECT2 -->
    <script src="{{ asset('custom') }}/js/select2.js"></script>
    <script src="{{ asset('vendor') }}/select2/select2.min.js"></script>

    <!-- intl-tel-input -->
    <script src="{{ asset('intl-tel-input') }}/js/intlTelInput.js"></script>

    <!-- Google Map -->
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?libraries=geometry,drawing&key=<?php echo env('GOOGLE_MAPS_API_KEY',''); ?>">
    </script>
    <script src="{{ asset('custom') }}/js/rmap.js"></script>

    <!-- Import Vue -->
    <script src="{{ asset('vendor') }}/vue/vue.js"></script>

    <!-- Import AXIOS --->
    <script src="{{ asset('vendor') }}/axios/axios.min.js"></script>

    <!-- Flatpickr datepicker -->
    <script src="{{ asset('vendor') }}/flatpickr/flatpickr.js"></script>

    <!-- OneSignal -->
    <script src="{{ asset('vendor') }}/OneSignalSDK/OneSignalSDK.js" async=""></script>
    <script>
    var ONESIGNAL_APP_ID = "{{ env('ONESIGNAL_APP_ID') }}";
    var USER_ID = '{{  auth()->user()?auth()->user()->id:"" }}';
    </script>
    <script src="{{ asset('custom') }}/js/onesignal.js"></script>

    @yield('js')

    <!-- Custom JS defined by admin -->
    <?php echo file_get_contents(base_path('public/byadmin/back.js')) ?>
</body>

</html>
