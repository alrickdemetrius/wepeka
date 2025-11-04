@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2>Edit Portfolio</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
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

        <div class="mb-3">
            <label class="form-label">Project Name</label>
            <input name="project_name" class="form-control" value="{{ old('project_name', $portfolio->project_name) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Category</label>
            <input name="category" class="form-control" value="{{ old('category', $portfolio->category) }}" required placeholder="e.g. Apparel, Branding, Logo">
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description', $portfolio->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Upload New Image</label>
            <input type="file" name="image" class="form-control" accept="image/*">
            <div class="form-text">Leave blank to keep the current image.</div>

            @if($portfolio->image)
                <div class="mt-3">
                    <p class="mb-1">Current Image:</p>
                    <img src="{{ asset('storage/' . $portfolio->image) }}" alt="Portfolio Image" style="width: 200px; border-radius: 8px;">
                </div>
            @endif
        </div>

        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured"
                    {{ old('is_featured', $portfolio->is_featured) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_featured">
                    Feature this portfolio on Homepage?
                </label>
            </div>
        </div>

        <button class="btn btn-primary">Update Portfolio</button>
        <a href="{{ route('admin.portfolios.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection