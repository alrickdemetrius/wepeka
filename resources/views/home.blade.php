@extends('layouts.app')

{{-- ====================================================================== --}}
{{-- CSS LAMA DAN CSS BARU UNTUK ANIMASI --}}
{{-- ====================================================================== --}}
<style>
    /* CSS ANDA YANG SUDAH ADA (TIDAK DIUBAH) */
    .logo-img {
        height: calc(1em * 1.2);
        width: auto;
        vertical-align: middle;
        margin: 0 0.1em;
    }

    .text-white-custom * {
        color: white !important;
    }

    .navbar-brand .logo-we {
        color: #ffc107;
    }

    .hero-card {
        background-color: #fdfdfd;
        border-radius: 1.5rem;
        border: 1px solid #e9ecef;
    }

    .hero-text-highlight {
        color: #ffc107;
        font-weight: 600;
    }

    .btn-warning {
        --bs-btn-bg: #ffc107;
        --bs-btn-border-color: #ffc107;
        --bs-btn-hover-bg: #ffca2c;
        --bs-btn-hover-border-color: #ffc720;
        font-weight: 600;
        color: #212529;
    }

    .btn-outline-secondary {
        font-weight: 600;
    }

    .section-kicker {
        color: #0d6efd;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .issue-card {
        background-color: #f1f3f5;
        border: none;
        border-radius: 1rem;
    }

    .issue-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 64px;
        height: 64px;
        flex-shrink: 0;
        background-color: #ffc107;
        color: #212529;
        border-radius: 1rem;
        font-size: 2rem;
    }

    .feature-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 80px;
        height: 80px;
        background-color: #212529;
        color: #ffc107;
        border-radius: 1.25rem;
        font-size: 3rem;
        margin-bottom: 1.5rem;
    }

    .carousel-control-btn {
        width: 48px;
        height: 48px;
    }

    .pricing-card {
        border-radius: 1rem;
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .pricing-card-premium {
        border: 2px solid #ffc107;
        background-color: #fffbeb;
        transform: scale(1.05);
        z-index: 10;
    }

    .most-popular-tag {
        position: absolute;
        top: -15px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #ffc107;
        color: #212529;
        padding: 0.25rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .benefits-list {
        list-style: none;
        padding-left: 0;
    }

    .benefits-list li {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.75rem;
    }

    .benefits-list .bi-check-circle-fill {
        color: #212529;
    }

    .custom-accordion .accordion-item {
        margin-bottom: 1rem;
        border-radius: 1rem !important;
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    .custom-accordion .accordion-button {
        font-size: 1.5rem;
        font-weight: 600;
        border-radius: 1rem !important;
    }

    .custom-accordion .accordion-button:not(.collapsed) {
        color: #212529;
        background-color: #ffffff;
        box-shadow: none;
    }

    .custom-accordion .accordion-button:focus {
        box-shadow: none;
        border-color: transparent;
    }

    .custom-accordion .accordion-body {
        font-size: 1.1rem;
        padding: 1.5rem;
    }

    /* ============================================== */
    /* CSS BARU UNTUK ANIMASI INTRO (TAMBAHAN)        */
    /* ============================================== */
    .animate-on-scroll {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.8s ease-out, transform 0.6s ease-out;
    }

    .animate-on-scroll.is-visible {
        opacity: 1;
        transform: translateY(0);
    }

</style>

@section('content')
    {{-- PERUBAHAN: Menambahkan class 'animate-on-scroll' --}}
    <div class="container-fluid mt-5 mb-3 animate-on-scroll">
        <div class="hero-card shadow-sm">
            <div class="card-body py-5 px-md-5">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6">
                        <div style="
                            background: url('{{ asset('images/blur_home.jpg') }}');
                            height: 800px;
                            background-size: cover;
                            background-position: center;
                            border-radius: 0.75rem;">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h1 class="display-4 fw-bold mb-4">
                            Introducing <span class="text-warning fw-semibold">We</span><span class="fw-semibold">peka</span>:<br>
                            Your Branding Kit Partner
                        </h1>
                        <div class="d-flex align-items-center mb-4">
                            <div class="d-flex me-3">
                                <img src="https://i.pravatar.cc/48?img=1" class="rounded-circle border border-2 border-white" alt="avatar 1" style="margin-right: -15px;">
                                <img src="https://i.pravatar.cc/48?img=2" class="rounded-circle border border-2 border-white" alt="avatar 2" style="margin-right: -15px;">
                                <img src="https://i.pravatar.cc/48?img=3" class="rounded-circle border border-2 border-white" alt="avatar 3">
                            </div>
                            <span class="text-muted fw-medium fs-5">7+ projects</span>
                        </div>
                        <div class="d-flex gap-3">
                            <a href="{{ route('login') }}" class="btn btn-warning btn-lg px-4 py-3 d-flex align-items-center gap-2">
                                Get Started <i class="bi bi-arrow-right"></i>
                            </a>
                            <a href="#" class="btn btn-outline-secondary btn-lg px-4 py-3 d-flex align-items-center gap-2">
                                Learn More <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="height: 70px;"></div>

    {{-- PERUBAHAN: Menambahkan class 'animate-on-scroll' --}}
    <div class="container-fluid mt-5 mb-3 animate-on-scroll">
        <div class="hero-card shadow-sm">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center mt-4">
                    <p class="section-kicker" style="font-size: 28px;">Our Mission</p>
                    <h2 class="display-3 fw-bold">Transform Your Brand Identity</h2>
                    <p class="lead text-muted mt-3" style="font-size: 27px;">
                        Discover Key challenges business face today.
                    </p>
                </div>
            </div>
            <div class="card border-0 shadow-sm mt-5" style="border-radius: 1.5rem">
                <div class="card-body p-4 p-md-5">
                    <div class="row g-5 align-items-start">
                        <div class="col-lg-6 d-flex flex-column justify-content-center">
                            <p class="text-uppercase fw-bold text-primary mb-2 fs-5">Key Issues</p>
                            <h2 class="display-5 fw-bolder mb-3">Understanding Your Branding Struggles</h2>
                            <p class="text-muted fs-3">
                                Common hurdles that businesses are currently facing
                            </p>
                            <div class="issue-card mt-5">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center gap-4">
                                        <div class="issue-icon">
                                            <i class="bi bi-person-fill"></i>
                                        </div>
                                        <div>
                                            <h2 class="fw-bold">Unclear identity</h2>
                                            <p class="mb-0 text-muted fs-4">
                                                Your brand looks different on every platform — from
                                                social media to print. Without a consistent identity,
                                                customers struggle to recognize and remember you.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div style="
                                background: url('{{ asset('images/blur_home.jpg') }}');
                                height: 550px;
                                background-size: cover;
                                background-position: center;
                                border-radius: 1rem;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-0 shadow-sm mt-5" style="border-radius: 1.5rem">
                <div class="card-body p-4 p-md-5">
                    <div class="row g-5 align-items-start">
                        <div class="col-lg-6">
                            <div style="
                                background: url('{{ asset('images/blur_home.jpg') }}');
                                height: 550px;
                                background-size: cover;
                                background-position: center;
                                border-radius: 1rem;">
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex flex-column justify-content-center">
                            <p class="text-uppercase fw-bold text-primary mb-2 fs-5">Key Issues</p>
                            <h2 class="display-5 fw-bolder mb-3">Limited Brand Insights</h2>
                            <p class="text-muted fs-3">
                                Common hurdles that businesses are currently facing
                            </p>
                            <div class="issue-card mt-5">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center gap-4">
                                        <div class="issue-icon">
                                            <i class="bi bi-x-lg"></i>
                                        </div>
                                        <div>
                                            <h2 class="fw-bold">No Emotional Connection</h2>
                                            <p class="mb-0 text-muted fs-4">
                                                Many businesses design logos and visuals but lack brand insights. They don't
                                                know how customers see them or how they compare to competitors. The brand
                                                struggles to connect with its audience.
                                            </p>
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

    {{-- PERUBAHAN: Menambahkan class 'animate-on-scroll' --}}
    <div class="container my-5 py-5 animate-on-scroll">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-5">
                <h2 class="display-4 fw-bold">Wepeka Can Help!</h2>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-5">
            <div class="col">
                <div class="card h-100 shadow-sm" style="border-radius: 1rem; border: 1px solid #e9ecef;">
                    <div class="card-body p-4">
                        <div class="feature-icon">
                            <i class="bi bi-pencil-square"></i>
                        </div>
                        <h2 class="fw-bold">Logo Design</h2>
                        <p class="text-muted fs-5">
                            Unique and memorable logos that represent your brand's essence
                        </p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 shadow-sm" style="border-radius: 1rem; border: 1px solid #e9ecef;">
                    <div class="card-body p-4">
                        <div class="feature-icon">
                            <i class="bi bi-book"></i>
                        </div>
                        <h2 class="fw-bold">Brand Guidelines</h2>
                        <p class="text-muted fs-5">
                            Unique and memorable logos that represent your brand's essence
                        </p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 shadow-sm" style="border-radius: 1rem; border: 1px solid #e9ecef;">
                    <div class="card-body p-4">
                        <div class="feature-icon">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <h2 class="fw-bold">Scaling Up</h2>
                        <p class="text-muted fs-5">
                            Unique and memorable logos that represent your brand's essence
                        </p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 shadow-sm" style="border-radius: 1rem; border: 1px solid #e9ecef;">
                    <div class="card-body p-4">
                        <div class="feature-icon">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <h2 class="fw-bold">Apparels</h2>
                        <p class="text-muted fs-5">
                            Unique and memorable logos that represent your brand's essence
                        </p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 shadow-sm" style="border-radius: 1rem; border: 1px solid #e9ecef;">
                    <div class="card-body p-4">
                        <div class="feature-icon">
                            <i class="bi bi-search"></i>
                        </div>
                        <h2 class="fw-bold">Brand Insights</h2>
                        <p class="text-muted fs-5">
                            Unique and memorable logos that represent your brand's essence
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- PERUBAHAN: Menambahkan class 'animate-on-scroll' --}}
    <div class="container my-5 py-5 animate-on-scroll">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-5">
                <h2 class="display-4 fw-bold">Wepeka Portfolio</h2>
                <p class="lead text-muted mt-3" style="font-size: 27px;">
                    Explore our recent branding projects and how we've helped businesses transform their identity
                </p>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

            {{-- ====================================================== --}}
            {{-- GANTI KODE STATIS LAMA ANDA DENGAN KODE DINAMIS INI --}}
            {{-- ====================================================== --}}

            @forelse($featuredPortfolios as $portfolio)
            <div class="col">
                <div class="card h-100 shadow-sm overflow-hidden" style="border-radius: 1rem; border: 1px solid #e9ecef;">

                    {{-- GAMBAR DINAMIS --}}
                    <div style="
                        height: 300px;
                        background: url('{{ $portfolio->image ? asset('storage/' . $portfolio->image) : asset('images/blur_home.jpg') }}');
                        background-size: cover;
                        background-position: center;
                    "></div>

                    <div class="card-body">
                        <div class="mb-2">
                            {{-- KATEGORI/TAG DINAMIS --}}
                            <span class="badge rounded-pill bg-secondary fw-medium me-1 px-3 py-1">{{ $portfolio->category }}</span>
                        </div>

                        {{-- NAMA PROYEK DINAMIS --}}
                        <h4 class="card-title fw-bold">{{ $portfolio->project_name }}</h4>

                        {{-- DESKRIPSI DINAMIS --}}
                        <p class="card-text text-muted">
                            {{ $portfolio->description }}
                        </p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p class="lead text-muted">Belum ada portofolio yang ditampilkan.</p>
            </div>
            @endforelse

            {{-- ====================================================== --}}
            {{-- AKHIR DARI MODIFIKASI --}}
            {{-- ====================================================== --}}

        </div>
    </div>

    {{-- PERUBAHAN: Menambahkan class 'animate-on-scroll' --}}
    <div class="container my-5 py-5 animate-on-scroll">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-5">
                <h2 class="display-4 fw-bold">What Our Clients Say</h2>
                <p class="lead text-muted mt-3" style="font-size: 27px;">
                    Don't just take our word for it - hear from businesses we've helped transform
                </p>
            </div>
        </div>
        <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                {{-- Isi Testimonials Anda --}}
                <div class="carousel-item active">
                    <div class="card border-0 shadow-sm" style="border-radius: 1.5rem;">
                        <div class="card-body p-5 text-center">
                            <div class="text-warning mb-4" style="font-size: 2rem;">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                            </div>
                            <div class="p-5 rounded mb-4" style="background-color: #f1f3f5;">
                                <p class="h2 fst-italic lh-base">
                                    "Working with them was a game-changer. Our brand finally feels cohesive and professional. The results speak for themselves."
                                </p>
                            </div>
                            <img src="https://i.pravatar.cc/100?img=11" class="rounded-circle mb-3" alt="Author 1" width="100" height="100">
                            <p class="fw-bold mb-0 fs-4">Sarah L.</p>
                            <p class="text-muted fs-6">CEO + Fashione</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                     <div class="card border-0 shadow-sm" style="border-radius: 1.5rem;">
                        <div class="card-body p-5 text-center">
                            <div class="text-warning mb-4" style="font-size: 2rem;">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                            </div>
                            <div class="p-5 rounded mb-4" style="background-color: #f1f3f5;">
                                <p class="h2 fst-italic lh-base">
                                    "The creative process was seamless and incredibly insightful. They truly understood our vision and brought it to life."
                                </p>
                            </div>
                            <img src="https://i.pravatar.cc/100?img=32" class="rounded-circle mb-3" alt="Author 2" width="100" height="100">
                            <p class="fw-bold mb-0 fs-4">Michael B.</p>
                            <p class="text-muted fs-6">Founder + TechStart</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-4">
            <button class="btn btn-outline-dark rounded-circle carousel-control-btn mx-2" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                <i class="bi bi-arrow-left"></i>
            </button>
            <button class="btn btn-outline-dark rounded-circle carousel-control-btn mx-2" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                <i class="bi bi-arrow-right"></i>
            </button>
        </div>
    </div>

    {{-- PERUBAHAN: Menambahkan class 'animate-on-scroll' --}}
    <div class="container my-5 py-5 animate-on-scroll">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-5">
                <h2 class="display-4 fw-bold">Pricing</h2>
            </div>
        </div>
        <div class="row justify-content-center align-items-center g-4">
            {{-- Isi Pricing Anda --}}
            <div class="col-lg-4">
                 <div class="card pricing-card h-100 shadow-sm">
                    <div class="card-body p-4 p-md-5 text-center">
                        <h2 class="fw-normal">Basic</h2>
                        <h2 class="display-4 fw-bold my-3">
                            <span style="font-size: 0.5em; vertical-align: super;">Rp</span>2.000.000
                        </h2>
                        <p class="text-muted fs-5">Perfect for: Startups and Small Businesses</p>
                        <hr>
                        <ul class="benefits-list text-start my-4 fs-5">
                            <li><i class="bi bi-check-circle-fill"></i> Benefit 1</li>
                            <li><i class="bi bi-check-circle-fill"></i> Benefit 2</li>
                            <li><i class="bi bi-check-circle-fill"></i> Benefit 3</li>
                        </ul>
                        <a href="#" class="btn btn-primary btn-lg w-100 py-3">Get Started</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 position-relative">
                <div class="card pricing-card h-100 shadow" style="border: 2px solid #ffc107; background-color: #fffbeb; transform: scale(1.05); z-index: 10;">
                    <div class="most-popular-tag">Most Popular!</div>
                    <div class="card-body p-4 p-md-5 text-center">
                        <h2 class="fw-bold">Premium</h2>
                        <h2 class="display-4 fw-bold my-3">
                            <span style="font-size: 0.5em; vertical-align: super;">Rp</span>5.000.000
                        </h2>
                        <p class="text-muted fs-5">Complete Branding Solution for Growing Businesses</p>
                        <hr>
                        <ul class="benefits-list text-start my-4 fs-5">
                            <li><i class="bi bi-check-circle-fill"></i> Benefit 1</li>
                            <li><i class="bi bi-check-circle-fill"></i> Benefit 2</li>
                            <li><i class="bi bi-check-circle-fill"></i> Benefit 3</li>
                            <li><i class="bi bi-check-circle-fill"></i> Benefit 4</li>
                        </ul>
                        <a href="#" class="btn btn-dark btn-lg w-100 py-3">Get Started</a>
                    </div>
                </div>
            </div>
             <div class="col-lg-4">
                <div class="card pricing-card h-100 shadow-sm">
                    <div class="card-body p-4 p-md-5 text-center">
                        <h2 class="fw-normal">Ultimate</h2>
                        <h2 class="display-4 fw-bold my-3">
                            <span style="font-size: 0.5em; vertical-align: super;">Rp</span>10.000.000
                        </h2>
                        <p class="text-muted fs-5">Comprehensive Branding Strategy for Established Company</p>
                        <hr>
                        <ul class="benefits-list text-start my-4 fs-5">
                            <li><i class="bi bi-check-circle-fill"></i> Benefit 1</li>
                            <li><i class="bi bi-check-circle-fill"></i> Benefit 2</li>
                            <li><i class="bi bi-check-circle-fill"></i> Benefit 3</li>
                            <li><i class="bi bi-check-circle-fill"></i> Benefit 4</li>
                            <li><i class="bi bi-check-circle-fill"></i> Benefit 5</li>
                        </ul>
                        <a href="#" class="btn btn-primary btn-lg w-100 py-3">Get Started</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- PERUBAHAN: Menambahkan class 'animate-on-scroll' --}}
    <div class="container my-5 py-5 animate-on-scroll">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-5">
                <h2 class="display-4 fw-bold">Frequently Asked Questions</h2>
                <p class="lead text-muted mt-3" style="font-size: 27px;">
                    Everything you need to know about our branding process
                </p>
            </div>
        </div>
        <div class="accordion custom-accordion" id="faqAccordion">
            {{-- Isi FAQ Anda --}}
             @for ($i = 1; $i <= 5; $i++)
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading{{ $i }}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse{{ $i }}" aria-expanded="false" aria-controls="collapse{{ $i }}">
                        Question {{ $i }}: What is a branding kit?
                    </button>
                </h2>
                <div id="collapse{{ $i }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $i }}" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-muted">
                        A branding kit is a comprehensive package that includes all the visual and strategic elements of your brand identity, such as your logo, color palette, typography, and brand guidelines. It ensures consistency across all your marketing materials.
                    </div>
                </div>
            </div>
            @endfor
        </div>
        <div class="text-center mt-5">
            <p class="fs-5 mb-3">Still have questions? Contact Us!</p>
            <a href="#" class="btn btn-dark btn-lg px-5 py-3">Contact Us</a>
        </div>
    </div>
@endsection

{{-- ====================================================================== --}}
{{-- JAVASCRIPT BARU UNTUK MENGAKTIFKAN ANIMASI --}}
{{-- ====================================================================== --}}
@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Pilih semua elemen yang ingin dianimasikan
        const animatedElements = document.querySelectorAll('.animate-on-scroll');

        // Buat observer
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                // Jika elemen masuk ke dalam viewport
                if (entry.isIntersecting) {
                    // Tambahkan class 'is-visible' untuk memicu transisi
                    entry.target.classList.add('is-visible');
                    // (Opsional) Hentikan observing elemen ini setelah animasi berjalan
                    // agar tidak berjalan berulang kali
                    observer.unobserve(entry.target);
                }
            });
        }, {
            // Opsi: Atur kapan animasi akan terpicu. 0.1 berarti saat 10%
            // dari elemen terlihat, animasi akan dimulai.
            threshold: 0.1
        });

        // Terapkan observer ke setiap elemen yang dipilih
        animatedElements.forEach(el => {
            observer.observe(el);
        });
    });
</script>
@endpush