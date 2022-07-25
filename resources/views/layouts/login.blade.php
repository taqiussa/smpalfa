<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Refresh CSRF Token -->
    <meta http-equiv="refresh" content="{{ config('session.lifetime') * 60 }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Logo -->
    <link rel="icon" href="{{ asset('images/logoalfa.png') }}" type="image/png" sizes="16x16" />


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @livewireStyles

    @livewireScripts
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

</head>

<body>
    <header
        style="background-image:url({{ asset('images/alfaguru.png') }}); 
        background-repeat:no-repeat;
        background-attachment:scroll;
        background-position:center;
        background-size:cover;
        padding-top: 2rem;
        padding-bottom: 14.3rem;
        text-align: center;"
        class="shadow">
        <div class="container" id="top">
            <img src="{{ asset('images/logoalfa2.png') }}" alt="logo" width="100px">
            <h5>SMP AL MUSYAFFA' KENDAL</h5>
            <div class="d-flex justify-content-center">
                <div class="col-md-6">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </header>
    {{-- footer --}}
    <footer class="bg-dark text-light p-2">
        <div class="d-flex justify-content-center text-center">
            <p>
                <a href="#0" class="text-white">&copy; SMP Al Musyaffa 2022 - {{ gmdate('Y') }}</a>
                |
                <a href="https://www.youtube.com/channel/UC6K2YKhHDT2y05U6GorosCQ" rel="nofollow" target="_blank"
                    class="text-white">Developed by Kendali Koding</a>
            </p>
        </div>
    </footer>
    {{-- end footer --}}
</body>

</html>
