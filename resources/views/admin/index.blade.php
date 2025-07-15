@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 fw-bold">Admin Dashboard</h1>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-dark text-white fw-semibold">
            Registered Clients
            <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-warning float-end">+ Add New Client</a>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Contact</th>
                        <th>Registered</th>
                        <th>QR</th> {{-- Tambahan kolom aksi --}}
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->password }}</td>
                            <td>{{ $user->contact_name }} - {{ $user->contact_number }}</td>
                            <td>{{ $user->created_at->format('d M Y') }}</td>
                            <td>
                                @if($user->qrLink)
                                    <a href="{{ route('admin.qr.show', $user->id) }}" class="btn btn-sm btn-success">View</a>
                                @else
                                    <a href="{{ route('admin.qr.create', $user->id) }}" class="btn btn-sm btn-outline-primary">
                                        Generate QR
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No clients found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
