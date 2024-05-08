<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="dark light"/>

    <title>{{ config('app.name') }}</title>
    <!-- Styles -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css"
          integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://uxsad.github.io/assets/css/style.css" media="all">
</head>
<body class="bg-light text-dark antialiased">
<nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand font-serif font-weight-bold" href="/">
            SERENE
        </a>
        <button class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbarSupportedContent" class="collapse navbar-collapse">
            @if (Route::has('login'))
                <ul class="navbar-nav ml-auto">
                    @auth
                        <li class="nav-item">
                            <a href="{{ route('dashboard.all') }}" class="nav-link">Dashboard</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">Log in</a>
                        </li>

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="nav-link">Register</a>
                            </li>
                        @endif
                    @endauth
                </ul>
            @endif
        </div>
    </div>
</nav>
<main>
    <section id="landing" class="container py-5">
        <div class="row align-items-center">
            <div class="col-12 col-md-6 col-lg-6">
                <h1 class="font-serif font-weight-bold">
                    <span class="text-primary">SERENE</span>
                    &mdash; uSer ExpeRiENce dEtector
                </h1>
                <p>An analyzer of web pages that understands the users’ emotions by studying their usage of the mouse
                    and of the keyboard so to detect problems of usability and UX smells.</p>
                <p>
                    <a href="https://github.com/uxsad" class="btn btn-primary btn-lg d-block" target="_blank">
                        <span class="fab fa-github" aria-hidden="true"></span>
                        View on GitHub
                    </a>
                    <a href="{{ route('dashboard.all') }}" class="mt-4 btn btn-outline-primary btn-lg d-block">
                        Open Dashboard
                    </a>
                </p>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
                <img src="https://uxsad.github.io/assets/images/landing.svg" alt="" class="w-100">
            </div>
        </div>
    </section>
    <section id="publications" class="container py-5">
        <h2 class="font-serif font-weight-bold">Publications on SERENE</h2>
        @publications
    </section>
</main>
@include('components.footer')
</body>
</html>
