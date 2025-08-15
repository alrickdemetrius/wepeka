@extends('layouts.app')

@section('content')
    <div class="min-vh-100 py-4"
        style="background: url('{{ asset('images/blur_proflink.jpg') }}') no-repeat center center fixed; background-size: cover;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9 col-md-8">

                    {{-- Flash Messages --}}
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="bg-white rounded p-4 shadow">
                        <div class="mb-4">
                            <h3 class="fw-bold text-dark mb-1">{{ $user->name }}</h3>
                            <p class="text-muted mb-0">QR Code Detail for <span
                                    class="text-warning fw-semibold">We</span><span class="fw-semibold">peka</span></p>
                        </div>

                        {{-- QR Code with Template --}}
                        @if ($user->qrLink)
                            <div class="mb-4 text-center">
                                <div class="qr-wrapper">
                                    <div class="qr-scaler">
                                        <div class="qr-preview-container">
                                            <img id="qr-template-img"
                                                src="{{ $user->logo ? asset('images/qrtemplate_logo.png') : asset('images/qrtemplate.png') }}"
                                                alt="QR Template">

                                            {{-- Logo User Overlay (hanya jika punya logo) --}}
                                            @if($user->logo)
                                                <div class="user-logo-overlay">
                                                    <img src="{{ $user->getLogoUrlAttribute() }}" alt="User Logo">
                                                </div>
                                            @endif

                                            @if(isset($user->qrLink->temp_image_file))
                                                <div class="qr-overlay" id="qr-overlay">
                                                    <img src="{!! asset("images/user_qr/$tempImage") !!}">
                                                </div>
                                            @elseif(isset($user->qrLink->qr_code_svg))
                                                <div class="qr-overlay" id="qr-overlay">
                                                    {!! $user->qrLink->qr_code_svg !!}
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <button id="download-merged" class="btn btn-primary mt-3">⬇️ Download Tag</button>
                                </div>

                                <p class="text-muted mt-2 mb-0">Scan this QR to access:
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
                                                <a href="{{ $user->qrLink->file_data }}"
                                                    target="_blank">{{ $user->qrLink->file_data }}</a>
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

                            <form action="{{ route('admin.qr.destroy', $user->id) }}" method="POST" class="d-inline-block ms-2"
                                onsubmit="return confirm('Are you sure you want to delete this QR Code?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">🗑 Delete QR</button>
                            </form>
                        @else
                            <div class="alert alert-warning">No QR code found for this user.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- CSS Overlay --}}
    <style>
        .qr-wrapper {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .qr-scaler {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }

        .qr-preview-container {
            position: relative;
            width: 100%;
        }

        .qr-preview-container img {
            width: 100%;
            display: block;
        }

        .qr-overlay {
            position: absolute;
            top: 51%;
            left: 23.3%;
            transform: translate(-50%, -50%);
            width: 32.5%;
            height: auto;
        }

        .qr-overlay svg {
            width: 100%;
            height: 100%;
        }

        @media (max-width: 600px) {
            .qr-overlay {
                top: 51%;
                left: 23.3%;
                width: 32.5%;
            }
        }

        .user-logo-overlay {
            position: absolute;
            top: 40%;
            /* di tengah template */
            left: 84.5%;
            transform: translate(-50%, -50%);
            width: 25%;
            /* ukuran logo, bisa disesuaikan */
            height: auto;
            z-index: 10;
        }

        .user-logo-overlay img {
            width: 80%;
            height: 80%;
            object-fit: contain;
        }
    </style>

    {{-- Script for Download --}}
    <script>
        document.getElementById('download-merged')?.addEventListener('click', function () {
            const templateImg = document.getElementById('qr-template-img');
            const qrOverlay = document.getElementById('qr-overlay')?.querySelector('svg');
            const userLogoElement = document.querySelector('.user-logo-overlay img');

            if (!templateImg || !qrOverlay) return;

            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');

            const width = templateImg.naturalWidth;
            const height = templateImg.naturalHeight;
            canvas.width = width;
            canvas.height = height;

            const img = new Image();
            img.crossOrigin = "anonymous";
            img.src = templateImg.src;

            img.onload = function () {
                // 1. Gambar template dasar
                ctx.drawImage(img, 0, 0, width, height);

                // 2. Gambar QR Code di atas template
                const svgData = new XMLSerializer().serializeToString(qrOverlay);
                const svgBlob = new Blob([svgData], { type: 'image/svg+xml;charset=utf-8' });
                const url = URL.createObjectURL(svgBlob);

                const qrImg = new Image();
                qrImg.onload = function () {
                    const qrSizeRatio = 195 / 600;
                    const qrWidth = width * qrSizeRatio;
                    const qrHeight = qrWidth;
                    const qrX = width * 0.233;
                    const qrY = height * 0.51;

                    ctx.drawImage(qrImg, qrX - qrWidth / 2, qrY - qrHeight / 2, qrWidth, qrHeight);

                    // 3. Jika ada logo user, gambar di posisinya
                    if (userLogoElement) {
                        const userLogoImg = new Image();
                        userLogoImg.crossOrigin = "anonymous";
                        userLogoImg.src = userLogoElement.src;
                        userLogoImg.onload = function () {

                            // Sesuai .user-logo-overlay (25% dari template, tapi img di dalamnya 80%)
                            const logoWidth = width * 0.25 * 0.8;
                            const logoHeight = logoWidth;

                            // Posisi sesuai CSS top: 40%, left: 85% + translate(-50%, -50%)
                            const logoX = width * 0.82;
                            const logoY = height * 0.40;

                            ctx.drawImage(
                                userLogoImg,
                                logoX - logoWidth / 2,
                                logoY - logoHeight / 2,
                                logoWidth,
                                logoHeight
                            );

                            // Simpan hasil final
                            const finalImg = canvas.toDataURL("image/png");
                            const link = document.createElement('a');
                            link.download = 'merged_qr.png';
                            link.href = finalImg;
                            link.click();

                            URL.revokeObjectURL(url);
                        };
                    } else {
                        // Simpan hasil final tanpa logo user
                        const finalImg = canvas.toDataURL("image/png");
                        const link = document.createElement('a');
                        link.download = 'merged_qr.png';
                        link.href = finalImg;
                        link.click();

                        URL.revokeObjectURL(url);
                    }
                };
                qrImg.src = url;
            };
        });
    </script>
@endsection