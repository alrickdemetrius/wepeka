@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 fw-bold">QR Detail - {{ $user->name }}</h1>

    <div class="card shadow-sm">
        <div class="card-body">

            {{-- QR Code --}}
            <div class="text-center mb-4">
                <div style="max-width: 300px; margin: 0 auto;">
                    {!! $user->qrLink->qr_code_svg !!}
                </div>
                <p class="mt-3 text-muted">
                    Scan this QR to access: <br>
                    @if ($user->qrLink->file_type === 'link')
                        <a href="{{ $user->qrLink->file_data }}" target="_blank">{{ $user->qrLink->file_data }}</a>
                    @else
                        <a href="{{ route('file.download', basename($user->qrLink->file_data)) }}" target="_blank">
                            Download PDF
                        </a>
                    @endif
                </p>
            </div>

            {{-- Info Table --}}
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>User Name</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>Event Name</th>
                        <td>{{ $user->qrLink->event_name }}</td>
                    </tr>
                    <tr>
                        <th>File Type</th>
                        <td class="text-uppercase">{{ $user->qrLink->file_type }}</td>
                    </tr>
                    <tr>
                        <th>File Data</th>
                        <td>
                            @if ($user->qrLink->file_type === 'link')
                                <a href="{{ $user->qrLink->file_data }}" target="_blank">{{ $user->qrLink->file_data }}</a>
                            @else
                                {{ $user->qrLink->file_data }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{ $user->qrLink->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Last Updated</th>
                        <td>{{ $user->qrLink->updated_at->format('d M Y H:i') }}</td>
                    </tr>
                </tbody>
            </table>

            <a href="{{ route('admin.clients.index') }}" class="btn btn-secondary">← Back to Clients</a>
        </div>
    </div>
</div>
@endsection
