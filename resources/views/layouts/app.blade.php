<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Logo -->
    <link rel="icon" href="{{ asset('images/logoalfa.png') }}" type="image/png" sizes="16x16"  />


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @livewireStyles

    {{-- Trix --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/trix.css') }}">
    <script type="text/javascript" src="{{ asset('js/trix.js') }}"></script>

    {{-- jQuery  --}}
    <script src="{{ asset('js/select2/jquery-3.6.0.min.js') }}"></script>
    
    {{-- select2 --}}
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('js/select2/select2.min.js') }}"></script>
    
    @livewireScripts
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    {{-- Trix disable file attach --}}
    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        }
    </style>
</head>

<body>
    <div id="app">
        <!-- ======== sidebar-nav start =========== -->
        @include('layouts.partials.sidebar')
        <!-- ======== sidebar-nav end =========== -->

        <!-- ======== main-wrapper start =========== -->
        <main class="main-wrapper">
            <!-- ========== navbar start ========== -->
            @include('layouts.partials.navbar')
            <!-- ========== navbar end ========== -->

            <!-- ========== section start ========== -->
            <section class="section">
                <div class="container-fluid">
                    <!-- ========== title-wrapper start ========== -->
                    @include('layouts.partials.header')
                    <!-- ========== title-wrapper end ========== -->

                    <!-- ========== Main Content Start ========== -->
                    @yield('content')
                    {{ $slot ?? '' }}
                    <!-- ========== Main Content end ========== -->
                </div>
                <!-- end container -->
            </section>
            <!-- ========== section end ========== -->

            <!-- ========== footer start =========== -->
            @include('layouts.partials.footer')
            <!-- ========== footer end =========== -->
        </main>
        <!-- ======== main-wrapper end =========== -->
    </div>
    <!-- Scripts -->
    <script src="{{ mix('js/main.js') }}" defer></script>
    <script src="{{ mix('js/notyf.js') }}" defer></script>
    @stack('scripts')
</body>

</html>
