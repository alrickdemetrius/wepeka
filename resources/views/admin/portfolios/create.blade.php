@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #f0f4ff, #dfe9f3);
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
    .form-control:focus {
        box-shadow: 0 0 0 3px rgba(255, 193, 7, 0.2);
        border-color: #ffc107;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="glass-card p-4 p-md-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold mb-0">🚀 Create New Portfolio</h3>
                    <a href="{{ route('admin.portfolios.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger border-0 rounded-3 shadow-sm">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.portfolios.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        {{-- Brand / Client --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Brand / Client</label>
                            <select name="brand_id" class="form-select" required>
                                <option value="" selected disabled>Select Client...</option>
                                @foreach($brands as $brand)
                                    {{-- PERBAIKAN: Pakai $brand->name sesuai migrasi terbaru --}}
                                    <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Category --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Category</label>
                            <select name="portfolio_category_id" class="form-select" required>
                                <option value="" selected disabled>Select Category...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('portfolio_category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Project Title --}}
                    <div class="mb-3">
                        <label class="form-label">Project Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}"
                               required placeholder="Enter project name">
                    </div>

                    {{-- Description --}}
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="4"
                                  placeholder="Describe the project details...">{{ old('description') }}</textarea>
                    </div>

                    {{-- Multiple Image Upload --}}
                    <div class="mb-3">
                        <label class="form-label">Project Images</label>
                        <input type="file" name="images[]" class="form-control" accept="image/*" multiple>
                        <div class="form-text mt-2">
                            <i class="bi bi-info-circle"></i> Kamu bisa memilih lebih dari satu gambar sekaligus (Max 2MB per file).
                        </div>
                    </div>

                    {{-- Featured Checkbox --}}
                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured"
                                   {{ old('is_featured') ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold" for="is_featured">
                                Feature this on Homepage?
                            </label>
                        </div>
                    </div>

                    <hr class="my-4 opacity-50">

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-warning px-5 fw-bold rounded-pill">
                            Create Portfolio
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection