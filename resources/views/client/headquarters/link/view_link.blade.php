@extends("client.layouts.app")

@section('content')
    <div class="min-vh-100 py-4"
        style="background: url('{{ asset('images/background4_brown.jpg') }}') no-repeat center center fixed; background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-8">

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="bg-white rounded p-4 shadow">
                        <div class="mb-4">
                            <h3 class="fw-bold text-dark mb-1">{{ auth()->user()->name }}</h3>
                            <p class="text-muted mb-0">Manage your <span class="text-warning fw-semibold">We</span><span
                                    class="fw-semibold">peka</span> QR Code</p>
                        </div>

                        @if ($link)
                            <div class="mb-4 text-center">
                                <div class="qr-preview-container position-relative">
                                    <!-- Template Gambar -->
                                    <img id="qr-template-img" src="{{ asset('images/qrtemplate.png') }}" class="img-fluid" alt="QR Template">


                                    <!-- Tempelkan QR Code -->
                                    <div class="qr-overlay" id="qr-overlay">
                                        {!! $qrCodeSvg !!}
                                    </div>
                                </div>
                                <div class="mt-3">
                                    {{-- <a href="{{ route('client.link.download_qr') }}" class="btn btn-outline-primary fw-semibold">
                                        Download QR Code
                                    </a> --}}
                                    <button id="download-merged" class="btn btn-primary mt-3">
                                        Download Tag
                                    </button>
                                </div>

                                <div class="mt-3">
                                    @if ($qrData)
                                        <div class="text-center mt-4">
                                            <p><strong>Dynamic QR Link:</strong></p>
                                            <a href="{{ $qrData }}" target="_blank">{{ $qrData }}</a>

                                        </div>
                                    @endif
                                </div>

                                <p class="text-muted mt-2 mb-0">Scan this QR to access:
                                    @if ($link->file_type === 'link')

                                    @else
                                        <a href="{{ route('file.download', basename($link->file_data)) }}" target="_blank">
                                            Download PDF
                                        </a>
                                    @endif
                                </p>
                            </div>

                            <form action="{{ route('client.link.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="d-flex gap-3">
                                    <a href="{{ route('client.headquarters') }}"
                                        class="btn btn-secondary px-4 py-2 fw-semibold">Back</a>
                                </div>

                                <div class="d-flex gap-3 justify-content-center mt-4">
                                    <a href="{{ route('client.link.edit_link') }}" class="btn btn-dark fw-semibold px-4 py-2">
                                        Edit QR
                                    </a>
                                </div>
                            </form>
                        @else
                            <div class="alert alert-warning">No QR code found for this user.</div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ⬇️ Gabungkan semua CSS di sini --}}
    <style>
        .qr-small svg {
            width: 100%;
            max-width: 300px;
            height: auto;
        }

        .qr-preview-container {
            position: relative;
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }

        .qr-preview-container img {
            width: 100%;
            display: block;
        }

        .qr-overlay {
            position: absolute;
            top: 51%; /* sesuaikan sesuai slot QR */
            left: 23.3%;
            transform: translate(-50%, -50%);
            width: 195px;
            height: 195px;
        }

        .qr-overlay svg {
            width: 100%;
            height: 100%;
        }
    </style>

<script>
    document.getElementById('download-merged').addEventListener('click', function () {
        const templateImg = document.getElementById('qr-template-img');
        const qrOverlay = document.getElementById('qr-overlay').querySelector('svg');

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
            ctx.drawImage(img, 0, 0, width, height);

            // Konversi SVG ke image
            const svgData = new XMLSerializer().serializeToString(qrOverlay);
            const svgBlob = new Blob([svgData], { type: 'image/svg+xml;charset=utf-8' });
            const url = URL.createObjectURL(svgBlob);

            const qrImg = new Image();
            qrImg.onload = function () {
                // Posisi dan ukuran QR relatif terhadap ukuran asli gambar template
                const qrSizeRatio = 195 / 600; // karena CSS template width = 600px
                const qrWidth = width * qrSizeRatio;
                const qrHeight = qrWidth;

                const qrX = width * 0.233;
                const qrY = height * 0.51;

                ctx.drawImage(qrImg, qrX - qrWidth / 2, qrY - qrHeight / 2, qrWidth, qrHeight);

                const finalImg = canvas.toDataURL("image/png");
                const link = document.createElement('a');
                link.download = 'merged_qr.png';
                link.href = finalImg;
                link.click();
                URL.revokeObjectURL(url);
            };
            qrImg.src = url;
        };
    });
</script>

@endsection
