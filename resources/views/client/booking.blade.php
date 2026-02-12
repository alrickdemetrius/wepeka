@extends('layouts.app')

@section('content')

    <style>
        .sub-nav-banner {
            background-color: #FFD700;
            padding: 15px 0;
            font-weight: 700;
            font-size: 0.9rem;
            border-top: 1px solid #e0c000;
            border-bottom: 1px solid #e0c000;
            overflow: hidden;
            width: 100%;
        }

        .sub-nav-items {
            display: flex;
            justify-content: center;
            gap: 150px;
            text-transform: uppercase;
            color: #000;
            white-space: nowrap;
        }

        @media (max-width: 992px) {
            .sub-nav-items {
                gap: 40px;
                justify-content: flex-start;
                overflow-x: auto;
                padding-left: 20px;
                padding-right: 20px;
            }

            .sub-nav-items::-webkit-scrollbar {
                display: none;
            }
        }

        /* === 2. Form Styling === */
        .form-control,
        .form-select {
            background-color: #f0f2f5;
            border: none;
            border-radius: 8px;
            padding: 12px 15px;
            margin-bottom: 15px;
            font-size: 0.95rem;
        }

        .form-control:focus,
        .form-select:focus {
            background-color: #e4e6eb;
            box-shadow: none;
            border: 1px solid #ccc;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 6px;
        }

        .btn-send {
            background-color: #FFD700;
            color: black;
            font-weight: 700;
            border-radius: 50px;
            padding: 12px 40px;
            border: none;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-send:hover {
            background-color: #ffca2c;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(255, 215, 0, 0.3);
        }

        /* === 3. Right Info Box (Yellow Card) - MODIFIED === */
        .info-box {
            background-color: #FFD700;
            border-radius: 20px;
            padding: 50px 40px;
            /* Padding diperbesar */
            height: 100%;
            color: #000;
            position: relative;
        }

        .info-box h4 {
            font-size: 1.8rem;
            /* Ukuran H4 diperbesar */
            line-height: 1.3;
            margin-bottom: 25px !important;
            /* Margin bawah H4 */
        }

        .info-box p {
            font-size: 1.1rem;
            /* Ukuran paragraf diperbesar */
            line-height: 1.7;
            margin-bottom: 40px !important;
            /* Margin bawah paragraf */
        }

        .step-list {
            list-style: none;
            padding: 0;
            margin-top: 30px;
            /* Margin atas list */
        }

        .step-list li {
            margin-bottom: 30px;
            /* Jarak antar item list diperbesar */
            font-size: 1.05rem;
            /* Ukuran teks list diperbesar */
            display: flex;
            align-items: flex-start;
            gap: 15px;
        }

        .step-list li strong {
            font-size: 1.15rem;
            /* Teks bold di list lebih besar */
        }

        .step-number {
            background-color: rgba(0, 0, 0, 0.15);
            /* Warna lebih gelap */
            min-width: 28px;
            /* Ukuran lingkaran nomor diperbesar */
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            /* Ukuran angka di lingkaran */
            font-weight: bold;
            margin-top: 2px;
        }

        .social-icons-box {
            margin-top: 35px !important;
            display: flex;
            align-items: center;
        }

        .social-icons-box a {
            display: inline-flex;
            /* Agar bisa diatur lebar/tinggi */
            align-items: center;
            /* Tengahkan icon secara vertikal */
            justify-content: center;
            /* Tengahkan icon secara horizontal */
            width: 60px;
            /* Lebar lingkaran */
            height: 60px;
            /* Tinggi lingkaran */
            background-color: #FFB619;
            /* WARNA LINGKARAN SESUAI REQUEST */
            border-radius: 50%;
            /* Membuat bentuk bulat sempurna */
            color: #000;
            /* Warna Icon Hitam */
            font-size: 1.8rem;
            /* Ukuran Icon */
            margin-right: 20px;
            /* Jarak antar lingkaran */
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-icons-box a:hover {
            transform: translateY(-5px);
            /* Efek naik sedikit saat di-hover */
            filter: brightness(0.9);
            /* Sedikit menggelap saat di-hover */
        }

        /* === 4. Bottom Illustrations === */
        .illustration-card {
            background-color: #f9f9f9;
            border-radius: 15px;
            overflow: hidden;
            border: 1px solid #eee;
            height: 220px;
            /* Tinggi tetap agar rapi */
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease;
            position: relative;
            /* Penting untuk overlay */
        }

        .illustration-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Gambar akan di-crop otomatis agar full kotak */
        }

        /* Tambahan: Efek Overlay saat hover agar user tau itu project apa */
        .portfolio-overlay {
            position: absolute;
            bottom: 10px;
            left: 10px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .illustration-card:hover .portfolio-overlay {
            opacity: 1;
        }

        /* Styling khusus tombol toggle layanan */
        .service-selection .btn-check+.btn {
            border: 2px solid #FFD700;
            background-color: transparent;
            color: #000;
            font-weight: 600;
            border-radius: 50px;
            padding: 8px 20px;
            margin-right: 10px;
            margin-bottom: 10px;
            transition: all 0.3s ease;
        }

        .service-selection .btn-check:checked+.btn {
            background-color: #FFD700;
            border-color: #FFD700;
            color: #000;
            box-shadow: 0 4px 10px rgba(255, 215, 0, 0.3);
        }

        .service-selection .btn-check+.btn:hover {
            background-color: rgba(255, 214, 0, 0.1);
        }
    </style>

    {{-- === TOP BANNER === --}}
    <div class="sub-nav-banner">
        <div class="container">
            <div class="sub-nav-items">
                <span><i class="fas fa-star me-1"></i> WEBSITE DESIGN</span>
                <span><i class="fas fa-pen-nib me-1"></i> GRAPHIC DESIGN</span>
                <span><i class="fas fa-bullhorn me-1"></i> DIGITAL MARKETING</span>
                <span><i class="fas fa-music me-1"></i> JINGLE</span>
                <span><i class="fas fa-tshirt me-1"></i> APPAREL DESIGN</span>
            </div>
        </div>
    </div>

    {{-- === MAIN CONTENT === --}}
    <div class="container py-5">
        <div class="row g-5">
            {{-- Kiri: Form --}}
            <div class="col-lg-7">
                <h2 class="fw-bold mb-4" style="font-size: 2.8rem; line-height: 1.1; letter-spacing: -0.02em;">
                    Join Us In Creating<br>Something Great
                </h2>

                <form action="{{ route('booking.store') }}" method="POST">
                    @csrf

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-2">
                        <label class="form-label">Company Name*</label>
                        <input type="text" name="company_name" class="form-control">
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Contact Name*</label>
                        <input type="text" name="contact_name" class="form-control">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">Email*</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label">Phone Number*</label>
                                <input type="text" name="phone" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label d-block">Service Type* <span class="small text-muted fw-normal">(Select one
                                or more)</span></label>
                        <div class="service-selection">
                            {{-- Website Design --}}
                            <input type="checkbox" name="service_type[]" value="website" class="btn-check" id="svc-website"
                                autocomplete="off">
                            <label class="btn" for="svc-website">Website Design</label>

                            {{-- Branding & Logo --}}
                            <input type="checkbox" name="service_type[]" value="branding" class="btn-check"
                                id="svc-branding" autocomplete="off">
                            <label class="btn" for="svc-branding">Branding & Logo</label>

                            {{-- Digital Marketing --}}
                            <input type="checkbox" name="service_type[]" value="marketing" class="btn-check"
                                id="svc-marketing" autocomplete="off">
                            <label class="btn" for="svc-marketing">Digital Marketing</label>

                            {{-- Jingle --}}
                            <input type="checkbox" name="service_type[]" value="jingle" class="btn-check" id="svc-jingle"
                                autocomplete="off">
                            <label class="btn" for="svc-jingle">Jingle</label>

                            {{-- Apparel Production --}}
                            <input type="checkbox" name="service_type[]" value="apparel" class="btn-check" id="svc-apparel"
                                autocomplete="off">
                            <label class="btn" for="svc-apparel">Apparel Production</label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Message*</label>
                        <textarea name="message" class="form-control" rows="5"></textarea>
                    </div>

                    <button type="submit" class="btn btn-send">
                        Send Message
                    </button>
                </form>
            </div>

            {{-- Kanan: Info Box Kuning - MODIFIED --}}
            <div class="col-lg-5">
                <div class="info-box">
                    <h4 class="fw-bold mb-3">What will be the next steps?</h4>
                    <p class="small mb-4 opacity-75">
                        You are one step closer to build your perfect product. Our team is ready to help you achieve your
                        goals.
                    </p>

                    <ul class="step-list">
                        <li>
                            <div class="step-number">1</div>
                            <div><strong>We'll prepare a proposal</strong><br><span class="small opacity-75">Required scope,
                                    timeline and price will be included.</span></div>
                        </li>
                        <li>
                            <div class="step-number">2</div>
                            <div><strong>Together we discuss it</strong><br><span class="small opacity-75">Let's get
                                    acquainted and discuss all the possible variants and options.</span></div>
                        </li>
                        <li>
                            <div class="step-number">3</div>
                            <div><strong>Let us help build your product</strong><br><span class="small opacity-75">When the
                                    contract is signed, we start working immediately.</span></div>
                        </li>
                    </ul>

                    <div class="mt-5 pt-3 border-top border-dark border-opacity-10">
                        <h6 class="fw-bold mb-3">Stay Connected</h6>
                        <div class="social-icons-box">
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-tiktok"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bagian Bawah: 3 Ilustrasi --}}
        <div class="row mt-5 pt-4 g-4 mb-5">
            @forelse($featuredPortfolios as $portfolio)
                <div class="col-md-4">
                    <div class="illustration-card position-relative">
                        {{-- Gambar Portfolio --}}
                        <img src="{{ $portfolio->image ? asset('storage/' . $portfolio->image) : asset('images/blur_home.jpg') }}"
                            alt="{{ $portfolio->project_name }}"
                            title="{{ $portfolio->project_name }} - {{ $portfolio->category }}">

                        {{-- (Opsional) Label Nama Project saat Hover --}}
                        <div class="portfolio-overlay">
                            <span class="badge bg-warning text-dark">{{ $portfolio->category }}</span>
                        </div>
                    </div>
                </div>
            @empty
                {{-- Tampilan jika belum ada portfolio featured --}}
                <div class="col-12 text-center py-4">
                    <p class="text-muted">Portfolio content will appear here.</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- === BOTTOM BANNER === --}}
    <div class="sub-nav-banner">
        <div class="container">
            <div class="sub-nav-items">
                <span><i class="fas fa-star me-1"></i> WEBSITE DESIGN</span>
                <span><i class="fas fa-pen-nib me-1"></i> GRAPHIC DESIGN</span>
                <span><i class="fas fa-bullhorn me-1"></i> DIGITAL MARKETING</span>
                <span><i class="fas fa-music me-1"></i> JINGLE</span>
                <span><i class="fas fa-tshirt me-1"></i> APPAREL DESIGN</span>
            </div>
        </div>
    </div>

@endsection