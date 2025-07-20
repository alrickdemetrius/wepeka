<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- SEO -->
    <meta name="keywords" content="Wepeka, Apparel, Clothing, Baju, Brand, Kaos, Seragam, Custom, Sablon, Bordir, Tag, QR">
    <meta name="description" content="Wepeka is the best option for your branding kit.">
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
        padding: 0 50px;
        /* spacing antar link */
    }


    .logo-img {
        height: 35px;
    }

    @media (max-width: 768px) {
        .nav-link {
            font-size: 14px;
        }

        .logo-img {
            height: 24px;
        }
    }

    .nav-link.active {
        color: #ffc107 !important;
        /* kuning */
        font-weight: bold;
    }
</style>

<body>
    <div id="app">
        <nav class="navbar navbar-light bg-white shadow-sm">
            <div class="container d-flex justify-content-between align-items-center">
                <!-- Kiri -->
                <div class="d-flex align-items-center gap-5">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                    @auth
                        @if (Auth::user()->role === 'admin')
                            <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}"
                                href="{{ url('/admin') }}">Dashboard</a>
                        @else
                            <a class="nav-link {{ request()->is('client/headquarters') ? 'active' : '' }}"
                                href="{{ url('/client/headquarters') }}">Headquarter</a>
                        @endif
                    @else
                        <a class="nav-link {{ request()->is('client/headquarters') ? 'active' : '' }}"
                            href="{{ url('/client/headquarters') }}">Headquarter</a>
                    @endauth
                    <a class="nav-link {{ request()->is('about') ? 'active' : '' }}"
                        href="{{ url('/about') }}">About</a>
                </div>

                <!-- Tengah (Logo) -->
                <div class="d-flex justify-content-center">
                    <a class="navbar-brand mx-auto" href="{{ url('/') }}">
                        <img src="{{ asset('images/logowepeka_ed.png') }}" alt="Wepeka Logo" class="logo-img">
                    </a>
                </div>

                <!-- Kanan -->
                <div class="d-flex align-items-center gap-5">
                    <a class="nav-link {{ request()->is('faq') ? 'active' : '' }}" href="{{ url('/faq') }}">FaQ</a>
                    <a class="nav-link {{ request()->is('socials') ? 'active' : '' }}"
                        href="{{ url('/socials') }}">Socials</a>

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

        <main>
            @yield('content')
        </main>
    </div>
</body>

</html>