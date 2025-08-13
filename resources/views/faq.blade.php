@extends('layouts.app')

@section('styles')
<style>
    .faq-header {
        background: linear-gradient(to right, var(--hunter-green), var(--fern-green));
        padding: 4rem 0 2rem;
        margin-bottom: 3rem;
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
        text-align: center;
        color: white;
    }

    .faq-header h1 {
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .faq-header .lead {
        opacity: 0.9;
        max-width: 700px;
        margin: 0 auto;
    }

    .faq-section {
        text-align: center;
        margin-bottom: 3rem;
        animation: fadeInDown 0.6s ease-in-out;
    }

    .faq-section h2 {
        margin-bottom: 2rem;
        color: var(--brunswick-green);
        position: relative;
        display: inline-block;
    }

    .faq-section h2:after {
        content: '';
        position: absolute;
        width: 50%;
        height: 3px;
        background-color: var(--sage);
        bottom: -10px;
        left: 25%;
    }

    .accordion {
        max-width: 800px;
        margin: 0 auto 4rem;
    }

    .accordion-item {
        margin-bottom: 1rem;
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        background: white;
    }

    .accordion-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }

    .accordion-button {
        background-color: white;
        color: var(--brunswick-green);
        font-weight: 600;
        padding: 1.2rem 1.5rem;
        border: none;
        border-radius: 12px !important;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Custom icon for open/close */
    .accordion-button::after {
        flex-shrink: 0;
        width: 1.2rem;
        height: 1.2rem;
        background-image: none;
        content: '+';
        font-size: 1.4rem;
        font-weight: bold;
        color: var(--brunswick-green);
        transition: transform 0.3s ease, color 0.3s ease;
    }

    .accordion-button:not(.collapsed)::after {
        content: '-';
        color: white;
    }

    .accordion-button:not(.collapsed) {
        background: linear-gradient(to right, var(--fern-green), var(--hunter-green));
        color: white;
        border-radius: 12px 12px 0 0 !important;
    }

    .accordion-button:focus {
        box-shadow: none;
        border-color: transparent;
    }

    .accordion-body {
        background-color: white;
        padding: 1.5rem;
        line-height: 1.7;
        color: #555;
        border-top: 1px solid rgba(0, 0, 0, 0.05);
        animation: fadeIn 0.4s ease-in-out;
    }

    /* Animation effects */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-5px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-15px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Search Bar di pojok kanan atas */
    .faq-search-global {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1000;
    }

    .faq-search-global input {
        padding: 0.6rem 1rem 0.6rem 2.5rem;
        border-radius: 25px;
        border: none;
        outline: none;
        background: white url('data:image/svg+xml;utf8,<svg fill="%23666" height="20" viewBox="0 0 24 24" width="20" xmlns="http://www.w3.org/2000/svg"><path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0016 9.5 6.5 6.5 0 109.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C8.01 14 6 11.99 6 9.5S8.01 5 10.5 5 15 7.01 15 9.5 12.99 14 10.5 14z"/></svg>') no-repeat 10px center;
        background-size: 16px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        transition: all 0.3s ease;
        width: 240px;
    }

    .faq-search-global input:focus {
        box-shadow: 0 6px 20px rgba(0,0,0,0.25);
        transform: scale(1.03);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .faq-search-global {
            top: 10px;
            right: 10px;
        }
        .faq-search-global input {
            width: 180px;
        }
    }
</style>
@endsection

@section('content')
<div style="
    background: url('{{ asset('images/blur_faq.jpg') }}') no-repeat center center;
    background-size: cover;
    min-height: 100vh;
" class="d-flex align-items-center justify-content-center">

    <!-- Search Bar Global -->
    <div class="faq-search-global">
        <input type="text" id="faqSearch" placeholder="Cari pertanyaan...">
    </div>

    <div class="container">
        <!-- Title -->
        <div class="faq-section">
            <h2>Frequently Asked Questions</h2>
        </div>

        <style>
            .faq-section h2 {
                margin-bottom: 2rem;
                color: white;
                position: relative;
                display: inline-block;
                font-size: 2.5rem;
                font-weight: 800;
            }
        </style>

        <!-- FAQ -->
        <div class="accordion" id="faqAccordion">
            @php
                $faqs = [
                    ['Apa itu WEPEKA?', 'Wepeka adalah vendor kreatif penyedia apparel custom dan kebutuhan branding kit—dari desain, website, jingle, hingga kartu nama. Kami hadir sebagai partner brand Anda untuk membangun identitas yang kuat.<br>Cek layanan & harga lengkap di Instagram <strong>@wepeka.apparel</strong>.'],
                    ['Apa yang membuat WPK berbeda dari vendor apparel lainnya?', 'Kami tidak sekadar membuat baju. WEPEKA menghadirkan desain apparel berdasarkan storytelling yang digali langsung dari visi dan karakter brand Anda.'],
                    ['Siapa saja yang bisa menggunakan layanan WEPEKA?', 'Perusahaan, organisasi, instansi pendidikan, komunitas, dan siapa pun yang ingin menyampaikan cerita dan identitas melalui apparel.'],
                    ['Berapa minimal order di WEPEKA?', 'Minimal pemesanan adalah 1 lusin / 12 pcs.'],
                    ['Berapa lama proses pengerjaannya?', 'Estimasi pengerjaan antara <1 minggu hingga 2 minggu, tergantung tingkat kompleksitas desain dan pemesanan.'],
                    ['Apakah QR scannable tag gratis?', '<strong>Static Tag:</strong> Gratis<br><br><strong>Dynamic Tag:</strong> Tidak gratis. Biaya normal Rp1.000.000/tahun, tetapi ada promo 50% jadi Rp500.000 untuk 3 bulan pertama.'],
                    ['Apa itu Dynamic Tag dan apa benefit-nya?', 'Dynamic Tag memungkinkan isi dari QR Code yang tertanam di apparel untuk diganti-ganti selama 1 tahun tanpa mengganti QR-nya.<br>Klien mendapat akses ke halaman khusus di website kami untuk mengubah konten (misal: profil perusahaan, video campaign, katalog, dsb).<br>📌 Fungsi: QR-nya tetap sama, tapi isinya bisa disesuaikan kapan saja—fleksibel dan fungsional.'],
                    ['Apakah jasa desain gratis?', 'Ya, untuk pemesanan ≥30 pcs, jasa desain gratis.<br>Pengerjaan desain maksimal 1–3 hari kerja dengan revisi bebas.'],
                    ['Siapa yang memproduksi apparel WEPEKA?', 'Produksi dilakukan oleh jaringan vendor rekanan terpercaya kami dari berbagai daerah.<br>Kami juga membuka peluang kolaborasi untuk vendor baru.'],
                    ['Di mana saya bisa melihat price list dan size chart?', '<strong>Price list:</strong> Bisa dilihat di Instagram kami <strong>@wepeka.apparel</strong><br><strong>Size chart:</strong> Akan kami kirimkan secara langsung saat Anda menghubungi kami untuk pemesanan.'],
                    ['Apakah bisa custom desain sesuai kebutuhan?', 'Bisa. Semua desain berbasis eksplorasi mendalam melalui sesi wawancara brand.'],
                    ['Bagaimana alur pemesanan di WEPEKA?', '1. Hubungi tim kami<br>2. Sesi wawancara (brand exploration)<br>3. Proses desain → revisi<br>4. Approval desain + produksi<br>5. Pengiriman<br>(Opsional) Retail & konten promosi digital'],
                    ['Apa keuntungan bekerja sama dengan WEPEKA?', '• Apparel storytelling unik<br>• Branding kit lengkap<br>• QR Tag interaktif<br>• Dukungan konten Reels, TikTok & YouTube<br>• Potensi komisi dari penjualan retail']
                ];
            @endphp

            @foreach ($faqs as $index => $faq)
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}" type="button"
                            data-bs-toggle="collapse" data-bs-target="#faq{{ $index + 1 }}">
                            {{ $faq[0] }}
                        </button>
                    </h2>
                    <div id="faq{{ $index + 1 }}"
                        class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">{!! $faq[1] !!}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Script Filter FAQ -->
<script>
document.getElementById('faqSearch').addEventListener('keyup', function() {
    let filter = this.value.toLowerCase();
    let items = document.querySelectorAll('#faqAccordion .accordion-item');
    items.forEach(function(item) {
        let question = item.querySelector('.accordion-button').textContent.toLowerCase();
        let answer = item.querySelector('.accordion-body').textContent.toLowerCase();
        if (question.includes(filter) || answer.includes(filter)) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    });
});
</script>
@endsection
