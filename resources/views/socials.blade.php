@extends('layouts.app')

@section('content')
    <div class="bg-light min-vh-100 d-flex align-items-center justify-content-center">
        <section class="instagram-section py-5" style="background-color: white;">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="mb-3">HEADER</h2>
                    <p class="lead">Check out our latest posts on Instagram
                        <a href="https://instagram.com/wepeka.apparel" target="_blank"
                            class="text-decoration-none">@wepeka.apparel</a>
                    </p>
                </div>

                <!-- embed post di sini -->
                <div class="row justify-content-center">
                    <div class="col-md-4 mb-4">
                        <!-- Post/Reel 1 -->
                        <blockquote class="instagram-media"
                            data-instgrm-permalink="https://www.instagram.com/p/DLj9ccaJ_HA/" data-instgrm-version="14"
                            style="background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:100%; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);">
                        </blockquote>
                    </div>
                    <div class="col-md-4 mb-4">
                        <!-- Post/Reel 2 -->
                        <blockquote class="instagram-media"
                            data-instgrm-permalink="https://www.instagram.com/p/DLOdRB_px1X/" data-instgrm-version="14"
                            style="background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:100%; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);">
                        </blockquote>
                    </div>
                    <div class="col-md-4 mb-4">
                        <!-- Post/Reel 3 -->
                        <blockquote class="instagram-media"
                            data-instgrm-permalink="https://www.instagram.com/p/DLeA15FJx6V/" data-instgrm-version="14"
                            style="background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:100%; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);">
                        </blockquote>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="https://instagram.com/wepeka.apparel" target="_blank" class="btn btn-outline-dark">
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