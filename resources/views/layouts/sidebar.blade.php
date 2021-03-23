<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <style>
        body {
            font-size: .875rem;
        }

        .feather {
            width: 16px;
            height: 16px;
            vertical-align: text-bottom;
        }

        /*
         * Sidebar
         */

        .sidebar {
            position: fixed;
            top: 0;
            /* rtl:raw:
            right: 0;
            */
            bottom: 0;
            /* rtl:remove */
            left: 0;
            z-index: 100; /* Behind the navbar */
            padding: 48px 0 0; /* Height of navbar */
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        }

        /*@media (max-width: 767.98px) {
          .sidebar {
            top: 5rem;
          }
        }*/

        .sidebar-sticky {
            position: relative;
            top: 0;
            height: calc(100vh - 48px);
            padding-top: .5rem;
            overflow-x: hidden;
            overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
        }

        .sidebar .nav-link {
            font-weight: 500;
            color: #333;
        }

        .sidebar .nav-link .feather {
            margin-right: 4px;
            color: #727272;
        }

        .sidebar .nav-link.active {
            color: #007bff;
        }

        .sidebar .nav-link:hover .feather,
        .sidebar .nav-link.active .feather {
            color: inherit;
        }

        .sidebar-heading {
            font-size: .75rem;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
<header class="navbar navbar-dark navbar-expand-lg sticky-top bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">UX-SAD</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</header>
<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3">
                <div class="container-fluid px-0 py-5 text-center">
                    <img src="https://robohash.org/{{Auth::user()->email}}?set=set4" alt="Profile picture"
                         class="img-thumbnail d-block mx-auto rounded-circle p-1" style="width: 64px"/>
                    <p class="mb-0 mt-2 fs-5">{{Auth::user()->name}}</p>
                    <hr class="mb-0">
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#website-menu-collapse" role="button"
                           aria-expanded="true" aria-controls="website-menu-collapse">
                            <span class="bi bi-house-door mr-2"></span>
                            Websites
                        </a>
                        <ul class="ms-3 list-group collapse show" id="website-menu-collapse">
                            <li class="list-group-item"><a href="#">My Websites</a></li>
                            <li class="list-group-item"><a href="#">Shared With Me</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <main class="col-md-9 ms-sm-auto my-sm-5 col-lg-10 px-md-5">
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
            crossorigin="anonymous"></script>
</body>
</html>
