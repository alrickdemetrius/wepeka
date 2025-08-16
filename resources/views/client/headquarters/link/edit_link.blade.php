@extends('layouts.app')

@section('content')
    <div class="min-vh-100 py-4"
        style="background: url('{{ asset('images/blur_proflink.jpg') }}') no-repeat center center fixed; background-size: cover;">
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
                            {{-- Hidden inputs to store the chosen file_type and its data --}}
                            <input type="hidden" name="file_type" id="fileTypeInput" value="{{ old('file_type', $link->file_type) }}">
                            <input type="hidden" name="file_data" id="hiddenFileData" value="{{ old('file_data', $link->file_type === 'link' ? $link->file_data : '') }}">

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
                                <input type="url" class="form-control form-control-lg" id="linkInput" name="file_data_visible"
                                    value="{{ old('file_data', $link->file_type === 'link' ? $link->file_data : '') }}" placeholder="Enter your link here">
                            </div>

                            <div class="mb-4 {{ $link->file_type === 'pdf' ? '' : 'd-none' }}" id="pdfWrapper">
                                <label class="form-label fw-semibold text-dark mb-2">Upload PDF</label>
                                <small class="text-muted d-block mb-2">Only PDF files allowed. Max size: 2MB</small>
                                @if($link->file_type === 'pdf' && $link->file_data)
                                    <p id="currentPdfDisplay" class="mb-2">
                                        Current file:
                                        <a href="{{ route('file.download', basename($link->file_data)) }}" target="_blank">
                                            Download PDF ({{ basename($link->file_data) }})
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger ms-2" id="removePdfBtn">Remove Current PDF</button>
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
        document.addEventListener('DOMContentLoaded', function () {
            const fileTypeBtns = document.querySelectorAll('.file-type-btn');
            const fileTypeInput = document.getElementById('fileTypeInput');
            const hiddenFileData = document.getElementById('hiddenFileData');
            const linkWrapper = document.getElementById('linkWrapper');
            const linkInput = document.getElementById('linkInput');
            const pdfWrapper = document.getElementById('pdfWrapper');
            const fileInput = document.getElementById('fileInput');
            const uploadPlaceholder = document.getElementById('uploadPlaceholder');
            const uploadArea = document.querySelector('.upload-area');
            const currentPdfDisplay = document.getElementById('currentPdfDisplay');
            const removePdfBtn = document.getElementById('removePdfBtn');

            function updateFormDisplay(selectedType) {
                fileTypeInput.value = selectedType;

                fileTypeBtns.forEach(btn => {
                    if (btn.dataset.type === selectedType) {
                        btn.classList.remove('btn-outline-secondary');
                        btn.classList.add('btn-warning', 'active');
                    } else {
                        btn.classList.remove('btn-warning', 'active');
                        btn.classList.add('btn-outline-secondary');
                    }
                });

                if (selectedType === 'link') {
                    linkWrapper.classList.remove('d-none');
                    pdfWrapper.classList.add('d-none');
                    linkInput.name = 'file_data';
                    fileInput.name = 'file_unused';
                    fileInput.value = '';
                    updateUploadPlaceholder();
                    if (currentPdfDisplay) currentPdfDisplay.classList.add('d-none');
                    linkInput.value = hiddenFileData.value;
                } else {
                    linkWrapper.classList.add('d-none');
                    pdfWrapper.classList.remove('d-none');
                    linkInput.name = 'link_data_unused';
                    fileInput.name = 'file';
                    linkInput.value = '';
                    if ("{{ $link->file_type }}" === 'pdf' && "{{ $link->file_data }}" !== '') {
                        if (currentPdfDisplay) currentPdfDisplay.classList.remove('d-none');
                        if (fileInput.files.length > 0) {
                            updateUploadPlaceholder(fileInput.files[0]);
                        } else {
                            updateUploadPlaceholder();
                        }
                    } else {
                        if (currentPdfDisplay) currentPdfDisplay.classList.add('d-none');
                        updateUploadPlaceholder();
                    }
                }
            }

            function updateUploadPlaceholder(file = null) {
                if (file) {
                    uploadPlaceholder.innerHTML = `<i class="fas fa-file-pdf fa-2x mb-2 text-danger"></i> <div class="fw-semibold text-dark">${file.name}</div> <small class="text-muted">Click to change file</small>`;
                } else {
                    uploadPlaceholder.innerHTML = `<i class="fas fa-cloud-upload-alt fa-2x mb-2"></i> <div class="fw-semibold">Drag & drop PDF here or click to browse</div>`;
                }
            }

            fileTypeBtns.forEach(btn => {
                btn.addEventListener('click', function () {
                    const selectedType = this.dataset.type;
                    if (fileTypeInput.value === 'link') {
                        hiddenFileData.value = linkInput.value;
                    } else {
                        hiddenFileData.value = "{{ $link->file_type === 'pdf' && $link->file_data ? $link->file_data : '' }}";
                    }
                    updateFormDisplay(selectedType);
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
                if (!file) {
                    if (fileTypeInput.value === 'pdf' && hiddenFileData.value) {
                        if (currentPdfDisplay) currentPdfDisplay.classList.remove('d-none');
                        updateUploadPlaceholder();
                    } else {
                        updateUploadPlaceholder();
                    }
                    return;
                }

                const maxSize = 2 * 1024 * 1024;
                const isPDF = file.name.toLowerCase().endsWith('.pdf');

                if (!isPDF) {
                    alert('Only PDF files are allowed.');
                    fileInput.value = '';
                    handleFileUpload(null);
                    return;
                }

                if (file.size > maxSize) {
                    alert('PDF file size must be 2MB or less.');
                    fileInput.value = '';
                    handleFileUpload(null);
                    return;
                }

                updateUploadPlaceholder(file);
                hiddenFileData.value = '';
                if (currentPdfDisplay) currentPdfDisplay.classList.add('d-none');
            }

            ['dragenter', 'dragover'].forEach(event => {
                uploadArea.addEventListener(event, e => {
                    e.preventDefault();
                    if (fileTypeInput.value === 'pdf') {
                        uploadArea.classList.add('drag-over');
                    }
                });
            });

            ['dragleave', 'drop'].forEach(event => {
                e.preventDefault();
                uploadArea.classList.remove('drag-over');
            });

            uploadArea.addEventListener('drop', function (e) {
                e.preventDefault();
                const file = e.dataTransfer.files[0];
                if (file && fileTypeInput.value === 'pdf') {
                    fileInput.files = e.dataTransfer.files;
                    handleFileUpload(file);
                }
            });

            if (removePdfBtn) {
                removePdfBtn.addEventListener('click', function () {
                    if (confirm('Are you sure you want to remove the current PDF?')) {
                        hiddenFileData.value = '';
                        if (currentPdfDisplay) currentPdfDisplay.classList.add('d-none');
                        fileInput.value = '';
                        updateUploadPlaceholder();
                    }
                });
            }

            linkInput.addEventListener('input', function () {
                if (fileTypeInput.value === 'link') {
                    hiddenFileData.value = linkInput.value;
                }
            });

            updateFormDisplay(fileTypeInput.value);
        });
    </script>
@endpush