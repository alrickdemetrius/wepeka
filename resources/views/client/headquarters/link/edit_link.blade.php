@extends('layouts.app')

@section('content')
    {{-- Background Container --}}
    <div class="min-vh-100 py-4"
        style="background: url('{{ asset('images/blur_proflink.jpg') }}') no-repeat center center fixed; background-size: cover;">

        <div class="container py-5">
            <h3 class="mb-4 text-white">Edit QR Link</h3>

            {{-- Flash messages --}}
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            {{-- Validation errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card shadow rounded">
                <div class="card-body">
                    <form action="{{ route('client.link.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Event Name --}}
                        <div class="mb-3">
                            <label for="event_name" class="form-label">Event Name</label>
                            <input type="text" name="event_name" id="event_name" class="form-control"
                                value="{{ old('event_name', $link->event_name) }}" required>
                        </div>

                        {{-- File Type - Changed to Segmented Switch with Custom Color --}}
                        <div class="mb-3">
                            <label class="form-label">File Type</label>
                            <div class="btn-group w-100" role="group" aria-label="File Type Selection">
                                <input type="radio" class="btn-check" name="file_type" id="file_type_link" value="link" autocomplete="off"
                                    {{ old('file_type', $link->file_type) === 'link' ? 'checked' : '' }}>
                                <label class="btn btn-outline-custom-warning" for="file_type_link">Link</label> {{-- Kustom kelas di sini --}}

                                <input type="radio" class="btn-check" name="file_type" id="file_type_pdf" value="pdf" autocomplete="off"
                                    {{ old('file_type', $link->file_type) === 'pdf' ? 'checked' : '' }}>
                                <label class="btn btn-outline-custom-warning" for="file_type_pdf">PDF</label> {{-- Kustom kelas di sini --}}
                            </div>
                        </div>

                        {{-- If link --}}
                        <div class="mb-3 file-type-link"
                            style="{{ old('file_type', $link->file_type) === 'link' ? '' : 'display:none;' }}">
                            <label for="external_link" class="form-label">External Link (URL)</label>
                            <input type="url" name="file_data" id="external_link" class="form-control"
                                value="{{ old('file_type', $link->file_type) === 'link' ? old('file_data', $link->file_data) : '' }}"
                                placeholder="https://example.com"
                                {{ old('file_type', $link->file_type) === 'link' ? 'required' : '' }}>
                        </div>

                        {{-- If PDF --}}
                        <div class="mb-3 file-type-pdf"
                            style="{{ old('file_type', $link->file_type) === 'pdf' ? '' : 'display:none;' }}">
                            <label for="upload_pdf" class="form-label">Upload PDF</label>
                            <input type="file" name="file" id="upload_pdf" class="form-control" accept="application/pdf">
                            <div class="form-text">Leave blank to keep the current PDF.</div>

                            @if($link->file_type === 'pdf' && $link->file_data)
                                <p class="mt-2">
                                    Current PDF:
                                    <a href="{{ asset('storage/' . $link->file_data) }}" target="_blank">
                                        View PDF
                                    </a>
                                </p>
                                <div class="form-check mt-2">
                                    <input type="checkbox" name="remove_pdf_flag" value="1"
                                        id="remove_pdf" class="form-check-input">
                                    <label for="remove_pdf" class="form-check-label">Remove Current PDF</label>
                                </div>
                            @endif
                        </div>

                        <div class="d-flex gap-3 mt-4">
                            <a href="{{ route('client.link.view_link') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary">Update QR Link</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom styles for the segmented button group */
        .btn-outline-custom-warning {
            --bs-btn-color: #ffc107; /* Warna teks default */
            --bs-btn-border-color: #ffc107; /* Warna border default */
            --bs-btn-hover-color: #000; /* Warna teks saat hover */
            --bs-btn-hover-bg: #ffc107; /* Warna background saat hover */
            --bs-btn-hover-border-color: #ffc107; /* Warna border saat hover */
            --bs-btn-focus-shadow-rgb: 255,193,7; /* RGB dari #ffc107 untuk shadow fokus */
            --bs-btn-active-color: #000; /* Warna teks saat aktif */
            --bs-btn-active-bg: #ffc107; /* Warna background saat aktif */
            --bs-btn-active-border-color: #ffc107; /* Warna border saat aktif */
            --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
            --bs-btn-disabled-color: #ffc107;
            --bs-btn-disabled-bg: transparent;
            --bs-btn-disabled-border-color: #ffc107;
            --bs-gradient: none;
        }

        /* Mengatasi warna teks saat radio button aktif (dicentang) */
        .btn-check:checked + .btn-outline-custom-warning {
            color: #000; /* Warna teks hitam saat tombol aktif */
            background-color: #ffc107; /* Warna latar belakang kuning saat tombol aktif */
            border-color: #ffc107; /* Warna border kuning saat tombol aktif */
        }
    </style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fileTypeRadios = document.querySelectorAll('input[name="file_type"]'); // Ambil kedua radio button
        const linkFields = document.querySelector('.file-type-link');
        const pdfFields = document.querySelector('.file-type-pdf');
        const externalLinkInput = document.getElementById('external_link');
        const uploadPdfInput = document.getElementById('upload_pdf');

        function toggleFields() {
            let selectedFileType = '';
            // Temukan radio button yang saat ini dicentang
            fileTypeRadios.forEach(radio => {
                if (radio.checked) {
                    selectedFileType = radio.value;
                }
            });

            if (selectedFileType === 'link') {
                linkFields.style.display = '';
                pdfFields.style.display = 'none';
                externalLinkInput.setAttribute('required', 'required');
                uploadPdfInput.removeAttribute('required');
            } else if (selectedFileType === 'pdf') {
                linkFields.style.display = 'none';
                pdfFields.style.display = '';
                externalLinkInput.removeAttribute('required');
                // uploadPdfInput.setAttribute('required', 'required');
            }
        }

        // Panggil fungsi toggleFields saat halaman pertama kali dimuat
        toggleFields();

        // Tambahkan event listener untuk setiap radio button
        fileTypeRadios.forEach(radio => {
            radio.addEventListener('change', toggleFields);
        });
    });
</script>
@endsection