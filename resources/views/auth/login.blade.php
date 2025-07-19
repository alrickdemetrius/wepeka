@extends('layouts.app')

@section('content')
    <style>
        html, body {
            height: 100vh;
            margin: 0;
            overflow: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to bottom right, #b4d4d4, #497993);
            transition: background 0.8s ease, filter 0.6s ease;
        }

        body.error-transition {
            background: linear-gradient(to bottom right, #ffbaba, #cc5555);
            filter: blur(0px);
        }

        .login-container {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .fade-in-up {
            opacity: 0;
            transform: translateY(20px);
            filter: blur(10px);
            animation: fadeInUp 0.8s ease-out forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
                filter: blur(0);
            }
        }

        .fade-delay-1 { animation-delay: 0.1s; }
        .fade-delay-2 { animation-delay: 0.3s; }
        .fade-delay-3 { animation-delay: 0.5s; }
        .fade-delay-4 { animation-delay: 0.7s; }
        .fade-delay-5 { animation-delay: 0.9s; }
        .fade-delay-6 { animation-delay: 1.1s; }

        .login-card {
            background: white;
            border-radius: 20px;
            width: 100%;
            max-width: 450px;
            padding: 3rem 2.5rem 2.5rem;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            position: relative;
            margin-top: -130px;
        }

        .logo-container {
            background: white;
            border-radius: 50%;
            padding: 20px;
            position: absolute;
            top: -50px;
            inset-inline: 0;
            margin-inline: auto;
            width: 100px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1;
        }

        .logo-img {
            max-width: 80%;
            max-height: 80%;
            object-fit: contain;
            display: block;
            border-radius: 50%;
        }

        .login-title {
            font-size: 1.4rem;
            font-weight: bold;
            margin-top: 10px;
            margin-bottom: 1.5rem;
            color: #5a8a8a;
        }

        .form-control {
            border-radius: 12px;
            background-color: #89c1c1;
            color: #ffffff;
            font-size: 1rem;
            border: none;
            margin-bottom: 1.2rem;
            padding: 0.75rem;
            transition: background-color 0.3s ease;
        }

        .form-control::placeholder {
            color: #eaf8f8;
        }

        .form-control.error,
        .has-error .form-control {
            background-color: #ff6b6b !important;
            color: #fff;
        }

        .form-control.error::placeholder,
        .has-error .form-control::placeholder {
            color: #fff8f8;
        }

        .btn-login {
            background-color: #2b4c6f;
            color: white;
            border: none;
            border-radius: 15px;
            padding: 0.75rem;
            width: 100%;
            font-size: 1rem;
        }

        .btn-login:hover {
            background-color: #1d3956;
        }

        .has-error .btn-login {
            background-color: #b04141 !important;
        }

        .forgot-password {
            margin-top: 1rem;
            display: block;
            font-size: 0.85rem;
            color: #5e6a72;
            text-decoration: underline;
        }

        .password-toggle {
            color: #ffffff;
            position: absolute;
            right: 15px;
            top: 35%;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .password-toggle i {
            transition: fill 0.3s ease;
        }

        .password-toggle.active i {
            color: #89c1c1;
        }

        .has-error .password-toggle i {
            fill: #fff0f0 !important;
        }

        .has-error .password-toggle.active i {
            fill: #ffb3b3 !important;
        }

        .has-error .login-title {
            color: #b04141 !important;
        }
    </style>

    <div class="login-container">
        <div class="login-card fade-in-up fade-delay-1 @if ($errors->any()) has-error @endif">
            <div class="logo-container fade-in-up fade-delay-2">
                <img src="{{ asset('images/logowepeka_ed.png') }}" alt="Logo" class="logo-img">
            </div>

            <div class="login-title fade-in-up fade-delay-3">
                @if ($errors->any())
                    Wrong username/password. Please try again!
                @else
                    Login to your Account
                @endif
            </div>

            <form method="POST" action="{{ route('login') }}" class="@if ($errors->any()) has-error @endif">
                @csrf

                <input id="email" type="email" name="email" required autofocus
                    placeholder="Email:"
                    value="{{ old('email') }}"
                    class="form-control fade-in-up fade-delay-4 @error('email') error is-invalid @enderror">
                @error('email')
                    <span class="text-danger small d-block">{{ $message }}</span>
                @enderror

                <div style="position: relative;" class="fade-in-up fade-delay-4">
                    <input id="password" type="password" name="password" required
                        placeholder="Password:"
                        class="form-control @error('password') error is-invalid @enderror">
                    <span class="password-toggle" onclick="togglePassword()">
                        <i id="toggleIcon" data-feather="eye-off"></i>
                    </span>
                </div>
                @error('password')
                    <span class="text-danger small d-block">{{ $message }}</span>
                @enderror

                <button type="submit" class="btn-login fade-in-up fade-delay-5">Sign In</button>

                @if (Route::has('password.request'))
                    <a class="forgot-password fade-in-up fade-delay-6" href="{{ route('password.request') }}">
                        Forget Password?
                    </a>
                @endif
            </form>
        </div>
    </div>

    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                document.body.classList.add('error-transition');
            });
        </script>
    @endif

    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        const passwordInput = document.getElementById("password");
        const toggleIcon = document.getElementById("toggleIcon");
        const toggleParent = toggleIcon.parentElement;

        function updateStrokeColor(color) {
            const svg = toggleParent.querySelector("svg");
            if (svg) svg.setAttribute("stroke", color);
        }

        function togglePassword() {
            const isPassword = passwordInput.type === "password";
            passwordInput.type = isPassword ? "text" : "password";
            toggleIcon.setAttribute("data-feather", isPassword ? "eye" : "eye-off");
            toggleParent.classList.toggle("active", isPassword);
            feather.replace();
            setTimeout(() => updateStrokeColor(isPassword ? "#2b4c6f" : "#ffffff"), 0);
        }

        passwordInput.addEventListener("focus", () => {
            toggleParent.classList.add("active");
            updateStrokeColor("#2b4c6f");
        });

        passwordInput.addEventListener("blur", () => {
            toggleParent.classList.remove("active");
            updateStrokeColor("#ffffff");
        });

        document.addEventListener("DOMContentLoaded", () => {
            feather.replace();
            updateStrokeColor("#ffffff");
        });
    </script>
@endsection
