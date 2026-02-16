@extends('layouts.app')

@section('content')
<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(12px);
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    .badge-service {
        background-color: #ffc107;
        color: #000;
        margin-right: 4px;
        font-weight: 600;
    }
</style>

<div class="container py-5">
    <div class="glass-card p-4">

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm mb-4">{{ session('success') }}</div>
        @endif

        <h2 class="fw-bold mb-4">📋 Master Data Bookings</h2>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Company & Contact</th>
                        <th>Services</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Actions</th> </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                        <tr>
                            <td>#{{ $booking->id }}</td>
                            <td>{{ $booking->created_at->format('d M Y H:i') }}</td>
                            <td>
                                <strong>{{ $booking->company_name }}</strong><br>
                                <small class="text-muted">{{ $booking->contact_name }} ({{ $booking->phone }})</small><br>
                                <small class="text-primary">{{ $booking->email }}</small>
                            </td>
                            <td>
                                @foreach($booking->jenisLayanans as $layanan)
                                    <span class="badge badge-service">{{ $layanan->nama }}</span>
                                @endforeach
                            </td>
                            <td>
                                <p class="small mb-0 text-truncate" style="max-width: 150px;" title="{{ $booking->message }}">
                                    {{ $booking->message }}
                                </p>
                            </td>
                            <td>
                                {{-- WARNA BADGE DINAMIS --}}
                                @php
                                    $statusColor = [
                                        'pending' => 'bg-warning text-dark',
                                        'proses'  => 'bg-primary',
                                        'selesai' => 'bg-success',
                                        'batal'   => 'bg-danger'
                                    ][$booking->status] ?? 'bg-secondary';
                                @endphp
                                <span class="badge {{ $statusColor }}">
                                    {{ strtoupper($booking->status) }}
                                </span>
                            </td>
                            <td>
                                <form action="{{ route('admin.bookings.updateStatus', $booking->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="form-select form-select-sm" onchange="this.form.submit()" style="width: 110px;">
                                        <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="proses" {{ $booking->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                        <option value="selesai" {{ $booking->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                        <option value="batal" {{ $booking->status == 'batal' ? 'selected' : '' }}>Batal</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">No booking data found.</td> </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection