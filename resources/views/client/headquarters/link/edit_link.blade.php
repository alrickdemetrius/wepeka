@extends("client.layouts.app")

@section('content')
    <div class="min-vh-100 py-4"
        style="background: url('{{ asset('images/background4_brown.jpg') }}') no-repeat center center fixed; background-size: cover;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="bg-white rounded p-4 shadow">
                        <div class="mb-4">
                            <h3 class="fw-bold text-dark mb-1">Edit QR Link</h3>
                        </div>

                        <form action="{{ route('client.link.update', $link->id) }}" method="POST"
                            onsubmit="return validateForm();" enctype="multipart/form-data">

                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $err)
                                            <li>{{ $err }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @csrf
                            @method('PUT')
                            <input type="hidden" name="file_type" id="fileTypeInput"
                                value="{{ old('file_type', $link->file_type) }}">
                            @if(old('file_type', $link->file_type) === 'link')
                                <input type="hidden" name="file_data" value="{{ old('file_data', $link->file_data) }}">
                            @endif

                            <div class="mb-4">
                                <label class="form-label fw-semibold text-dark mb-2">Event Name</label>
                                <input type="text" class="form-control form-control-lg" name="event_name"
                                    value="{{ old('event_name', $link->event_name) }}" placeholder="Enter event name"
                                    required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold text-dark mb-3">File Type</label>
                                <div class="d-flex gap-3 mb-3">
                                    <button type="button"
                                        class="btn file-type-btn px-4 py-2 fw-semibold {{ $link->file_type === 'link' ? 'btn-warning active' : 'btn-outline-secondary' }}"
                                        data-type="link">Link</button>

                                    <button type="button"
                                        class="btn file-type-btn px-4 py-2 fw-semibold {{ $link->file_type === 'pdf' ? 'btn-warning active' : 'btn-outline-secondary' }}"
                                        data-type="pdf">PDF</button>
                                </div>
                            </div>

                            <div class="mb-4 {{ $link->file_type === 'link' ? '' : 'd-none' }}" id="linkWrapper">
                                <label class="form-label fw-semibold text-dark mb-2">Link</label>
                                <input type="url" class="form-control form-control-lg" id="linkInput" name="file_data"
                                    value="{{ old('file_data', $link->file_data) }}" placeholder="Enter your link here">
                            </div>

                            <div class="mb-4 {{ $link->file_type === 'pdf' ? '' : 'd-none' }}" id="pdfWrapper">
                                <label class="form-label fw-semibold text-dark mb-2">Upload PDF</label>
                                <small class="text-muted d-block mb-2">Only PDF files allowed. Max size: 2MB</small>
                                @if($link->file_type === 'pdf')
                                    <p>
                                        Current file:
                                        <a href="{{ route('file.download', basename($link->file_data)) }}" target="_blank">
                                            Download PDF
                                        </a>
                                    </p>
                                @endif
                                <div class="upload-area border rounded p-4 text-center bg-white"
                                    style="min-height: 120px; border: 2px dashed #dee2e6; cursor: pointer;">
                                    <div id="uploadPlaceholder" class="upload-placeholder text-muted">
                                        <i class="fas fa-cloud-upload-alt fa-2x mb-2"></i>
                                        <div class="fw-semibold">Drag & drop PDF here or click to browse</div>
                                    </div>
                                    <input type="file" class="d-none" id="fileInput" name="file" accept=".pdf">
                                </div>
                            </div>

                            <div class="d-flex gap-3">
                                <a href="{{ route('client.link.view_link') }}"
                                    class="btn btn-secondary px-4 py-2 fw-semibold">Cancel</a>
                                <button type="submit" class="btn btn-dark px-4 py-2 fw-semibold">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .file-type-btn.active {
            position: relative;
        }

        .upload-area:hover {
            border-color: #007bff !important;
            background-color: #f8f9fa !important;
        }

        .upload-area.drag-over {
            border-color: #007bff !important;
            background-color: #e7f3ff !important;
        }

        .qr-small svg {
            width: 100%;
            height: auto;
        }
    </style>
@endsection

@push('scripts')
    <script>
        function validateForm() {
            const fileType = document.getElementById('fileTypeInput').value;

            if (fileType === 'link') {
                const linkInput = document.getElementById('linkInput').value;
                if (!linkInput.trim()) {
                    alert('Please enter a valid link.');
                    return false;
                }
            } else if (fileType === 'pdf') {
                const fileInput = document.getElementById('fileInput');
                const isReplacing = fileInput.files.length > 0;

                // Kalau user ingin ganti file, harus validasi ukuran dan tipe
                if (isReplacing) {
                    const file = fileInput.files[0];
                    const maxSize = 2 * 1024 * 1024;
                    const isPDF = file.name.toLowerCase().endsWith('.pdf');

                    if (!isPDF) {
                        alert('Only PDF files are allowed.');
                        return false;
                    }

                    if (file.size > maxSize) {
                        alert('PDF file size must be 2MB or less.');
                        return false;
                    }
                }
                // kalau tidak upload baru, tetap lolos validasi
            }

            return true;
        }

        document.addEventListener('DOMContentLoaded', function () {
            const fileTypeBtns = document.querySelectorAll('.file-type-btn');
            const fileTypeInput = document.getElementById('fileTypeInput');
            const linkWrapper = document.getElementById('linkWrapper');
            const pdfWrapper = document.getElementById('pdfWrapper');
            const fileInput = document.getElementById('fileInput');
            const uploadPlaceholder = document.getElementById('uploadPlaceholder');
            const uploadArea = document.querySelector('.upload-area');

            function toggleUploadType(type) {
                if (type === 'link') {
                    linkWrapper.classList.remove('d-none');
                    pdfWrapper.classList.add('d-none');
                } else {
                    linkWrapper.classList.add('d-none');
                    pdfWrapper.classList.remove('d-none');
                }
            }

            toggleUploadType(fileTypeInput.value);

            fileTypeBtns.forEach(btn => {
                btn.addEventListener('click', function () {
                    fileTypeBtns.forEach(b => {
                        b.classList.remove('active', 'btn-warning');
                        b.classList.add('btn-outline-secondary');
                    });

                    this.classList.add('active', 'btn-warning');
                    this.classList.remove('btn-outline-secondary');

                    const selectedType = this.dataset.type;
                    fileTypeInput.value = selectedType;
                    toggleUploadType(selectedType);
                });
            });

            uploadArea.addEventListener('click', () => {
                if (fileTypeInput.value === 'pdf') {
                    fileInput.click();
                }
            });

            fileInput.addEventListener('change', function (e) {
                handleFileUpload(e.target.files[0]);
            });

            function handleFileUpload(file) {
                if (!file) return;

                const maxSize = 2 * 1024 * 1024;
                const isPDF = file.name.toLowerCase().endsWith('.pdf');

                if (!isPDF) {
                    alert('Only PDF files are allowed.');
                    fileInput.value = '';
                    return;
                }

                if (file.size > maxSize) {
                    alert('PDF file size must be 2MB or less.');
                    fileInput.value = '';
                    return;
                }

                uploadPlaceholder.innerHTML = `
                                <i class="fas fa-file-pdf fa-2x mb-2 text-danger"></i>
                                <div class="fw-semibold text-dark">${file.name}</div>
                                <small class="text-muted">Click to change file</small>
                            `;
            }

            ['dragenter', 'dragover'].forEach(event => {
                uploadArea.addEventListener(event, e => {
                    e.preventDefault();
                    uploadArea.classList.add('drag-over');
                });
            });

            ['dragleave', 'drop'].forEach(event => {
                uploadArea.addEventListener(event, e => {
                    e.preventDefault();
                    uploadArea.classList.remove('drag-over');
                });
            });

            uploadArea.addEventListener('drop', function (e) {
                e.preventDefault();
                const file = e.dataTransfer.files[0];
                if (file) {
                    fileInput.files = e.dataTransfer.files;
                    handleFileUpload(file);
                }
            });

            fileTypeBtns.forEach(btn => {
                btn.addEventListener('click', function () {
                    const selectedType = this.dataset.type;

                    if (selectedType === 'pdf') {
                        fileInput.value = '';
                        uploadPlaceholder.innerHTML = `
                                        <i class="fas fa-cloud-upload-alt fa-2x mb-2"></i>
                                        <div class="fw-semibold">Drag & drop PDF here or click to browse</div>
                                    `;
                    }
                });
            });
        });
    </script>

@endpush