@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 fw-bold">Admin Dashboard</h1>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-dark text-white fw-semibold d-flex justify-content-between align-items-center flex-wrap">
            <span>Registered Clients</span>
            <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-warning mt-2 mt-md-0">+ Add New Client</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0 align-middle" style="min-width: 650px;">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
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
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="text-muted font-monospace" style="font-size: 0.8rem;">
                                        ••••••••
                                    </span>
                                </td>
                                <td>
                                    <span class="d-block">{{ $user->contact_name }}</span>
                                    <small class="text-muted">{{ $user->contact_number }}</small>
                                </td>
                                <td>{{ $user->created_at->format('d M Y') }}</td>
                                <td class="py-2">
                                    <div class="d-flex flex-column flex-md-row gap-1">
                                        @if($user->qrLink)
                                            <a href="{{ route('admin.qr.show', $user->id) }}"
                                               class="btn btn-success btn-sm flex-grow-1 text-nowrap">
                                               <i class="fas fa-qrcode d-md-none"></i>
                                               <span class="d-none d-md-inline">View QR</span>
                                            </a>
                                        @else
                                            <a href="{{ route('admin.qr.create', $user->id) }}"
                                               class="btn btn-outline-primary btn-sm flex-grow-1 text-nowrap">
                                               <i class="fas fa-plus d-md-none"></i>
                                               <span class="d-none d-md-inline">Generate QR</span>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">No clients found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Button Legend for Mobile -->
            <div class="d-block d-md-none p-3 border-top">
                <div class="d-flex align-items-center mb-2">
                    <span class="btn btn-success btn-sm me-2"><i class="fas fa-qrcode"></i></span>
                    <span class="small">= QR Code sudah dibuat</span>
                </div>
                <div class="d-flex align-items-center">
                    <span class="btn btn-outline-primary btn-sm me-2"><i class="fas fa-plus"></i></span>
                    <span class="small">= Generate QR Code baru</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection