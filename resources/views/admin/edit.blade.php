@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2>Edit Client</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.users.update', $user->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input name="name" class="form-control" value="{{ old('name', $user->name) }}">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input name="email" class="form-control" value="{{ old('email', $user->email) }}">
        </div>

        <div class="mb-3">
            <label>Contact Name</label>
            <input name="contact_name" class="form-control" value="{{ old('contact_name', $user->contact_name) }}">
        </div>

        <div class="mb-3">
            <label>Contact Number</label>
            <input name="contact_number" class="form-control" value="{{ old('contact_number', $user->contact_number) }}">
        </div>

        <div class="mb-3">
            <label>Logo</label>
            <input type="file" name="logo" class="form-control">
            @if($user->logo)
                <img src="{{ asset('storage/' . $user->logo) }}" width="80" class="mt-2">
            @endif
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
