@extends('layouts.app')

<style>
    .logo-img {
        height: calc(1em * 1.2);
        width: auto;
        vertical-align: middle;
        margin: 0 0.1em;
    }

    .text-white-custom * {
        color: white !important;
    }
</style>

@section('content')
    <div style="background: url('{{ asset('images/blur_home.jpg') }}')" class="bg-light min-vh-100 d-flex align-items-center justify-content-center">
        <div class="container text-center py-5 text-white-custom">
            <h1 class="display-4 fw-bold mb-4">
                Welcome to <span class="text-warning fw-semibold">We</span><span class="fw-semibold">peka</span> Site
            </h1>
            <h2 class="mb-5 fw-bold">
                Identity That Inspires
            </h2>
            <h1 class="display-6 mb-4">
                Branding Kit Lengkap untuk Bisnis Anda.
            </h1>
            @if(Auth::user())
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('client.headquarters') }}" class="btn btn-dark btn-lg px-4 rounded-pill shadow">Headquarters</a>
                </div>
                <div class="d-flex justify-content-center gap-3 mb-5">
                    <p class="lead mb-5">
                        A platform for managing events, QR code, and more.
                    </p>
                </div>
            @else
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('login') }}" class="btn btn-dark btn-lg px-4 rounded-pill shadow">Login</a>
                </div>
            @endif
        </div>
    </div>
@endsection
