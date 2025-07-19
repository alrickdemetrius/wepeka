@extends("client.layouts.app")

@section('content')
    <div class="min-vh-100 py-4"
        style="background: url('{{ asset('images/background4_brown.jpg') }}') no-repeat center center fixed; background-size: cover;">
        <div class="container">
            <div class="row">
                <!-- Left Sidebar -->
                @include("client.partials.profile-sidebar")

                <!-- Main Content -->
                <div class="col-lg-9 col-md-8">
                    <div class="bg-white rounded p-4 shadow">
                        <!-- Page Header -->
                        <div class="mb-4">
                            <h3 class="fw-bold text-dark mb-1">User Profile</h3>
                            <p class="text-muted mb-0">
                                Manage your <span class="text-warning fw-semibold">We</span><span
                                    class="fw-semibold">peka</span> Profile!
                            </p>
                        </div>

                        <!-- Success/Error Messages -->
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- Profile Information Section -->
                        <div class="border rounded p-4 mb-4">
                            <h5 class="fw-semibold text-dark mb-3">Profile Information</h5>
                            <form action="{{ route('client.profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <!-- Logo Section -->
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label fw-semibold text-dark">Company Logo</label>
                                        <div class="text-center">
                                            <div class="border rounded p-3 mb-2"
                                                style="min-height: 120px; display: flex; align-items: center; justify-content: center; background-color: #f8f9fa;">
                                                @if(isset($cur_user->logo) && $cur_user->logo)
                                                    <img src="{{ asset('storage/' . $cur_user->logo) }}" alt="Company Logo"
                                                        class="img-fluid rounded" style="max-height: 100px; max-width: 100px;">
                                                @else
                                                    <div class="text-muted">
                                                        <i class="fas fa-image fa-2x mb-2"></i>
                                                        <div>No Logo</div>
                                                    </div>
                                                @endif
                                            </div>
                                            <input type="file"
                                                class="form-control form-control-sm @error('logo') is-invalid @enderror"
                                                name="logo" accept="image/*">
                                            @error('logo')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="text-muted">Max size: 2MB</small>
                                        </div>
                                    </div>

                                    <!-- Company Info Section -->
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-semibold text-dark">Company Name</label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                    name="name" value="{{ old('name', $cur_user->name) }}" required>
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-semibold text-dark">Contact Name</label>
                                                <input type="text"
                                                    class="form-control @error('contact_name') is-invalid @enderror"
                                                    name="contact_name"
                                                    value="{{ old('contact_name', $cur_user->contact_name) }}" required>
                                                @error('contact_name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-semibold text-dark">Contact Number</label>
                                                <input type="text"
                                                    class="form-control @error('contact_number') is-invalid @enderror"
                                                    name="contact_number"
                                                    value="{{ old('contact_number', $cur_user->contact_number) }}" required>
                                                @error('contact_number')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                            </form>
                        </div>

                        <!-- Separator Line -->
                        <hr class="my-4">

                        <!-- Security Section -->
                        <div class="border rounded p-4">
                            <h5 class="fw-semibold text-dark mb-3">Security</h5>

                            <div class="row">
                                <!-- Email Update -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-dark">Email Address</label>
                                    <form action="{{ route('client.profile.update-email') }}" method="POST"
                                        class="d-flex gap-2">
                                        @csrf
                                        @method('PUT')
                                        <input type="email"
                                            class="form-control form-control-sm @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email', $cur_user->email) }}" required>
                                        <button type="submit" class="btn btn-outline-primary btn-sm">Save Email</button>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </form>
                                </div>

                                <!-- Vertical Separator -->
                                <div class="col-md-1 d-flex justify-content-center">
                                    <div class="border-end h-100"></div>
                                </div>

                                <!-- Password Update -->
                                <div class="col-md-5">
                                    <label class="form-label fw-semibold text-dark">Password</label>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="text-muted">**********</span>
                                        <button type="button" class="btn btn-outline-secondary btn-sm"
                                            data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                            Change Password
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('client.headquarters.profile.change-pass')

@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if($errors->has('current_password') || $errors->has('new_password') || $errors->has('new_password_confirmation'))
                var passwordModal = new bootstrap.Modal(document.getElementById('changePasswordModal'));
                passwordModal.show();
            @endif
                });
    </script>
@endpush