@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h3>Create New Portfolio</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.portfolios.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Project Name</label>
                <input type="text" name="project_name" class="form-control" value="{{ old('project_name') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Category</label>
                <input type="text" name="category" class="form-control" value="{{ old('category') }}" required placeholder="e.g. Apparel, Branding, Logo">
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control" accept="image/*">
                <div class="form-text">Upload gambar untuk portofolio (Max 2MB).</div>
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured" {{ old('is_featured') ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_featured">
                        Feature this portfolio on Homepage?
                    </label>
                </div>
            </div>

            <button class="btn btn-success">Create Portfolio</button>
            <a href="{{ route('admin.portfolios.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection