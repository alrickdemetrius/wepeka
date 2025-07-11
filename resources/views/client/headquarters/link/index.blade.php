@extends("client.layouts.app")

@section('content')
    <div class="min-vh-100 py-4"
        style="background: url('{{ asset('images/background4_brown.jpg') }}') no-repeat center center fixed; background-size: cover;">
        <div class="container">
            <div class="row">

                <!-- Main Content -->
                <div class="col-lg-9 col-md-8">
                    <div class="bg-white rounded p-4 shadow">
                        <!-- Page Header -->
                        <div class="mb-4">
                            <h3 class="fw-bold text-dark mb-1">{{ $cur_user->name ?? 'User Name' }}</h3>
                            <p class="text-muted mb-0">
                                Manage your <span class="text-warning fw-semibold">We</span><span
                                    class="fw-semibold">peka</span> Links!
                            </p>
                        </div>

                        <!-- Main Card -->
                        <div class="bg-light rounded p-4 shadow-sm">
                            <div class="row">
                                <!-- Left Section - Form -->
                                <div class="col-md-7">
                                    <!-- Event Name Input -->
                                    <div class="mb-4">
                                        <label class="form-label fw-semibold text-dark mb-2">Event Name</label>
                                        <input type="text" class="form-control form-control-lg" name="event_name"
                                            placeholder="Enter event name" value="">
                                    </div>

                                    <!-- File Type Selection -->
                                    <div class="mb-4">
                                        <label class="form-label fw-semibold text-dark mb-3">File Type</label>
                                        <div class="d-flex gap-3 mb-3">
                                            <button type="button"
                                                class="btn btn-warning px-4 py-2 fw-semibold file-type-btn active"
                                                data-type="link">
                                                Link
                                            </button>
                                            <button type="button"
                                                class="btn btn-outline-secondary px-4 py-2 fw-semibold file-type-btn"
                                                data-type="pdf">
                                                Pdf
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Upload Section -->
                                    <div class="mb-4">
                                        <label class="form-label fw-semibold text-dark mb-2">Upload File</label>
                                        <div class="upload-area border rounded p-4 text-center bg-white"
                                            style="min-height: 120px; border: 2px dashed #dee2e6; cursor: pointer;">
                                            <div class="upload-placeholder text-muted">
                                                <i class="fas fa-cloud-upload-alt fa-2x mb-2"></i>
                                                <div class="fw-semibold">Choose file type first</div>
                                            </div>
                                            <input type="file" class="d-none" id="fileInput" accept=".pdf">
                                            <input type="url" class="form-control d-none" id="linkInput"
                                                placeholder="Enter your link here">
                                        </div>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="d-flex gap-3">
                                        <button type="button" class="btn btn-secondary px-4 py-2 fw-semibold">
                                            Back
                                        </button>
                                        <button type="button" class="btn btn-dark px-4 py-2 fw-semibold">
                                            Save Changes
                                        </button>
                                    </div>
                                </div>

                                <!-- Right Section - Logo -->
                                <div class="col-md-5 d-flex align-items-center justify-content-center">
                                    <div class="text-center">
                                        <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mx-auto"
                                            style="width: 200px; height: 200px;">
                                            @if(isset($cur_user->logo) && $cur_user->logo)
                                                <img src="{{ asset('storage/' . $cur_user->logo) }}" alt="Company Logo"
                                                    class="img-fluid rounded-circle"
                                                    style="width: 180px; height: 180px; object-fit: cover;">
                                            @else
                                                <span class="text-white fw-bold" style="font-size: 3rem;">Logo</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
            const uploadArea = document.querySelector('.upload-area');
            const uploadPlaceholder = document.querySelector('.upload-placeholder');
            const fileInput = document.getElementById('fileInput');
            const linkInput = document.getElementById('linkInput');

            fileTypeBtns.forEach(btn => {
                btn.addEventListener('click', function () {
                    fileTypeBtns.forEach(b => {
                        b.classList.remove('active', 'btn-warning');
                        b.classList.add('btn-outline-secondary');
                    });

                    this.classList.remove('btn-outline-secondary');
                    this.classList.add('active', 'btn-warning');

                    const selectedType = this.dataset.type;
                    updateUploadArea(selectedType);
                });
            });

            uploadArea.addEventListener('click', function () {
                const activeType = document.querySelector('.file-type-btn.active').dataset.type;
                if (activeType === 'pdf') {
                    fileInput.click();
                } else if (activeType === 'link') {
                    showLinkInput();
                }
            });

            fileInput.addEventListener('change', function (e) {
                if (e.target.files.length > 0) {
                    const fileName = e.target.files[0].name;
                    uploadPlaceholder.innerHTML = `
                            <i class="fas fa-file-pdf fa-2x mb-2 text-danger"></i>
                            <div class="fw-semibold text-dark">${fileName}</div>
                            <small class="text-muted">Click to change file</small>
                        `;
                }
            });

            function updateUploadArea(type) {
                if (type === 'link') {
                    uploadPlaceholder.innerHTML = `
                            <i class="fas fa-link fa-2x mb-2 text-primary"></i>
                            <div class="fw-semibold">Click to add link</div>
                        `;
                    fileInput.classList.add('d-none');
                    linkInput.classList.add('d-none');
                } else if (type === 'pdf') {
                    uploadPlaceholder.innerHTML = `
                            <i class="fas fa-file-pdf fa-2x mb-2 text-danger"></i>
                            <div class="fw-semibold">Click to upload PDF</div>
                        `;
                    fileInput.classList.add('d-none');
                    linkInput.classList.add('d-none');
                }
            }

            function showLinkInput() {
                uploadPlaceholder.classList.add('d-none');
                linkInput.classList.remove('d-none');
                linkInput.focus();

                linkInput.addEventListener('blur', function () {
                    if (this.value) {
                        uploadPlaceholder.innerHTML = `
                                <i class="fas fa-link fa-2x mb-2 text-primary"></i>
                                <div class="fw-semibold text-dark">${this.value}</div>
                                <small class="text-muted">Click to change link</small>
                            `;
                    } else {
                        uploadPlaceholder.innerHTML = `
                                <i class="fas fa-link fa-2x mb-2 text-primary"></i>
                                <div class="fw-semibold">Click to add link</div>
                            `;
                    }
                    uploadPlaceholder.classList.remove('d-none');
                    linkInput.classList.add('d-none');
                });
            }

            updateUploadArea('link');
        });
    </script>
@endpush