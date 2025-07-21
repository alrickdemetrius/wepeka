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
    }

    .custom-table thead {
        position: sticky;
        top: 0;
        background-color: #343a40;
        color: #fff;
        z-index: 1;
    }

    .custom-table th,
    .custom-table td {
        vertical-align: middle;
        padding: 12px 14px;
    }

    .custom-table tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.03);
    }

    .custom-btn {
        border-radius: 6px;
        font-weight: 500;
        font-size: 0.875rem;
    }

    .custom-btn-add {
        background: #ffc107;
        color: #000;
    }

    .custom-btn-add:hover {
        background: #e0a800;
        color: #000;
    }

    .custom-btn-view {
        background: #198754;
        color: white;
    }

    .custom-btn-view:hover {
        background: #157347;
        color: white;
    }

    .custom-btn-generate {
        border: 1.5px solid #0d6efd;
        color: #0d6efd;
        background: transparent;
    }

    .custom-btn-generate:hover {
        background: #0d6efd;
        color: white;
    }

    .logo-thumb {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    @media (max-width: 768px) {
        .table-responsive {
            overflow-x: auto;
        }
    }
</style>

<div class="container py-5">
    <div class="glass-card p-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
            <h2 class="fw-bold mb-3 mb-md-0">📋 Admin Dashboard</h2>
            <a href="{{ route('admin.users.create') }}" class="btn custom-btn custom-btn-add">
                + Add New Client
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle custom-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Logo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Contact</th>
                        <th>Registered</th>
                        <th>QR</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if ($user->logo)
                                    <img src="{{ asset('storage/' . $user->logo) }}" alt="Logo" class="logo-thumb">
                                @else
                                    <span class="text-muted small">No logo</span>
                                @endif
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td><span class="text-muted font-monospace">••••••••</span></td>
                            <td>
                                <strong>{{ $user->contact_name }}</strong><br>
                                <small class="text-muted">{{ $user->contact_number }}</small>
                            </td>
                            <td>{{ $user->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="d-flex flex-wrap gap-1">
                                    @if($user->qrLink)
                                        <a href="{{ route('admin.qr.show', $user->id) }}" class="btn btn-sm custom-btn custom-btn-view">
                                            View QR
                                        </a>
                                    @else
                                        <a href="{{ route('admin.qr.create', $user->id) }}" class="btn btn-sm custom-btn custom-btn-generate">
                                            Generate QR
                                        </a>
                                    @endif

                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning">
                                        ✏️ Edit
                                    </a>

                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">🗑 Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">No clients found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Legend -->
        <div class="d-block d-md-none mt-4">
            <div class="d-flex align-items-center mb-2">
                <span class="btn btn-sm custom-btn custom-btn-view me-2"><i class="fas fa-qrcode"></i></span>
                <span class="small">= QR Code available</span>
            </div>
            <div class="d-flex align-items-center">
                <span class="btn btn-sm custom-btn custom-btn-generate me-2"><i class="fas fa-plus"></i></span>
                <span class="small">= Generate QR Code</span>
            </div>
        </div>
    </div>
</div>
@endsection
