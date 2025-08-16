@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h3>Edit QR for {{ $user->name }}</h3>

    <form action="{{ route('admin.qr.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Event Name</label>
            <input type="text" name="event_name" class="form-control" value="{{ $user->qrLink->event_name }}" required>
        </div>

        <div class="mb-3">
            <label>File Type</label>
            <select name="file_type" class="form-select" id="fileType" required>
                <option value="link" {{ $user->qrLink->file_type == 'link' ? 'selected' : '' }}>Link</option>
                <option value="pdf" {{ $user->qrLink->file_type == 'pdf' ? 'selected' : '' }}>PDF</option>
            </select>
        </div>

        <div class="mb-3 {{ $user->qrLink->file_type == 'link' ? '' : 'd-none' }}" id="linkField">
            <label>Link</label>
            <input type="url" name="file_data" class="form-control" value="{{ $user->qrLink->file_type == 'link' ? $user->qrLink->file_data : '' }}">
        </div>

        <div class="mb-3 {{ $user->qrLink->file_type == 'pdf' ? '' : 'd-none' }}" id="pdfField">
            <label>Upload PDF</label>
            <input type="file" name="file" class="form-control" accept="application/pdf">
            @if($user->qrLink->file_type == 'pdf')
                <p class="mt-2">Current PDF: {{ basename($user->qrLink->file_data) }}</p>
            @endif
        </div>

        <button class="btn btn-success">Update QR</button>
        <a href="{{ route('admin.qr.show', $user->id) }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script>
    const select = document.getElementById('fileType');
    const linkField = document.getElementById('linkField');
    const pdfField = document.getElementById('pdfField');

    function toggleFields() {
        const value = select.value;
        if (value === 'link') {
            linkField.classList.remove('d-none');
            pdfField.classList.add('d-none');
        } else {
            linkField.classList.add('d-none');
            pdfField.classList.remove('d-none');
        }
    }

    select.addEventListener('change', toggleFields);
    toggleFields();
</script>
@endsection
