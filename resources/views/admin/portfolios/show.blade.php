@extends('layouts.app')

@section('content')
<style>
    .project-header {
        background-color: #f8f9fa;
        padding: 60px 0;
        border-bottom: 1px solid #eee;
    }
    .gallery-img {
        width: 100%;
        border-radius: 15px;
        margin-bottom: 20px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        transition: transform 0.3s ease;
    }
    .gallery-img:hover {
        transform: scale(1.02);
    }
    .badge-category {
        background-color: #FFD700;
        color: #000;
        font-weight: 600;
        padding: 8px 20px;
        border-radius: 50px;
    }
</style>

<div class="project-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <span class="badge badge-category mb-3">{{ $portfolio->category->name }}</span>
                <h1 class="display-4 fw-bold">{{ $portfolio->title }}</h1>
                <p class="lead text-muted">A project for <strong>{{ $portfolio->brand->name }}</strong></p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('home') }}" class="btn btn-outline-dark rounded-pill px-4">
                    <i class="bi bi-arrow-left me-2"></i> Back to Home
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        {{-- Kiri: Deskripsi Project --}}
        <div class="col-lg-4 mb-5">
            <div class="sticky-top" style="top: 100px;">
                <h4 class="fw-bold mb-3">About Project</h4>
                <p class="text-muted" style="line-height: 1.8;">
                    {{ $portfolio->description ?? 'No description provided for this project.' }}
                </p>
                <hr>
                <div class="small text-muted">
                    <strong>Client:</strong> {{ $portfolio->brand->name }}<br>
                    <strong>Category:</strong> {{ $portfolio->category->name }}<br>
                    <strong>Date:</strong> {{ $portfolio->created_at->format('M Y') }}
                </div>
            </div>
        </div>

        {{-- Kanan: Galeri Foto --}}
        <div class="col-lg-8">
            <div class="row">
                @forelse($portfolio->images as $image)
                    <div class="col-12">
                        <img src="{{ asset('storage/' . $image->image_path) }}"
                             class="gallery-img"
                             alt="Gallery for {{ $portfolio->title }}">
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">No images available for this project gallery.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection