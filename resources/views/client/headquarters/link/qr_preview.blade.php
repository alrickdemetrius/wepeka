@extends('client.layouts.app')

@section('content')
<div class="container py-5 min-vh-100 d-flex align-items-center justify-content-center">
    <div class="text-center bg-white p-5 rounded shadow-lg" style="max-width: 600px; width: 100%;">
        {{-- ✅ Success Alert --}}
        <div class="alert alert-success d-flex align-items-center justify-content-center gap-2" role="alert">
            <i class="fas fa-check-circle text-success fa-lg"></i>
            <div class="fw-semibold">QR Code has been successfully generated!</div>
        </div>

        {{-- ✅ Event Title --}}
        <h3 class="mb-3 text-dark fw-bold">QR Code for: <span class="text-primary">{{ $event_name }}</span></h3>

        {{-- ✅ QR Code --}}
        <div class="my-4 d-flex justify-content-center">
            <div class="p-3 border border-2 rounded" style="background-color: #f8f9fa;">
                {!! $qr !!}
            </div>
        </div>

        {{-- ✅ Link Information --}}
        <p class="text-muted">Scan the QR code above or click the link below:</p>
        <p class="mb-4">
            <a href="{{ $url }}" target="_blank" class="fw-medium text-decoration-none">
                <i class="fas fa-external-link-alt me-1"></i> {{ $url }}
            </a>
        </p>

        {{-- ✅ Back Button --}}
        <a href="{{ route('client.link') }}" class="btn btn-outline-secondary px-4 fw-semibold">
            <i class="fas fa-arrow-left me-1"></i> Back
        </a>
    </div>
</div>
@endsection
