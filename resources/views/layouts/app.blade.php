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
    <script async src="https://www.instagram.com/embed.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        .logo-img {
            height: 35px;
        }

        .nav-link {
            font-size: 16px;
            color: #000;
            text-decoration: none;
            padding: 0 50px;
        }

        .client-logo {
            height: 35px;
            width: 35px;
            object-fit: cover;
            border-radius: 50%;
            cursor: pointer;
        }

        .nav-link.active {
            color: #ffc107 !important;
            font-weight: bold;
        }

        .nav-link.text-danger,
        .nav-link.text-danger:hover {
            color: #dc3545 !important;
        }

        .nav-link.signout {
            margin-top: 12px;
        }

        @media (max-width: 1399.98px) {
            .d-xxl-flex {
                display: none !important;
            }

            .d-xxl-none {
                display: block !important;
            }
        }

        @media (min-width: 1400px) {
            .d-xxl-flex {
                display: flex !important;
            }

            .d-xxl-none {
                display: none !important;
            }
        }

        .mobile-sidebar,
        .client-sidebar {
            position: fixed;
            top: 0;
            right: -300px;
            width: 300px;
            height: 100%;
            background-color: white;
            box-shadow: -5px 0 15px rgba(0, 0, 0, 0.2);
            z-index: 1060;
            transition: right 0.3s ease-in-out;
            padding: 20px;
        }

        .mobile-sidebar.show,
        .client-sidebar.show {
            right: 0;
        }

        .mobile-sidebar .nav-link,
        .client-sidebar .nav-link {
            display: block;
            padding: 12px 0;
            font-size: 16px;
            color: #000;
        }

        .client-sidebar .nav-link:hover {
            color: #0d6efd;
            text-decoration: none;
        }

        .sidebar-overlay,
        #clientSidebarOverlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.3);
            z-index: 1055;
            display: none;
        }

        .sidebar-overlay.show,
        #clientSidebarOverlay.show {
            display: block;
        }

        .client-logo.mobile-disabled {
            pointer-events: none;
            opacity: 0.6;
        }
    </style>
</head>

<body>
    <div id="app">
        <div id="sidebarOverlay" class="sidebar-overlay" onclick="toggleSidebar()"></div>

        <div id="mobileSidebar" class="mobile-sidebar">
            <a href="{{ url('/') }}" class="nav-link">Home</a>
            @auth
                @if (Auth::user()->role === 'admin')
                    <a href="{{ url('/admin') }}" class="nav-link">Dashboard</a>
                @else
                    <a href="{{ route('client.headquarters') }}" class="nav-link">Headquarters</a>
                @endif
            @else
                <a href="{{ route('client.headquarters') }}" class="nav-link">Headquarter</a>
            @endauth
            <a href="{{ route('about') }}" class="nav-link">About</a>
            <a href="{{ route('faq') }}" class="nav-link">FAQ</a>
            <a href="{{ route('socials') }}" class="nav-link">Socials</a>

            @guest
                <a class="btn btn-primary mt-3" href="{{ route('login') }}">Sign In</a>
            @else
                <a class="nav-link text-danger" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt me-2"></i>Sign Out
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endguest
        </div>

        <nav class="navbar navbar-light bg-white shadow-sm">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <button class="btn d-block d-xxl-none me-3" onclick="toggleSidebar()" style="font-size: 24px; border: none; background: none;">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="d-none d-xxl-flex align-items-center gap-5">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                        @auth
                            @if (Auth::user()->role === 'admin')
                                <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ url('/admin') }}">Dashboard</a>
                            @else
                                <a class="nav-link {{ request()->is('client/headquarters') ? 'active' : '' }}" href="{{ route('client.headquarters') }}">Headquarters</a>
                            @endif
                        @else
                            <a class="nav-link {{ request()->is('client/headquarters') ? 'active' : '' }}" href="{{ route('client.headquarters') }}">Headquarter</a>
                        @endauth
                        <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
                    </div>
                </div>

                <div class="d-flex justify-content-center">
                    <a class="navbar-brand mx-auto wepeka-logo-link" href="javascript:void(0)" onclick="toggleSidebar()">
                        <img src="{{ asset('images/logowepeka_ed.png') }}" alt="Wepeka Logo" class="logo-img">
                    </a>
                </div>

                @auth
                    @if(Auth::user()->role === 'client' && Auth::user()->logo)
                        <div class="d-block d-md-none">
                            <img src="{{ asset('storage/' . Auth::user()->logo) }}" alt="Client Logo" class="client-logo mobile-disabled" onclick="toggleClientSidebar()">
                        </div>
                    @endif
                @endauth

                <div class="d-flex align-items-center gap-5 d-none d-md-flex">
                    <a class="nav-link {{ request()->is('faq') ? 'active' : '' }}" href="{{ route('faq') }}">FAQ</a>
                    <a class="nav-link {{ request()->is('socials') ? 'active' : '' }}" href="{{ route('socials') }}">Socials</a>
                    @guest
                        <a class="btn text-white fw-semibold px-3 py-2" style="background-color: #87a9c4; border-radius: 999px;" href="{{ route('login') }}">Sign In</a>
                    @else
                        @if(Auth::user()->role === 'client' && Auth::user()->logo)
                            <img src="{{ asset('storage/' . Auth::user()->logo) }}" alt="Client Logo" class="client-logo d-none d-lg-block" onclick="toggleClientSidebar()">
                        @else
                            <div class="dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        @endif
                    @endguest
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>

    <div id="clientSidebarOverlay" onclick="toggleClientSidebar()"></div>

    <div id="clientSidebar" class="client-sidebar">
        <a href="{{ route('client.profile') }}" class="nav-link">Profile</a>
        <a href="{{ route('client.link.view_link') }}" class="nav-link">Link Management</a>
        <a href="#" class="nav-link mt-3 text-danger d-flex align-items-center" onclick="event.preventDefault(); document.getElementById('logout-form-client').submit();">
            <i class="fas fa-sign-out-alt me-2"></i> Sign Out
        </a>
        <form id="logout-form-client" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById("mobileSidebar").classList.toggle("show");
            document.getElementById("sidebarOverlay").classList.toggle("show");
        }

        function toggleClientSidebar() {
            document.getElementById("clientSidebar").classList.toggle("show");
            document.getElementById("clientSidebarOverlay").classList.toggle("show");
        }
    </script>
</body>

</html>