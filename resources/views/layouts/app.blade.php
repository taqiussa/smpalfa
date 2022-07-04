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
    <style>
        .turbolinks-progress-bar {
            height: 5px;
        }

    </style>
    @livewireStyles

        {{-- jQuery  --}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
    {{-- select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    {{-- turbolinks --}}
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js"
        data-turbolinks-eval="false" data-turbo-eval="false"></script>
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
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
