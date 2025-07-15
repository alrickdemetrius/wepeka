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
                                <div class="qr-small">
                                    {!! $link->qr_code_svg !!}
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
                                    <a href="{{ route('client.link.edit') }}" class="btn btn-dark fw-semibold px-4 py-2">
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

    <style>
        .qr-small svg {
            width: 100%;
            max-width: 300px;
            height: auto;
        }
    </style>
@endsection