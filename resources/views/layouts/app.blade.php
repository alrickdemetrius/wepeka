<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Wepeka</title>
    <link rel="icon" href="{!! asset('images/logo_web.png') !!}" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<style>
    .logo-img {
        height: 35px;
        /* Sesuaikan agar sejajar vertikal */
    }

    .nav-link {
        font-size: 16px;
        color: #000;
        text-decoration: none;
    }


    @media (max-width: 768px) {
        .nav-link {
            font-size: 14px;
        }

        .logo-img {
            height: 24px;
        }
    }
</style>

<body>
    <div id="app">
        <nav class="navbar navbar-light bg-white shadow-sm">
            <div class="container d-flex justify-content-between align-items-center">

                <!-- Kiri -->
                <div class="d-flex align-items-center justify-content-start flex-grow-1">
    <a class="nav-link me-4" href="{{ url('/') }}">Home</a>
    <a class="nav-link me-4" href="{{ url('/headquarters') }}">Headquarter</a>
    <a class="nav-link" href="#">About</a>
</div>

                <!-- Tengah (Logo) -->
                <div class="d-flex justify-content-center flex-grow-0">
                    <a class="navbar-brand mx-auto" href="{{ url('/') }}">
                        <img src="{{ asset('images/logowepeka_ed.png') }}" alt="Wepeka Logo" class="logo-img">
                    </a>
                </div>

                <!-- Kanan -->
                <div class="d-flex align-items-center justify-content-end flex-grow-1 gap-5">
                    <a class="nav-link" href="#">FaQ</a>
                    <a class="nav-link" href="#">Socials</a>

                    @guest
                        @if (Route::has('login'))
                            <a class="btn text-white fw-semibold px-3 py-2"
                                style="background-color: #87a9c4; border-radius: 999px;" href="{{ route('login') }}">
                                Sign In
                            </a>
                        @endif
                    @else
                        <div class="dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>