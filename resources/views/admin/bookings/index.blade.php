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
    .week-card {
        background: #fff;
        border-radius: 20px;
        border: 2px solid #ffc107;
        box-shadow: 0 4px 20px rgba(255, 193, 7, 0.15);
    }
    .week-badge {
        background-color: #ffc107;
        color: #000;
        font-size: 12px;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 20px;
    }
</style>

<div class="container py-5">

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4 rounded-3">{{ session('success') }}</div>
    @endif

    {{-- ===== TABEL MINGGU INI ===== --}}
    <div class="week-card p-4 mb-4">
        <div class="d-flex align-items-center gap-3 mb-3 flex-wrap">
            <h5 class="fw-bold mb-0">📅 Bookings Minggu Ini</h5>
            <span class="week-badge">{{ $startOfWeek->format('d M') }} — {{ $endOfWeek->format('d M Y') }}</span>
            <span class="text-muted" style="font-size: 13px;">{{ $bookingsThisWeek->count() }} booking</span>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background-color: #fff8e1;">
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Company & Contact</th>
                        <th>Services</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookingsThisWeek as $booking)
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
                                <a href="{{ route('admin.bookings.show', $booking->id) }}"
                                   class="btn btn-sm btn-outline-dark rounded-pill px-3">
                                    <i class="bi bi-eye me-1"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="bi bi-calendar-x me-2"></i>Tidak ada booking masuk minggu ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ===== TABEL MASTER ===== --}}
    <div class="glass-card p-4">
        <h5 class="fw-bold mb-4">📋 Master Data Bookings</h5>

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
                        <th>Actions</th>
                    </tr>
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
                                <a href="{{ route('admin.bookings.show', $booking->id) }}"
                                   class="btn btn-sm btn-outline-dark rounded-pill px-3">
                                    <i class="bi bi-eye me-1"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">No booking data found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection