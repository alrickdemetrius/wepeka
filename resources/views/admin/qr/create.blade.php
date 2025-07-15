@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h3>Generate QR for {{ $user->name }}</h3>

    <form action="{{ route('admin.qr.store', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Event Name</label>
            <input type="text" name="event_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>File Type</label>
            <select name="file_type" class="form-select" id="fileType" required>
                <option value="link">Link</option>
                <option value="pdf">PDF</option>
            </select>
        </div>

        <div class="mb-3 d-none" id="linkField">
            <label>Link</label>
            <input type="url" name="file_data" class="form-control">
        </div>

        <div class="mb-3 d-none" id="pdfField">
            <label>Upload PDF</label>
            <input type="file" name="file" class="form-control" accept="application/pdf">
        </div>

        <button class="btn btn-success">Generate QR</button>
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
