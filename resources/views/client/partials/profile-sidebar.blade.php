<div class="col-lg-3 col-md-4 mb-4">
    <div class="bg-light rounded p-3 shadow">
        <!-- Active Page - User Profile -->
        <div class="mb-3">
            <a href="{{ route("client.profile") }}" class="btn btn-warning w-100 text-start fw-semibold">
                User Profile
            </a>
        </div>

        <!-- Other Profile Pages -->
        <div class="mb-3">
            <a href="#" class="btn btn-outline-secondary w-100 text-start">
                Products & Retailers - Coming Soon
            </a>
        </div>

        <div class="mb-3">
            <a href="#" class="btn btn-outline-secondary w-100 text-start">
                Withdrawal - Coming Soon
            </a>
        </div>

        <hr class="my-3">

        <!-- Sign Out -->
        <div>
            <a href="{{ route('logout') }}" class="btn btn-outline-danger w-100 text-start" onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt me-2"></i>Sign Out
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>

        <!-- Wepeka Logo -->
        <div class="text-center mt-4">

        </div>
    </div>
</div>