@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h3>Create Client</h3>

        {{-- Form with anti-autofill tricks --}}

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.users.store') }}" method="POST" autocomplete="off">
            @csrf

            {{-- Autofill bait --}}
            <input type="text" name="fakeuser" style="display:none">
            <input type="password" name="fakepass" style="display:none">

            <div class="mb-3">
                <label>Client Name</label>
                <input type="text" name="name" class="form-control" required autocomplete="off">
            </div>

            <div class="mb-3">
                <label>Client Email</label>
                <input type="email" name="email" class="form-control" required autocomplete="new-email" readonly
                    onfocus="this.removeAttribute('readonly');">
            </div>

            <div class="mb-3">
                <label>Contact Person</label>
                <input type="text" name="contact_name" class="form-control" required autocomplete="off">
            </div>

            <div class="mb-3">
                <label>Contact Number</label>
                <input type="text" name="contact_number" class="form-control" required autocomplete="off">
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required autocomplete="new-password" readonly
                    onfocus="this.removeAttribute('readonly');">
            </div>

            <div class="mb-3">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" required
                    autocomplete="new-password" readonly onfocus="this.removeAttribute('readonly');">
            </div>

            <button class="btn btn-success">Create Client</button>
        </form>
    </div>
@endsection