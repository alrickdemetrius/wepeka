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
    .custom-btn-add {
        background: #ffc107;
        color: #000;
        font-weight: 600;
    }
    .custom-btn-add:hover {
        background: #e0a800;
        color: #000;
    }
    .logo-thumb {
        width: 100px;
        height: 75px;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        border: 1px solid #ddd;
    }
    .badge-featured {
        font-size: 0.75rem;
        padding: 5px 10px;
        border-radius: 50px;
    }
</style>

<div class="container py-5">
    <div class="glass-card p-4">

        {{-- Flash Message --}}
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
            <div>
                <h2 class="fw-bold mb-1">📋 Portfolio Management</h2>
                <p class="text-muted mb-0">Manage project showcases for Wepeka brands.</p>
            </div>
            <a href="{{ route('admin.portfolios.create') }}" class="btn custom-btn custom-btn-add px-4 rounded-pill">
                <i class="bi bi-plus-lg"></i> Add New Portfolio
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle custom-table">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="15%">Preview</th>
                        <th width="15%">Brand</th>
                        <th width="20%">Project Title</th>
                        <th width="15%">Category</th>
                        <th width="10%">Featured?</th>
                        <th width="20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($portfolios as $portfolio)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{-- Menampilkan gambar pertama dari relasi images --}}
                                @if($portfolio->images->isNotEmpty())
                                    <div class="position-relative d-inline-block">
                                        <img src="{{ asset('storage/' . $portfolio->images->first()->image_path) }}"
                                             alt="Preview" class="logo-thumb">
                                        @if($portfolio->images->count() > 1)
                                            <span class="position-absolute bottom-0 end-0 badge bg-dark opacity-75 m-1">
                                                +{{ $portfolio->images->count() - 1 }}
                                            </span>
                                        @endif
                                    </div>
                                @else
                                    <div class="logo-thumb d-flex align-items-center justify-content-center bg-light text-muted small">
                                        No Image
                                    </div>
                                @endif
                            </td>
                            <td>
                                <span class="fw-semibold text-primary">
                                    {{ $portfolio->brand->name ?? 'No Brand' }}
                                </span>
                            </td>
                            <td>
                                <div class="fw-bold">{{ $portfolio->title }}</div>
                                <small class="text-muted">Added: {{ $portfolio->created_at->format('d M Y') }}</small>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border">
                                    {{ $portfolio->category->name ?? 'Uncategorized' }}
                                </span>
                            </td>
                            <td>
                                @if($portfolio->is_featured)
                                    <span class="badge bg-success badge-featured">Yes</span>
                                @else
                                    <span class="badge bg-secondary badge-featured">No</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.portfolio.show', $portfolio->id) }}" class="btn btn-sm btn-outline-warning rounded-pill px-3">
                                        🔍 View
                                    </a>
                                    <a href="{{ route('admin.portfolios.edit', $portfolio->id) }}"
                                       class="btn btn-sm btn-outline-warning rounded-pill px-3">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>

                                    <form action="{{ route('admin.portfolios.destroy', $portfolio->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Hapus seluruh project ini beserta semua gambarnya?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <img src="{{ asset('assets/img/empty-data.svg') }}" alt="Empty" style="width: 150px;" class="mb-3 d-block mx-auto">
                                <p class="text-muted">Belum ada portofolio yang terdaftar. <br> Mulailah dengan menambahkan project baru.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection