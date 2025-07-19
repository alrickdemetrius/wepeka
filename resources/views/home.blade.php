@extends('layouts.app')

@section('content')
<div class="bg-light min-vh-100 d-flex align-items-center justify-content-center">
    <div class="container text-center py-5">
        <h1 class="display-4 fw-bold mb-4 text-dark">Welcome to Wepeka</h1>
        <p class="lead text-secondary mb-5">
            A platform for managing events, QR code attendance, and more.
        </p>

        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('login') }}" class="btn btn-dark btn-lg px-4 rounded-pill shadow">Login</a>

        </div>
    </div>
</div>
@endsection
