@extends('layouts.auth')

@section('title', __('messages.Verify Your Email Address'))

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
            max-width: 600px;
            width: 100%;
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

        .card-body {
            padding: 2rem;
            text-align: center;
            font-size: 1.1rem;
        }

        .btn-primary {
            background-color: #1cc88a;
            border: none;
            border-radius: 10px;
            padding: 0.6rem 1.2rem;
            font-weight: bold;
            transition: all 0.3s ease;
            margin-top: 1rem;
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
    </style>

    <div class="auth-card">
        <div class="card-header">
            {{ __('messages.Verify Your Email Address') }}
        </div>

        <div class="card-body">
            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('messages.A fresh verification link has been sent to your email address.') }}
                </div>
            @endif

            <p>{{ __('messages.Before proceeding, please check your email for a verification link.') }}</p>
            <p>{{ __('messages.If you did not receive the email') }},</p>

            <form method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-primary">
                    {{ __('messages.click here to request another') }}
                </button>
            </form>

            <hr>

            <a href="{{ route('mainPage') }}" class="btn-link d-block mt-3">
                ← {{ __('messages.backtomainpage') }}
            </a>
        </div>
    </div>
@endsection
