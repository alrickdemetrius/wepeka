@extends('layouts.app')

{{-- Style ini saya ambil dari admin/dashboard.blade.php Anda agar konsisten --}}
@section('content')
<style>
    body {
        background: linear-gradi ent(135deg, #f0f4ff, #dfe9f3);
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
    .custom-btn-add {
        background: #ffc107;
        color: #000;
    }
    .custom-btn-add:hover {
        background: #e0a800;
        color: #000;
    }
    .logo-thumb {
        width: 100px; /* Dibuat lebih besar dari logo user */
        height: 75px;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="container py-5">
    <div class="glass-card p-4">

        {{-- Flash Message untuk Success --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
            <h2 class="fw-bold mb-3 mb-md-0">📋 Portfolio Management</h2>
            <a href="{{ route('admin.portfolios.create') }}" class="btn custom-btn custom-btn-add">
                + Add New Portfolio
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle custom-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Project Name</th>
                        <th>Category</th>
                        <th>Featured?</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($portfolios as $portfolio)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if ($portfolio->image)
                                    <img src="{{ asset('storage/' . $portfolio->image) }}" alt="Portfolio Image" class="logo-thumb">
                                @else
                                    <span class="text-muted small">No image</span>
                                @endif
                            </td>
                            <td>{{ $portfolio->project_name }}</td>
                            <td>{{ $portfolio->category }}</td>
                            <td>
                                @if($portfolio->is_featured)
                                    <span class="badge bg-success">Yes</span>
                                @else
                                    <span class="badge bg-secondary">No</span>
                                @endif
                            </td>
                            <td>{{ $portfolio->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="d-flex flex-wrap gap-1">
                                    <a href="{{ route('admin.portfolios.edit', $portfolio->id) }}" class="btn btn-sm btn-warning">
                                        ✏️ Edit
                                    </a>

                                    <form action="{{ route('admin.portfolios.destroy', $portfolio->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">🗑 Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">No portfolios found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection