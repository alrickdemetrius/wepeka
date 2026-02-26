@extends('layouts.app')

@section('content')
<style>
    .detail-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.08);
    }
    .section-label {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: #aaa;
        margin-bottom: 4px;
    }
    .section-value {
        font-size: 15px;
        color: #1a1a1a;
        font-weight: 500;
    }
    .divider {
        border-top: 1px solid #f0f0f0;
        margin: 20px 0;
    }
    .badge-service {
        background-color: #ffc107;
        color: #000;
        font-weight: 600;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 13px;
        margin-right: 6px;
        margin-bottom: 6px;
        display: inline-block;
    }
    .contact-btn {
        border-radius: 50px;
        font-size: 14px;
        font-weight: 600;
        padding: 8px 20px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .btn-whatsapp {
        background-color: #25D366;
        color: #fff;
        border: none;
    }
    .btn-whatsapp:hover {
        background-color: #1ebe5d;
        color: #fff;
    }
    .btn-email {
        background-color: #f5f5f5;
        color: #333;
        border: 1px solid #ddd;
    }
    .btn-email:hover {
        background-color: #e8e8e8;
        color: #333;
    }
    .status-select {
        border-radius: 50px;
        font-size: 14px;
        font-weight: 600;
        padding: 8px 16px;
        border: 2px solid #dee2e6;
        cursor: pointer;
        appearance: auto;
    }
    .status-select:focus {
        outline: none;
        border-color: #ffc107;
        box-shadow: 0 0 0 3px rgba(255,193,7,0.2);
    }
    .back-link {
        color: #666;
        font-size: 14px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 20px;
    }
    .back-link:hover {
        color: #000;
    }
</style>

<div class="container py-5" style="max-width: 760px;">

    <a href="{{ route('admin.bookings.index') }}" class="back-link">
        <i class="bi bi-arrow-left"></i> Back to Bookings
    </a>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4 rounded-3">{{ session('success') }}</div>
    @endif

    <div class="detail-card p-4 p-md-5">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-3">
            <div>
                <h4 class="fw-bold mb-1">{{ $booking->company_name }}</h4>
                <span class="text-muted" style="font-size: 13px;">Booking #{{ $booking->id }} &middot; {{ $booking->created_at->format('d M Y, H:i') }}</span>
            </div>
            @php
                $statusColor = [
                    'pending' => 'bg-warning text-dark',
                    'proses'  => 'bg-primary',
                    'selesai' => 'bg-success',
                    'batal'   => 'bg-danger'
                ][$booking->status] ?? 'bg-secondary';
            @endphp
            <span class="badge {{ $statusColor }} px-3 py-2" style="font-size: 13px; border-radius: 20px;">
                {{ strtoupper($booking->status) }}
            </span>
        </div>

        <div class="divider"></div>

        {{-- Contact Info --}}
        <div class="row g-4 mb-2">
            <div class="col-sm-6">
                <div class="section-label">Contact Person</div>
                <div class="section-value">{{ $booking->contact_name }}</div>
            </div>
            <div class="col-sm-6">
                <div class="section-label">Phone</div>
                <div class="section-value">{{ $booking->phone }}</div>
            </div>
            <div class="col-sm-6">
                <div class="section-label">Email</div>
                <div class="section-value">{{ $booking->email }}</div>
            </div>
            <div class="col-sm-6">
                <div class="section-label">Submitted At</div>
                <div class="section-value">{{ $booking->created_at->format('d M Y, H:i') }}</div>
            </div>
        </div>

        <div class="divider"></div>

        {{-- Services --}}
        <div class="mb-4">
            <div class="section-label mb-2">Services Requested</div>
            @forelse($booking->jenisLayanans as $layanan)
                <span class="badge-service">{{ $layanan->nama }}</span>
            @empty
                <span class="text-muted">No services selected.</span>
            @endforelse
        </div>

        <div class="divider"></div>

        {{-- Message --}}
        <div class="mb-4">
            <div class="section-label mb-2">Message</div>
            <p class="section-value" style="line-height: 1.7; white-space: pre-wrap;">{{ $booking->message }}</p>
        </div>

        <div class="divider"></div>

        {{-- Contact Buttons --}}
        <div class="mb-4">
            <div class="section-label mb-3">Quick Contact</div>
            <div class="d-flex flex-wrap gap-2">
                {{-- WhatsApp: bersihkan nomor, pastikan diawali 62 --}}
                @php
                    $phone = preg_replace('/\D/', '', $booking->phone);
                    if (str_starts_with($phone, '0')) {
                        $phone = '62' . substr($phone, 1);
                    }
                    $waMessage = urlencode('Halo ' . $booking->contact_name . ', kami dari Wepeka Apparel ingin menindaklanjuti booking dari ' . $booking->company_name . '.');
                @endphp
                <a href="https://wa.me/{{ $phone }}?text={{ $waMessage }}"
                   target="_blank"
                   class="contact-btn btn-whatsapp">
                    <i class="bi bi-whatsapp"></i> Chat WhatsApp
                </a>

                {{-- Email: mailto dengan subject & body pre-filled --}}
                @php
                    $subject = urlencode('Follow Up Booking #' . $booking->id . ' - ' . $booking->company_name);
                    $body = urlencode("Halo " . $booking->contact_name . ",\n\nTerima kasih telah menghubungi Wepeka Apparel.\nKami ingin menindaklanjuti booking Anda.\n\nSalam,\nTim Wepeka Apparel");
                @endphp
                <a href="mailto:{{ $booking->email }}?subject={{ $subject }}&body={{ $body }}"
                   class="contact-btn btn-email">
                    <i class="bi bi-envelope"></i> Send Email
                </a>
            </div>
        </div>

        <div class="divider"></div>

        {{-- Update Status --}}
        <div>
            <div class="section-label mb-3">Update Status</div>
            <form action="{{ route('admin.bookings.updateStatus', $booking->id) }}" method="POST" class="d-flex align-items-center gap-3 flex-wrap">
                @csrf
                @method('PATCH')
                <select name="status" class="status-select">
                    <option value="pending"  {{ $booking->status == 'pending'  ? 'selected' : '' }}>⏳ Pending</option>
                    <option value="proses"   {{ $booking->status == 'proses'   ? 'selected' : '' }}>🔄 Proses</option>
                    <option value="selesai"  {{ $booking->status == 'selesai'  ? 'selected' : '' }}>✅ Selesai</option>
                    <option value="batal"    {{ $booking->status == 'batal'    ? 'selected' : '' }}>❌ Batal</option>
                </select>
                <button type="submit" class="btn btn-dark rounded-pill px-4" style="font-size: 14px; font-weight: 600;">
                    Save Status
                </button>
            </form>
        </div>

    </div>
</div>
@endsection