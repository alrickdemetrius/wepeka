<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- SEO -->
    <meta name="keywords"
        content="Wepeka, Apparel, Clothing, Baju, Brand, Kaos, Seragam, Custom, Sablon, Bordir, Tag, QR">
    <meta name="description" content="Wepeka Apparel membantu bisnis membangun identitas brand profesional
    lewat branding kit lengkap:
    logo, color palette, apparel, dan merchandise custom.">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Wepeka Apparel | Branding Kit & Apparel untuk Bisnis dan Organisasi</title>
    <link rel="icon" href="{!! asset('images/logo_web.png') !!}" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <script async src="https://www.instagram.com/embed.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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

        /* Modal Card Styling */
        .logout-card {
            background-color: white;
            padding: 2rem;
            width: 100%;
            max-width: 430px;
            height: 300px;
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .logout-title {
            font-size: 22px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 12px;
            letter-spacing: 0.5px;
        }

        @media (max-width: 1024px) {
            .logout-title {
                font-size: 1.2rem;
                /* kecilkan font */
            }
        }

        @media (max-width: 768px) {
            .logout-title {
                font-size: 1rem;
                padding: 0 10px;
                /* beri jarak kiri-kanan */
            }
        }

        @media (max-width: 480px) {
            .logout-title {
                font-size: 0.9rem;
            }
        }

        .logo-container {
            background: white;
            border-radius: 50%;
            padding: 20px;
            position: absolute;
            top: -50px;
            inset-inline: 0;
            margin-inline: auto;
            width: 100px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1;
        }

        .logo-img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            display: block;
            border-radius: 50%;
        }

        /* Responsive adjustments for small screens */
        @media (max-width: 576px) {
            .logout-card {
                padding: 1.5rem 1rem;
                max-width: 90%;
            }

            .logo-container {
                top: -35px;
                width: 80px;
                height: 80px;
                padding: 15px;
            }

            .logout-title {
                font-size: 18px;
            }
        }

        /* Ensure modal above sidebar */
        .modal {
            z-index: 9999 !important;
        }

        .modal.fade .modal-dialog {
            transform: translateY(-10px) scale(0.95);
            opacity: 0;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .modal.fade.show .modal-dialog {
            transform: translateY(0) scale(1);
            opacity: 1;
        }

        /* ====================================================================== */
        /* CSS UNTUK FOOTER (VERSI DIPERBESAR)                                    */
        /* ====================================================================== */
        /* Ukuran logo di footer diperbesar */
        footer .logo-img {
            height: 70px;
        }

        /* Ukuran link di footer diperbesar */
        .footer-links p,
        .footer-links a {
            font-size: 1rem;
            /* Sedikit lebih besar dari sebelumnya */
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: color 0.2s ease-in-out;
        }

        .footer-links a:hover {
            color: #ffffff;
        }

        /* Ukuran ikon sosial diperbesar */
        .social-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            /* Diperbesar dari 38px */
            height: 42px;
            /* Diperbesar dari 38px */
            border: 1px solid rgba(255, 255, 255, 0.7);
            border-radius: 50%;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-size: 1.1rem;
            /* Ukuran ikon di dalam diperbesar */
            transition: all 0.2s ease-in-out;
        }

        .social-icon:hover {
            background-color: #ffffff;
            color: #212529;
            border-color: #ffffff;
        }
    </style>
</head>

<body>
    <div id="app">
        <div id="sidebarOverlay" class="sidebar-overlay" onclick="toggleSidebar()"></div>

        <div id="mobileSidebar" class="mobile-sidebar">
            <div class="text-center mb-4">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/logowepeka_ed.png') }}" alt="Wepeka Logo" class="logo-img">
                </a>
            </div>
            <a href="{{ url('/') }}" class="nav-link">Home</a>
            <a href="{{ route('about') }}" class="nav-link">About</a>
            @auth
                @if (Auth::user()->role === 'admin')
                    <a href="{{ url('/admin') }}" class="nav-link">Dashboard</a>
                @else
                    <a href="{{ route('client.headquarters') }}" class="nav-link">Headquarters</a>
                @endif
            @else
                <a href="{{ route('client.headquarters') }}" class="nav-link">Headquarters</a>
            @endauth

            <a href="{{ route('faq') }}" class="nav-link">FAQ</a>
            <a href="{{ route('socials') }}" class="nav-link">Socials</a>

            @guest
                <a class="btn btn-primary mt-3" href="{{ route('login') }}">Sign In</a>
            @else
                <a href="#" class="nav-link text-danger" onclick="event.preventDefault(); showLogoutModal();">
                    <i class="fas fa-sign-out-alt me-2"></i>Sign Out
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endguest
        </div>

        <nav class="navbar navbar-light bg-white shadow-sm sticky-top">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <button class="btn d-block d-xxl-none me-3" onclick="toggleSidebar()"
                        style="font-size: 24px; border: none; background: none;">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="d-none d-xxl-flex align-items-center gap-5">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                        <a class="nav-link {{ request()->is('about') ? 'active' : '' }}"
                            href="{{ route('about') }}">About</a>
                        @auth
                            @if (Auth::user()->role === 'admin')
                                <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}"
                                    href="{{ url('/admin') }}">Dashboard</a>
                            @else
                                <a class="nav-link {{ request()->is('client/headquarters') ? 'active' : '' }}"
                                    href="{{ route('client.headquarters') }}">Headquarters</a>
                            @endif
                        @else
                            <a class="nav-link {{ request()->is('client/headquarters') ? 'active' : '' }}"
                                href="{{ route('client.headquarters') }}">Headquarter</a>
                        @endauth

                    </div>
                </div>

                <div class="d-flex justify-content-center">
                    <a class="navbar-brand mx-auto wepeka-logo-link" href="{{ route('home') }}">
                        <img src="{{ asset('images/logowepeka_ed.png') }}" alt="Wepeka Logo" class="logo-img">
                    </a>
                </div>

                @auth
                    @if(Auth::user()->role === 'client' && Auth::user()->logo)
                        <div class="d-block d-md-none">
                            <img src="{{ asset('storage/' . Auth::user()->logo) }}" alt="Client Logo"
                                class="client-logo mobile-disabled" onclick="toggleClientSidebar()">
                        </div>
                    @endif
                @endauth

                <div class="d-flex align-items-center gap-5 d-none d-md-flex">
                    <a class="nav-link {{ request()->is('faq') ? 'active' : '' }}" href="{{ route('faq') }}">FAQ</a>
                    <a class="nav-link {{ request()->is('socials') ? 'active' : '' }}"
                        href="{{ route('socials') }}">Socials</a>
                    @guest
                        <a class="btn text-white fw-semibold px-3 py-2"
                            style="background-color: #87a9c4; border-radius: 999px;" href="{{ route('login') }}">Sign In</a>
                    @else
                        @if(Auth::user()->role === 'client' || Auth::user()->role === 'admin')
                            @if(Auth::user()->logo)
                                <img src="{{ asset('storage/' . Auth::user()->logo) }}" alt="Client Logo"
                                    class="client-logo d-none d-lg-block" onclick="toggleClientSidebar()">
                            @else
                                <i class="fas fa-user-circle fa-2x client-logo" style="cursor:pointer"
                                    onclick="toggleClientSidebar()"></i>
                            @endif
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
        <div class="text-center mb-4">
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/logowepeka_ed.png') }}" alt="Wepeka Logo" class="logo-img">
            </a>
        </div>
        <a href="{{ route('client.profile') }}" class="nav-link">Profile</a>
        <a href="{{ route('client.link.view_link') }}" class="nav-link">Link Management</a>
        <a href="#" class="nav-link mt-3 text-danger d-flex align-items-center"
            onclick="event.preventDefault(); showLogoutModal();">
            <i class="fas fa-sign-out-alt me-2"></i> Sign Out
        </a>
        <form id="logout-form-client" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>

    <!-- Logout Confirmation Modal -->
    <div class="modal fade" id="logoutConfirmModal" tabindex="-1" aria-labelledby="logoutConfirmLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div
                class="modal-content bg-transparent border-0 shadow-none d-flex justify-content-center align-items-center">
                <div class="logout-card bg-white">
                    <div class="logo-container">
                        <img src="{{ asset('images/logowepeka_ed.png') }}" alt="Logo" class="logo-img">
                    </div>
                    <div class="logout-title">Are you sure you want to log out?</div>
                    <div class="text-center text-muted" style="margin-bottom: 30px;">
                        All unsaved changes will be lost.
                    </div>
                    <div class="d-flex justify-content-center gap-3">
                        <button type="button" class="btn btn-secondary rounded-pill px-4"
                            data-bs-dismiss="modal">No</button>
                        <button type="button" class="btn btn-danger rounded-pill px-4"
                            id="confirmLogoutBtn">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <script>
        function toggleSidebar() {
            document.getElementById("mobileSidebar").classList.toggle("show");
            document.getElementById("sidebarOverlay").classList.toggle("show");
        }

        function toggleClientSidebar() {
            document.getElementById("clientSidebar").classList.toggle("show");
            document.getElementById("clientSidebarOverlay").classList.toggle("show");
        }

        function showLogoutModal() {
            // Tutup semua sidebar saat modal muncul
            document.getElementById("mobileSidebar")?.classList.remove("show");
            document.getElementById("sidebarOverlay")?.classList.remove("show");
            document.getElementById("clientSidebar")?.classList.remove("show");
            document.getElementById("clientSidebarOverlay")?.classList.remove("show");

            let modal = new bootstrap.Modal(document.getElementById('logoutConfirmModal'));
            modal.show();
        }

        document.getElementById('confirmLogoutBtn').addEventListener('click', function () {
            document.getElementById('logout-form')?.submit();

        });
    </script>


    <footer class="bg-dark text-white pt-5 pb-4">
        {{--
        'container' secara otomatis akan menyesuaikan lebarnya di berbagai ukuran layar.
        'text-center text-md-start' berarti:
        - Di layar HP (kecil), semua teks akan rata tengah.
        - Di layar tablet/desktop (medium ke atas), teks akan rata kiri.
        --}}
        <div class="container text-center text-md-start">
            <div class="row">

                {{--
                'col-md-4' berarti kolom ini akan mengambil 4 dari 12 bagian grid di layar medium ke atas.
                Di layar HP (di bawah medium), kolom ini akan otomatis mengambil lebar penuh (12 bagian) dan tersusun ke
                bawah.
                'mb-4' (margin-bottom) berfungsi untuk memberi jarak saat kolom-kolom ini tersusun ke bawah di layar HP.
                --}}
                <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mb-4">
                    <img src="{{ asset('images/logowepeka_gelap.png') }}" alt="Wepeka Logo" class="logo-img mb-2">
                    <p class="text-white-50" style="font-size: 1rem;">
                        Your trusted branding partner for creating powerful brand identities that connect, convert, and
                        captivate your audience.
                    </p>
                    <div class="mt-3">
                        <a href="#" class="social-icon me-2"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-icon me-2"><i class="bi bi-twitter"></i></a>
                        <a href="https://www.instagram.com/wepeka.apparel/" class="social-icon me-2"><i
                                class="bi bi-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-tiktok"></i></a>
                    </div>
                </div>

                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4 footer-links">
                    <h5 class="text-uppercase fw-bold mb-4">Quick Links</h5>
                    <p><a href="#">Home</a></p>
                    <p><a href="#">Headquarters</a></p>
                    <p><a href="#">About Us</a></p>
                    <p><a href="#">Contact</a></p>
                </div>

                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4 footer-links">
                    <h5 class="text-uppercase fw-bold mb-4">Services</h5>
                    <p><a href="#">Logo Design</a></p>
                    <p><a href="#">Brand Guidelines</a></p>
                    <p><a href="#">Scaling Up</a></p>
                    <p><a href="#">Apparel</a></p>
                    <p><a href="#">Brand Insights</a></p>
                </div>

                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4 footer-links">
                    <h5 class="text-uppercase fw-bold mb-4">Contact Info</h5>
                    <p><i class="bi bi-envelope-fill me-3"></i> wepeka@gmail.com</p>
                    <p><i class="bi bi-telephone-fill me-3"></i> +62 --- ---- ----</p>
                    <p><i class="bi bi-geo-alt-fill me-3"></i> Location</p>
                </div>
            </div>

            <hr class="my-4">

            <div class="row align-items-center">
                {{--
                'col-md-6' akan membuat kolom ini mengambil setengah lebar di layar medium ke atas.
                Di layar HP, ini juga akan tersusun ke bawah secara otomatis.
                'text-md-start' membuat teks rata kiri di desktop, dan 'text-center' (dari div container di atas)
                membuatnya rata tengah di HP.
                --}}
                <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                    <p class="mb-0 text-white-50">&copy; {{ date('Y') }} Wepeka. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end footer-links">
                    <a href="#" class="ms-3">Privacy Policy</a>
                    <a href="#" class="ms-3">Terms of Service</a>
                    <a href="#" class="ms-3">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>
    @stack('scripts')
</body>

</html>