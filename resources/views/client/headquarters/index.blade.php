@extends("layouts.app")

@section('content')

    <style>
        .logo-half-right {
            position: absolute;
            top: 50%;
            right: 0px;
            /* Geser sedikit ke kanan dari ujung kanan */
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
            /* Kurangi geser kanan, agar sisi kiri gambar lebih terlihat */
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
    </style>

    <div class="bg-dark text-white d-flex align-items-center justify-content-center position-relative"
        style="min-height: 100vh;">
        <!-- Logo setengah kiri, ditempelkan di kanan -->
        @if(Auth::user()->logo)
            <div class="logo-half-right">
                <img src="{{ asset('storage/' . Auth::user()->logo) }}" alt="Company Logo" style="width: 100px;">
            </div>
        @endif

        <!-- Konten utama tetap di tengah -->
        <div class="container text-center">
            <h1 class="display-3 fw-light mb-5">Welcome, {{ Auth::user()->name }}</h1>

            <div class="d-grid gap-3 col-md-6 mx-auto">
                <a href="{{ route("client.profile") }}"
                    class="btn btn-light btn-lg rounded-pill py-3 px-5 text-dark fw-semibold shadow">
                    Profile
                </a>
                <a href="{{ route("client.link.view_link") }}"
                    class="btn btn-light btn-lg rounded-pill py-3 px-5 text-dark fw-semibold shadow">
                    Link Management
                </a>
            </div>
        </div>
    </div>

@endsection