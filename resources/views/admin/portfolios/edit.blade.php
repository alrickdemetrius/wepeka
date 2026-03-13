@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #f0f4ff, #dfe9f3);
        min-height: 100vh;
    }
    .glass-card {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(12px);
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    .form-label {
        font-weight: 600;
        color: #444;
    }
    .form-control, .form-select {
        border-radius: 10px;
        border: 1px solid #ddd;
        padding: 10px 15px;
    }
    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15);
        border-color: #0d6efd;
    }
    .current-image {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 12px;
        border: 2px solid #fff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        transition: transform 0.2s;
    }
    .current-image:hover {
        transform: scale(1.05);
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="glass-card p-4 p-md-5">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold mb-0">✏️ Edit Project Portfolio</h3>
                    <a href="{{ route('admin.portfolios.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger border-0 rounded-3 shadow-sm mb-4">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.portfolios.update', $portfolio->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        {{-- Brand Selection --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Brand / Client</label>
                            <select name="brand_id" class="form-select" required>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ $portfolio->brand_id == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Portfolio Category (DROPDOWN) --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Category</label>
                            <select name="portfolio_category_id" class="form-select" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ (old('portfolio_category_id', $portfolio->portfolio_category_id) == $category->id) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Project Title --}}
                    <div class="mb-3">
                        <label class="form-label">Project Title</label>
                        <input name="title" class="form-control" value="{{ old('title', $portfolio->title) }}" required>
                    </div>

                    {{-- Description --}}
                    <div class="mb-4">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="4">{{ old('description', $portfolio->description) }}</textarea>
                    </div>

                    {{-- Current Gallery --}}
                    <div class="mb-4">
                        <label class="form-label d-block mb-3">Current Gallery</label>
                        <div class="d-flex flex-wrap gap-3 p-3 bg-light rounded-4 border border-dashed">
                            @forelse($portfolio->images as $image)
                                <div class="position-relative">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" class="current-image">
                                </div>
                            @empty
                                <div class="text-center w-100 py-3 text-muted small">
                                    <i class="bi bi-image mb-2 d-block fs-4"></i> No images in gallery.
                                </div>
                            @endforelse
                        </div>
                    </div>

                    {{-- Add More Images --}}
                    <div class="mb-4">
                        <label class="form-label">Add More Images</label>
                        <input type="file" name="images[]" class="form-control" accept="image/*" multiple>
                        <div class="form-text mt-2">
                            <i class="bi bi-plus-circle"></i> Upload foto baru untuk ditambahkan ke galeri ini.
                        </div>
                    </div>

                    {{-- Featured Toggle --}}
                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured"
                                {{ $portfolio->is_featured ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold" for="is_featured">Feature on Homepage?</label>
                        </div>
                    </div>

                    <hr class="my-4 opacity-50">

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-primary px-5 fw-bold rounded-pill shadow-sm">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection