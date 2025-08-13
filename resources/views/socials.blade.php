@extends('layouts.app')

@section('content')

    <style>
        .socials-section {
            text-align: center;
            margin-bottom: 3rem;
            animation: fadeInDown 0.6s ease-in-out;
        }

        .socials-section h2 {
            margin-bottom: 2rem;
            color: white;
            position: relative;
            display: inline-block;
        }


        .instagram-section .instagram-media {
            max-width: 280px !important;
            /* Lebar lebih kecil */
            min-width: auto !important;
            height: 400px;
            transform: scale(0.85);
            /* Mengecilkan proporsional */
            transform-origin: top center;
            /* Titik pengecilan dari atas */
            margin: 0 auto;
        }
    </style>
    <div style="
            background: url('{{ asset('images/blur_socials.jpg') }}') no-repeat center center;
            background-size: cover;
            min-height: 100vh;
        " class="d-flex flex-column align-items-center justify-content-start">

        <!-- Judul mirip FAQ -->
        <div class="container mt-5">
            <h2 class="fw-bold" style="color: white; margin-left: 200px; font-size: 5rem; position: relative; top: 50px;">
                Socials
            </h2>
        </div>

        <section class="instagram-section py-4"
            style="background-color: #542E3F; border-radius: 12px; color: #EFDAC8; padding: 20px 0;  margin-top: 60px;">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="mb-3 fw-bold">Recent Post</h2>
                    <p class="lead">Check out our latest posts on Instagram
                        <a href="https://instagram.com/wepeka.apparel" target="_blank" class="text-decoration-none"
                            style="color: #EFDAC8;">@wepeka.apparel</a>
                    </p>
                </div>

                <!-- embed post di sini -->
                <div class="row justify-content-center">
                    <div class="col-md-4 mb-4">
                        <!-- Post/Reel 1 -->
                        <blockquote class="instagram-media"
                            data-instgrm-permalink="https://www.instagram.com/p/DLj9ccaJ_HA/" data-instgrm-version="14"
                            style="background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:100%; min-width:326px; padding:0;">
                        </blockquote>
                    </div>
                    <div class="col-md-4 mb-4">
                        <!-- Post/Reel 2 -->
                        <blockquote class="instagram-media"
                            data-instgrm-permalink="https://www.instagram.com/p/DLOdRB_px1X/" data-instgrm-version="14"
                            style="background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:100%; min-width:326px; padding:0;">
                        </blockquote>
                    </div>
                    <div class="col-md-4 mb-4">
                        <!-- Post/Reel 3 -->
                        <blockquote class="instagram-media"
                            data-instgrm-permalink="https://www.instagram.com/p/DLeA15FJx6V/" data-instgrm-version="14"
                            style="background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:100%; min-width:326px; padding:0;">
                        </blockquote>
                    </div>

                </div>

                <div class="text-center">
                    <a href="https://instagram.com/wepeka.apparel" target="_blank" class="btn"
                        style="border-color: #EFDAC8; color: #EFDAC8;">
                        <i class="fab fa-instagram me-2"></i> Follow Us on Instagram
                    </a>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script async src="https://www.instagram.com/embed.js"></script>
@endsection