@extends("layouts.app")

@section('content')

<div class="bg-dark text-white d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <h1 class="display-3 fw-light mb-5">Welcome, {{ Auth::user()->name }}</h1>

                    <div class="d-grid gap-3">
                        <a href="{{ route("client.profile") }}" class="btn btn-light btn-lg rounded-pill py-3 px-5 text-dark fw-semibold shadow">
                            Profile
                        </a>
                        <a href="{{ route("client.link.view_link") }}" class="btn btn-light btn-lg rounded-pill py-3 px-5 text-dark fw-semibold shadow">
                            Link Management
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection