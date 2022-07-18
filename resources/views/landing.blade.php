<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
    <nav class="navbar navbar-expand-lg navbar-dark bg-success p-2 shadow fixed-top position-sticky">
        <div class="container-fluid">
            <a class="navbar-brand fs-3" href="{{ route('landing') }}">
                <img src="{{ asset('images/logoalfa2.png') }}" alt="" width="50" height="50"
                    class="d-inline-block align-middle">
                SMP AL MUSYAFFA
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active fs-4" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-4" href="#">Profile</a>
                    </li>
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fs-4" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Gallery
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li> --}}
                </ul>
                <div class="d-flex">
                    <a href="{{ route('login') }}" class="btn btn-light" role="button">Login</a>
                </div>
            </div>
        </div>
    </nav>
    <header
        style="background-image:url({{ asset('images/alfaguru.jpg') }}); 
        background-repeat:no-repeat;
        background-attachment:scroll;
        background-position:center;
        background-size:cover;
        padding-top: 3rem;
        padding-bottom: 20rem;
        text-align: center;"
        class="shadow">
        <div class="container" id="top">
            <img src="{{ asset('images/logoalfa2.png') }}" alt="logo" width="100px">
            <h3>YAYASAN AL MUSYAFFA'</h3>
            <h1>SMP AL MUSYAFFA' KENDAL</h1>
            <h5>Jln. Kampir-Sudipayung, Kec. Ngampel, Kab. Kendal - Jawa Tengah </h5>
        </div>
    </header>


    {{-- main content --}}
    <main class="container-fluid my-2">
        @yield('content')
        {{ $slot ?? '' }}
    </main>
    {{-- end main --}}

    {{-- footer --}}
    <footer class="bg-dark text-light p-3">
        <div class="d-flex justify-content-between">
            <p>
                <a href="#0" class="text-white">&copy; SMP Al Musyaffa 2022 - {{ gmdate('Y') }}</a>
                |
                <a href="https://www.youtube.com/channel/UC6K2YKhHDT2y05U6GorosCQ" rel="nofollow" target="_blank"
                    class="text-white">Developed by Kendali Koding</a>
            </p>
            <a href="#top" class="text-white">Back to top</a>
        </div>
    </footer>
    {{-- end footer --}}
</body>

</html>
