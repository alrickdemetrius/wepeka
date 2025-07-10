@extends("client.layouts.app")

@section('content')
    <div class="bg-dark min-vh-100 py-4">
        <div class="container">
            <div class="row">
                <!-- Left Sidebar -->
                <div class="col-lg-3 col-md-4 mb-4">
                    <div class="bg-light rounded p-3 shadow">
                        <!-- Active Page - User Profile -->
                        <div class="mb-3">
                            <a href="#" class="btn btn-warning w-100 text-start fw-semibold">
                                User Profile
                            </a>
                        </div>

                        <!-- Other Profile Pages -->
                        <div class="mb-3">
                            <a href="#" class="btn btn-outline-secondary w-100 text-start">
                                Products & Retailers
                            </a>
                        </div>

                        <div class="mb-3">
                            <a href="#" class="btn btn-outline-secondary w-100 text-start">
                                Withdrawal
                            </a>
                        </div>

                        <hr class="my-3">

                        <!-- Sign Out -->
                        <div>
                            <a href="#" class="btn btn-outline-danger w-100 text-start">
                                <i class="fas fa-sign-out-alt me-2"></i>Sign Out
                            </a>
                        </div>

                        <!-- Wepeka Logo -->
                        <div class="text-center mt-4">
                            
                        </div>
                    </div>
                </div>

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

                        <div class="row">
                            <!-- Profile Picture Section -->
                            <div class="col-md-4 mb-4">
                                <div class="border rounded p-3 text-center">
                                    <div class="bg-secondary rounded-circle mx-auto mb-3"
                                        style="width: 120px; height: 120px;"></div>
                                    <h6 class="fw-semibold text-dark">Name</h6>
                                </div>
                            </div>

                            <!-- Username Section -->
                            <div class="col-md-8 mb-4">
                                <div class="border rounded p-3">
                                    <label class="form-label fw-semibold text-dark mb-2">Username</label>
                                    <div class="bg-light rounded p-3 mb-3" style="min-height: 100px;">
                                        <!-- Username content area -->
                                    </div>
                                    <button class="btn btn-secondary px-4">Save Changes</button>
                                </div>
                            </div>
                        </div>

                        <!-- Security Section -->
                        <div class="border rounded p-3">
                            <h6 class="fw-semibold text-dark mb-3">Security</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold text-dark">E-mail</label>
                                    <p class="text-muted small">email.pengguna@gmail.com</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold text-dark">Password</label>
                                    <p class="text-muted small">**********</p>
                                </div>
                            </div>
                            <button class="btn btn-outline-secondary">Change Password</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection