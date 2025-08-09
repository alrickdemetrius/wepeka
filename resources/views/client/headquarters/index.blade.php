@extends("layouts.app")

@section('content')

    <style>
        .logo-half-right {
            position: absolute;
            top: 2%;
            right: 0px;
            transform: translateY(-52%);
            z-index: 10;
            padding: 0;
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
            overflow: hidden;
            height: 1000px;
            width: 450px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        .logo-half-right img {
            height: auto;
            width: auto;
            object-fit: cover;
            object-position: left center;
            transform: scale(10) translateX(-4.8px);
            transform-origin: left center;
        }

        @media (max-width: 1700px) {
            .logo-half-right {
                display: none;
            }
        }

        @media (max-height: 900px) {
            .logo-half-right {
                display: none;
            }
        }

        /* Animasi Fade In */
        .fade-in-up {
            opacity: 0;
            transform: translateY(20px);
            filter: blur(10px);
            animation: fadeInUp 0.8s ease-out forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
                filter: blur(0);
            }
        }

        .fade-delay-1 {
            animation-delay: 0.1s;
        }

        .fade-delay-2 {
            animation-delay: 0.3s;
        }

        .fade-delay-3 {
            animation-delay: 0.5s;
        }

        .fade-delay-4 {
            animation-delay: 0.7s;
        }

        .fade-delay-5 {
            animation-delay: 0.9s;
        }

        .btn-hover-yellow:hover {
            background-color: #ffc107 !important;
            /* kuning */
            color: white !important;
            /* teks putih */
            text-shadow: 0 0 4px rgba(255, 255, 255, 0.4); /* glowing lebih lembut */
            /* glowing */
            transform: translateY(-2px);
            /* sedikit naik saat hover */
            transition: all 0.3s ease-in-out;
        }
    </style>

    <div class="bg-dark text-white d-flex align-items-center justify-content-center position-relative"
        style="min-height: 100vh; background: url('{{ asset('images/blur_headquarters.jpg') }}') no-repeat center center fixed; background-size: cover;">

        <!-- Logo setengah kiri di kanan -->
        @if(Auth::user()->logo)
            <div class="logo-half-right fade-in-up fade-delay-3">
                <img src="{{ asset('storage/' . Auth::user()->logo) }}" alt="Company Logo" style="width: 100px;">
            </div>
        @endif

        <!-- Konten utama -->
        <div class="container text-center fade-in-up fade-delay-1">
            <h1 class="display-3 fw-light mb-5 fade-in-up fade-delay-2">
                Welcome, {{ Auth::user()->name }}!
            </h1>

            <div class="d-grid gap-3 col-md-6 mx-auto fade-in-up fade-delay-4">
                <a href="{{ route('client.profile') }}"
                    class="btn btn-light btn-lg rounded-pill py-3 px-5 text-dark fw-semibold shadow fade-in-up fade-delay-4 btn-hover-yellow">
                    Profile
                </a>
                <a href="{{ route('client.link.view_link') }}"
                    class="btn btn-light btn-lg rounded-pill py-3 px-5 text-dark fw-semibold shadow fade-in-up fade-delay-5 btn-hover-yellow">
                    Link Management
                </a>
            </div>
        </div>
    </div>

@endsection