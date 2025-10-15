@extends('layouts.auth')
@section('title', __('messages.login'))

@section('content')
    <style>
        body {
            background: linear-gradient(135deg, #4e73df 0%, #1cc88a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .auth-card:hover {
            transform: translateY(-3px);
        }

        .card-header {
            background-color: #4e73df;
            color: #fff;
            font-weight: bold;
            font-size: 1.4rem;
            text-align: center;
            padding: 1rem;
        }

        .form-control {
            border-radius: 10px;
            padding: 0.7rem;
        }

        .btn-primary {
            background-color: #1cc88a;
            border: none;
            border-radius: 10px;
            padding: 0.6rem 1.2rem;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #17a673;
            transform: scale(1.03);
        }

        .btn-link {
            color: #4e73df;
            text-decoration: none;
            font-weight: 500;
        }

        .btn-link:hover {
            text-decoration: underline;
        }

        .auth-container {
            width: 100%;
            max-width: 500px;
        }

        .logo {
            width: 80px;
            height: 80px;
            display: block;
            margin: 0 auto 1rem;
        }

        .register-link {
            text-align: center;
            margin-top: 1.2rem;
        }

        .register-link a {
            color: #4e73df;
            font-weight: bold;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .register-link a:hover {
            color: #1cc88a;
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .auth-card {
                margin: 0 1rem;
            }
        }
    </style>

    <div class="auth-container my-5">
        <div class="card auth-card">
            <div class="card-header">

                <img src="{{ asset('assets/img/clickandcollect2.png') }}" alt="Logo"
                    style="max-height: 55px; width: 55px; border-radius: 50%; object-fit: cover;">

                {{ __('messages.login') }}
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('messages.email') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('messages.pass') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required>
                        @error('password')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    {{-- Remember Me --}}
                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('messages.Remember Me') }}
                        </label>
                    </div>

                    {{-- Submit & Forgot --}}
                    <div class="d-flex justify-content-between align-items-center">
                        <button type="submit" class="btn btn-primary">
                            {{ __('messages.login') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn-link" href="{{ route('password.request') }}">
                                {{ __('messages.Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </form>

                {{-- Register Redirect --}}
                @if (Route::has('register'))
                    <div class="register-link">
                        <p>{{ __('messages.no_account') }}
                            <a href="{{ route('register') }}">{{ __('messages.register') ?? 'Register Now' }}</a>
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
