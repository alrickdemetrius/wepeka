@extends("client.layouts.app")

@section('content')
    <div class="min-vh-100 py-4"
        style="background: url('{{ asset('images/background4_brown.jpg') }}') no-repeat center center fixed; background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-8">
                    <div class="bg-white rounded p-4 shadow">
                        <div class="mb-4">
                            <h3 class="fw-bold text-dark mb-1">{{ $cur_user->name ?? 'User Name' }}</h3>
                            <p class="text-muted mb-0">Manage your <span class="text-warning fw-semibold">We</span><span
                                    class="fw-semibold">peka</span> Links!</p>
                        </div>

                        <form action="{{ route('client.link.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="file_type" id="fileTypeInput" value="link">

                            <div class="mb-4">
                                <label class="form-label fw-semibold text-dark mb-2">Event Name</label>
                                <input type="text" class="form-control form-control-lg" name="event_name"
                                    placeholder="Enter event name" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold text-dark mb-3">File Type</label>
                                <div class="d-flex gap-3 mb-3">
                                    <button type="button"
                                        class="btn btn-outline-secondary px-4 py-2 fw-semibold file-type-btn"
                                        data-type="link">Link</button>

                                    <button type="button"
                                        class="btn btn-outline-secondary px-4 py-2 fw-semibold file-type-btn"
                                        data-type="pdf">PDF</button>
                                </div>
                            </div>

                            <div class="mb-4" id="linkWrapper">
                                <label class="form-label fw-semibold text-dark mb-2">Link</label>
                                <input type="url" class="form-control form-control-lg" id="linkInput" name="file_data"
                                    placeholder="Enter your link here">
                            </div>

                            <div class="mb-4 d-none" id="pdfWrapper">
                                <label class="form-label fw-semibold text-dark mb-2">Upload PDF</label>
                                <small class="text-muted d-block mb-2">Only PDF files allowed. Max size: 2MB</small>
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
                                <a href="{{ route('client.headquarters') }}"
                                    class="btn btn-secondary px-4 py-2 fw-semibold">Back</a>
                                <button type="submit" class="btn btn-dark px-4 py-2 fw-semibold">Save Changes</button>
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
    </style>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const fileTypeBtns = document.querySelectorAll('.file-type-btn');
            const fileTypeInput = document.getElementById('fileTypeInput');
            const linkWrapper = document.getElementById('linkWrapper');
            const pdfWrapper = document.getElementById('pdfWrapper');
            const fileInput = document.getElementById('fileInput');
            const uploadPlaceholder = document.getElementById('uploadPlaceholder');
            const uploadArea = document.querySelector('.upload-area');
            const form = document.querySelector('form');

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

            // Click upload area to open file dialog
            uploadArea.addEventListener('click', () => {
                const type = fileTypeInput.value;
                if (type === 'pdf') {
                    fileInput.click();
                }
            });

            fileInput.addEventListener('change', function (e) {
                handleFileUpload(e.target.files[0]);
            });

            function handleFileUpload(file) {
                if (!file) return;

                const maxSize = 2 * 1024 * 1024; // 2MB

                if (file.type !== 'application/pdf') {
                    alert('Only PDF files are allowed.');
                    fileInput.value = ''; // reset input
                    return;
                }

                if (file.size > maxSize) {
                    alert('PDF file size must be 2MB or less.');
                    fileInput.value = '';
                    return;
                }

                // valid file
                uploadPlaceholder.innerHTML = `
                <i class="fas fa-file-pdf fa-2x mb-2 text-danger"></i>
                <div class="fw-semibold text-dark">${file.name}</div>
                <small class="text-muted">Click to change file</small>
            `;
            }

            // Drag & Drop events
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

            // Form validation
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                const type = fileTypeInput.value;
                const formData = new FormData(form);

                if (type === 'link') {
                    const link = document.getElementById('linkInput').value.trim();
                    if (!link) {
                        alert('Please enter a valid link.');
                        return;
                    }
                } else if (type === 'pdf') {
                    if (fileInput.files.length === 0) {
                        alert('Please upload a PDF file.');
                        return;
                    }
                    // Manual append karena browser bisa mengabaikan file input jika diset via JS
                    formData.set('file', fileInput.files[0]);
                }

                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                })
                    .then(response => response.text()) // bisa diganti json kalau responnya json
                    .then(html => {
                        document.open();
                        document.write(html);
                        document.close();
                    })
                    .catch(err => {
                        console.error(err);
                        alert('Upload failed.');
                    });
            });
        });
    </script>
@endpush