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


</head>

<body>
    <div id="app">
        <div id="sidebarOverlay" class="sidebar-overlay" onclick="toggleSidebar()"></div>

        <div id="mobileSidebar" class="mobile-sidebar">
            @auth
                @if (Auth::user()->role !== 'admin')
                    <div class="text-center mb-4">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('images/logowepeka_ed.png') }}" alt="Wepeka Logo" class="logo-img">
                        </a>
                    </div>
                @endif
            @else
                <div class="text-center mb-4">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('images/logowepeka_ed.png') }}" alt="Wepeka Logo" class="logo-img">
                    </a>
                </div>
            @endauth
            @auth
                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('admin.bookings.index') }}" class="nav-link">Bookings</a>
                @else
                    <a href="{{ route('booking') }}" class="btn btn-warning w-100 fw-bold rounded-pill mb-4 py-2 shadow-sm">
                        <i class="bi bi-calendar-check-fill me-2"></i> BOOK NOW
                    </a>
                @endif
            @else
                <a href="{{ route('booking') }}" class="btn btn-warning w-100 fw-bold rounded-pill mb-4 py-2 shadow-sm">
                    <i class="bi bi-calendar-check-fill me-2"></i> BOOK NOW
                </a>
            @endauth


            <a href="{{ url('/') }}" class="nav-link">Home</a>
            <a href="{{ route('about') }}" class="nav-link">About</a>
            @auth
                @if (Auth::user()->role === 'admin')
                    <a href="{{ url('/admin') }}" class="nav-link">Clients</a>
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

                    <div class="d-none d-xxl-flex align-items-center gap-2">
                        @auth
                            @if (Auth::user()->role === 'admin')
                                <a class="nav-link"
                                    href="{{ route('admin.bookings.index') }}">
                                    <i class="bi bi-calendar-check-fill me-2"></i> Bookings
                                </a>
                            @else
                                <a class="nav-link nav-book-btn d-flex align-items-center" href="{{ route('booking') }}">
                                    <i class="bi bi-calendar-check-fill me-2"></i> BOOK NOW
                                </a>
                            @endif
                        @else
                            <a class="nav-link nav-book-btn d-flex align-items-center" href="{{ route('booking') }}">
                                <i class="bi bi-calendar-check-fill me-2"></i> BOOK NOW
                            </a>
                        @endauth

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

                @guest
                    <div class="d-flex justify-content-center">
                        <a class="navbar-brand mx-auto wepeka-logo-link" href="{{ route('home') }}">
                            <img src="{{ asset('images/logowepeka_ed.png') }}" alt="Wepeka Logo" class="logo-img">
                        </a>
                    </div>
                @else
                    @if (Auth::user()->role !== 'admin')
                        <div class="d-flex justify-content-center">
                            <a class="navbar-brand mx-auto wepeka-logo-link" href="{{ route('home') }}">
                                <img src="{{ asset('images/logowepeka_ed.png') }}" alt="Wepeka Logo" class="logo-img">
                            </a>
                        </div>
                    @endif
                @endguest

                <div class="d-flex align-items-center gap-3 d-none d-md-flex">
                    <a class="nav-link {{ request()->is('faq') ? 'active' : '' }}" href="{{ route('faq') }}">FAQ</a>
                    <a class="nav-link {{ request()->is('socials') ? 'active' : '' }}"
                        href="{{ route('socials') }}">Socials</a>
                    @guest
                        <a class="btn text-white fw-semibold px-4 py-2"
                            style="background-color: #87a9c4; border-radius: 999px; font-size: 14px;"
                            href="{{ route('login') }}">Sign In</a>
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
        @auth
            @if (Auth::user()->role === 'admin')
                <a href="{{ url('/admin') }}" class="nav-link">Dashboard</a>
                <a href="{{ route('admin.bookings.index') }}" class="nav-link">Bookings</a>
            @else
                <a href="{{ route('client.profile') }}" class="nav-link">Profile</a>
                <a href="{{ route('client.link.view_link') }}" class="nav-link">Link Management</a>
            @endif
        @endauth
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