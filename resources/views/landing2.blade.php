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

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success p-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
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
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active fs-4" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-4" href="#">Profile</a>
                    </li>
                    <li class="nav-item dropdown">
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
                    </li>
                </ul>
                <div class="d-flex">
                    <a href="{{ route('login') }}" class="btn btn-light" role="button">Login</a>
                </div>
            </div>
        </div>
    </nav>
    <header style="background-image:url('images/alfaguru.jpg'); background-repeat:no-repeat;background-attachment:scroll;background-position:center;background-size:cover;padding-top: 14rem;
    padding-bottom: 14rem;
    text-align: center;">
        <div class="container">
            <h2>SMP AL MUSYAFFA KENDAL</h2>
            <div class="masthead-heading text-uppercase">Welcome</div>
            <a class="btn btn-primary btn-xl text-uppercase" href="#services">Tell Me More</a>
        </div>
    </header>


    {{-- main content --}}
    <main class="container-fluid my-2">

        {{-- main header --}}
        {{-- <div class="p-4 p-md-5 text-white bg-dark rounded">
            <div class="col-md-6 px-0">
                <h1 class="display-4 fst-italic">Coolfeatured Blog Post</h1>
                <p class="lead my-3">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus facere quo voluptatum exercitationem laudantium nihil, quibusdam iste at assumenda expedita nam, est animi eum, neque voluptatem optio maiores delectus repellendus placeat labore? Delectus natus nisi reprehenderit harum aut molestias porro, vitae praesentium sed exercitationem perferendis nemo corporis sit, itaque ex!
                </p>
                <p class="lead mb-0">
                    <a href="#" class="text-white fw-bold">Continue....</a>
                </p>
            </div>
        </div> --}}
        {{-- end main header --}}

        {{-- featured post --}}
        <div class="row mb-2">

            {{-- left --}}
            <div class="col-md-6">
                <div class="row g-0 border rounded overflow-hidden flex-md-row shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-primary">Sport</strong>
                        <h3 class="mb-0">Featured Post</h3>
                        <div class="mb-1 text-muted">Nov 12</div>
                        <p class="card-text mb-auto">Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti, temporibus. Blanditiis quas nisi quae rem minus magni nostrum quos, voluptates ab ratione molestiae, sint nobis, cupiditate officiis? Unde, aperiam debitis.</p>
                        <a href="#" class="stretched-link">Continue Reading..</a>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                        <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em"></text></svg>
                    </div>
                </div>
            </div>
            {{-- end left --}}

            {{-- right --}}
            <div class="col-md-6">
                <div class="row g-0 border rounded overflow-hidden flex-md-row shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-primary">Design</strong>
                        <h3 class="mb-0">Post Ttile</h3>
                        <div class="mb-1 text-muted">Nov 11</div>
                        <p class="card-text mb-auto"></p>
                        <a href="#" class="stretched-link">Continue Reading..</a>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                        <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em"></text></svg>
                    </div>
                </div>
            </div>
            {{-- end right --}}
        </div>
        {{-- end featured post --}}

        {{-- post content --}}
        <div class="row g-5">

            {{-- post --}}
            <div class="col-md-8">
                <h3 class="pb-4 mb-4 fst-italic border-bottom">Blog Post Example</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque asperiores veritatis, natus at unde corporis officia eum deleniti quod sunt consequuntur facilis odit tenetur dolorem quia neque. Accusantium sapiente, magnam adipisci corrupti veniam sed obcaecati quis non voluptatem perspiciatis repudiandae deleniti inventore labore natus quidem eius qui animi. Veritatis, rerum.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit accusamus voluptatibus aut consequuntur perspiciatis tempora sit eius delectus, facilis saepe qui, totam est dolor corrupti vel et quisquam. Quia sequi praesentium amet earum voluptatibus quos architecto! Atque, recusandae vitae quos incidunt, culpa facilis soluta ipsum architecto laboriosam mollitia cupiditate repellendus.</p>
                
                <figure>
                    <blockquote class="blockquote">
                        <p>A Well Known Quote Of someone</p>
                    </blockquote>
                    <figcaption class="blockquote-footer">
                        Name of someone<cite>source</cite>
                    </figcaption>
                </figure>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque asperiores veritatis, natus at unde corporis officia eum deleniti quod sunt consequuntur facilis odit tenetur dolorem quia neque. Accusantium sapiente, magnam adipisci corrupti veniam sed obcaecati quis non voluptatem perspiciatis repudiandae deleniti inventore labore natus quidem eius qui animi. Veritatis, rerum.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit accusamus voluptatibus aut consequuntur perspiciatis tempora sit eius delectus, facilis saepe qui, totam est dolor corrupti vel et quisquam. Quia sequi praesentium amet earum voluptatibus quos architecto! Atque, recusandae vitae quos incidunt, culpa facilis soluta ipsum architecto laboriosam mollitia cupiditate repellendus.</p>
                
                <figure>
                    <blockquote class="blockquote">
                        <p>A Well Known Quote Of someone</p>
                    </blockquote>
                    <figcaption class="blockquote-footer">
                        Name of someone<cite>source</cite>
                    </figcaption>
                </figure>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque asperiores veritatis, natus at unde corporis officia eum deleniti quod sunt consequuntur facilis odit tenetur dolorem quia neque. Accusantium sapiente, magnam adipisci corrupti veniam sed obcaecati quis non voluptatem perspiciatis repudiandae deleniti inventore labore natus quidem eius qui animi. Veritatis, rerum.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit accusamus voluptatibus aut consequuntur perspiciatis tempora sit eius delectus, facilis saepe qui, totam est dolor corrupti vel et quisquam. Quia sequi praesentium amet earum voluptatibus quos architecto! Atque, recusandae vitae quos incidunt, culpa facilis soluta ipsum architecto laboriosam mollitia cupiditate repellendus.</p>
                
                <figure>
                    <blockquote class="blockquote">
                        <p>A Well Known Quote Of someone</p>
                    </blockquote>
                    <figcaption class="blockquote-footer">
                        Name of someone<cite>source</cite>
                    </figcaption>
                </figure>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque asperiores veritatis, natus at unde corporis officia eum deleniti quod sunt consequuntur facilis odit tenetur dolorem quia neque. Accusantium sapiente, magnam adipisci corrupti veniam sed obcaecati quis non voluptatem perspiciatis repudiandae deleniti inventore labore natus quidem eius qui animi. Veritatis, rerum.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit accusamus voluptatibus aut consequuntur perspiciatis tempora sit eius delectus, facilis saepe qui, totam est dolor corrupti vel et quisquam. Quia sequi praesentium amet earum voluptatibus quos architecto! Atque, recusandae vitae quos incidunt, culpa facilis soluta ipsum architecto laboriosam mollitia cupiditate repellendus.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque asperiores veritatis, natus at unde corporis officia eum deleniti quod sunt consequuntur facilis odit tenetur dolorem quia neque. Accusantium sapiente, magnam adipisci corrupti veniam sed obcaecati quis non voluptatem perspiciatis repudiandae deleniti inventore labore natus quidem eius qui animi. Veritatis, rerum.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit accusamus voluptatibus aut consequuntur perspiciatis tempora sit eius delectus, facilis saepe qui, totam est dolor corrupti vel et quisquam. Quia sequi praesentium amet earum voluptatibus quos architecto! Atque, recusandae vitae quos incidunt, culpa facilis soluta ipsum architecto laboriosam mollitia cupiditate repellendus.</p>
                
                <figure>
                    <blockquote class="blockquote">
                        <p>A Well Known Quote Of someone</p>
                    </blockquote>
                    <figcaption class="blockquote-footer">
                        Name of someone<cite>source</cite>
                    </figcaption>
                </figure>

                <p class="mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque asperiores veritatis, natus at unde corporis officia eum deleniti quod sunt consequuntur facilis odit tenetur dolorem quia neque. Accusantium sapiente, magnam adipisci corrupti veniam sed obcaecati quis non voluptatem perspiciatis repudiandae deleniti inventore labore natus quidem eius qui animi. Veritatis, rerum.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit accusamus voluptatibus aut consequuntur perspiciatis tempora sit eius delectus, facilis saepe qui, totam est dolor corrupti vel et quisquam. Quia sequi praesentium amet earum voluptatibus quos architecto! Atque, recusandae vitae quos incidunt, culpa facilis soluta ipsum architecto laboriosam mollitia cupiditate repellendus.</p>
            </div>
            {{-- end post --}}

            {{-- sidebar --}}
            <div class="col-md-4">
                <div class="position-sticky" style="top:2rem;">

                    {{-- about --}}
                    <div class="p-4 mb-3 bg-light rounded">
                        <h4 class="fst-italic">About</h4>
                        <p class="mb-0">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam adipisci consequuntur ut, delectus quisquam quam, odio placeat animi, a autem fugiat natus vel consectetur. Sunt libero numquam a explicabo eaque!
                        </p>
                    </div>
                    {{-- end about --}}

                    {{-- archinve --}}
                    <div class="p-4">
                        <h4 class="fst-italic">Archives</h4>
                        <ul class="list-unstyled mb-0">
                            <li><a href="#">Month 2022</a></li>
                            <li><a href="#">Month 2022</a></li>
                            <li><a href="#">Month 2022</a></li>
                            <li><a href="#">Month 2022</a></li>
                            <li><a href="#">Month 2022</a></li>
                            <li><a href="#">Month 2022</a></li>
                            <li><a href="#">Month 2022</a></li>
                            <li><a href="#">Month 2022</a></li>
                            <li><a href="#">Month 2022</a></li>
                        </ul>
                    </div>
                    {{-- end archive --}}

                    {{-- sosical --}}
                    <div class="p-4">
                        <h4 class="fst-italic">Social</h4>
                        <ul class="list-unstyled">
                            <li><a href="#">Facebbok</a></li>
                            <li><a href="#">Twitter</a></li>
                            <li><a href="#">Instagram</a></li>
                        </ul>
                    </div>
                    {{-- end social --}}
                </div>
            </div>
            {{-- end sidebar --}}
        </div>
    </main>
    {{-- end main --}}

    {{-- footer --}}
    <footer class="bg-dark text-light p-2">
        <div class="d-flex justify-content-between">
            <p>&copy; SMP Alfa</p>
            <a href="#">Back to top</a>
        </div>
    </footer>
    {{-- end footer --}}
</body>

</html>
