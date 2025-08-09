@extends('layouts.app')

@section('content')
<style>
    /* === Background Utama untuk Kedua Section === */
    .about-features-wrapper {
        background: url('{{ asset('images/blur_about.jpg') }}') no-repeat center center;
        background-size: cover;
        min-height: 100vh;
        color: white;
        font-family: 'Helvetica Neue', sans-serif;
        position: relative;
    }

    .about-features-wrapper::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        backdrop-filter: blur(6px);
        background-color: rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    /* === About Section === */
    .about-section,
    .features-section {
        position: relative;
        z-index: 2;
        padding: 140px 40px 150px;
    }

    .about-container {
        display: flex;
        flex-wrap: wrap;
        max-width: 1400px;
        gap: 60px;
        align-items: center;
        margin: auto;
    }

    .about-text {
        flex: 1 1 600px;
    }

    .about-title {
        font-size: 4rem;
        font-weight: bold;
        margin-bottom: 30px;
    }

    .about-description {
        font-size: 1.3rem;
        line-height: 2;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 50px;
    }

    .highlight-box {
        background-color: #1e1e1e;
        padding: 25px 40px;
        border-radius: 10px;
        display: inline-block;
    }

    .highlight-box h2 {
        font-size: 3rem;
        font-weight: bold;
        margin: 0;
    }

    .highlight-box p {
        margin-top: 15px;
        margin-bottom: 0;
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.85);
    }

    .about-image {
        flex: 1 1 500px;
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 10px;
        height: 600px;
    }

    /* === Features Section === */
    .features-container {
        max-width: 1200px;
        margin: auto;
        text-align: center;
    }

    .features-title {
        font-size: 3rem;
        font-weight: bold;
        margin-bottom: 60px;
    }

    .feature-cards {
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
        justify-content: center;
    }

    .feature-card {
        flex: 1 1 300px;
        padding: 30px;
        border-radius: 15px;
        color: white;
        backdrop-filter: blur(10px);
        text-align: center;
        min-height: 200px;
    }

    .feature-card h3 {
        font-size: 1.8rem;
        margin-bottom: 15px;
    }

    .feature-card p {
        font-size: 1rem;
        line-height: 1.6;
    }

    .bg-blue {
        background: rgba(0, 90, 200, 0.4);
    }

    .bg-green {
        background: rgba(0, 120, 0, 0.4);
    }

    .bg-red {
        background: rgba(180, 0, 0, 0.4);
    }
</style>

<div class="about-features-wrapper">
    {{-- About Section --}}
    <div class="about-section">
        <div class="about-container">
            <div class="about-text">
                <div class="about-title">About Us</div>
                <div class="about-description">
                    “WEPEKA bukan sekadar apparel. Ini adalah cerita yang membawa makna. Makna yang membawa perubahan.
                    Kami tidak hanya menciptakan pakaian. Kami membentuk inovasi, identitas, memicu gerakan, dan membuka
                    jalan untuk masa depan yang berdampak. Ini bukan pilihan. Ini kebutuhan baru.”
                </div>
                <div class="highlight-box">
                    <h2>400+</h2>
                    <p>item WEPEKA telah dipakai. Yuk, bergabung dan jadilah bagian dari inspirasi global.</p>
                </div>
            </div>
            <div class="about-image"></div>
        </div>
    </div>

    {{-- Features Section --}}
    <div class="features-section">
        <div class="features-container">
            <div class="features-title">CARI BAJU MURAH?</div>
            <div class="feature-cards">
                <div class="feature-card bg-blue">
                    <h3>Scannable Tag</h3>
                    <p>Apparel WEPEKA dilengkapi dengan scannable tag yang dapat memuat informasi perusahaan atau organisasi sesuai kebutuhan.</p>
                </div>
                <div class="feature-card bg-green">
                    <h3>Custom Cutting</h3>
                    <p>WEPEKA juga memperhatikan kenyamanan penggunanya. Maka dari itu, kita menyediakan custom cutting (oversized, fit atau loose).</p>
                </div>
                <div class="feature-card bg-red">
                    <h3>Jasa Desain</h3>
                    <p>WEPEKA juga membantu membuat desain lebih menarik dan bagus sesuai dengan kebutuhan.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
