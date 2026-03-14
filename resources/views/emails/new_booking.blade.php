<div style="font-family: sans-serif; padding: 20px; border: 1px solid #eee; border-radius: 10px;">
    <h2 style="color: #FFD700;">Wepeka Apparel</h2>
    <p>Halo Admin, ada pesanan baru yang masuk ke sistem!</p>
    <hr>
    <p><strong>Detail Perusahaan:</strong> {{ $booking->company_name }}</p>
    <p><strong>Kontak:</strong> {{ $booking->contact_name }} ({{ $booking->phone }})</p>
    <p><strong>Layanan yang diminta:</strong></p>
    <ul>
        @foreach($booking->categories as $category)
            <li>{{ $category->name }}</li>
        @endforeach
    </ul>
    <p><strong>Pesan:</strong></p>
    <p style="font-style: italic;">"{{ $booking->message }}"</p>
    <hr>
    <a href="{{ route('admin.bookings.index') }}" style="background: #000; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
        Cek di Admin Panel
    </a>
</div>