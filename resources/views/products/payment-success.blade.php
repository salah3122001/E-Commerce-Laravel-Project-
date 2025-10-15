@extends('Layouts.master')
@section('title', __('messages.payment_success'))

@section('content')
    <div class="mb-4">
        <i class="fas fa-check-circle text-success" style="font-size: 80px;"></i>
    </div>

    <h2 class="text-success fw-bold mb-3">{{ __('messages.payment_success') }}✅</h2>

    <p class="lead text-muted mb-4">
        {{ __('messages.payment_thank_you') }}
    </p>

    <div class="row justify-content-center text-start">
        <div class="col-md-8">
            <div class="border rounded p-4 bg-light">
                <h5 class="mb-3">{{ __('messages.order_details') }}</h5>
                <ul class="list-unstyled">
                    <li><strong>{{ __('messages.ordernum') }}</strong> #{{ $order->id ?? '—' }}</li>
                    <li><strong>{{ __('messages.name') }}</strong> {{ $order->name ?? Auth::user()->name }}</li>
                    <li><strong>{{ __('messages.payment_method') }}</strong> {{ ucfirst($order->payment_method ?? 'Card') }}
                    </li>
                    <li>
                        <strong>{{ __('messages.status') }}</strong>
                        <span class="badge {{ $badgeClass }}">
                            {{ __('messages.' . $paidOrNot) }}
                        </span>
                    </li>


                </ul>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <a href="{{ route('mainPage') }}" class="btn btn-primary px-4 py-2">
            <i class="fas fa-store me-2"></i> {{ __('messages.backtomainpage') }}
        </a>
    </div>

    </div>
    </div>
    </div>
@endsection
