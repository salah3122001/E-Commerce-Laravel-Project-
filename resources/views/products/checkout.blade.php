@extends('layouts.master')
@section('title', __('messages.checkout'))

@section('content')
    <div class="container my-5">
        <h2 class="text-center mb-4">{{ __('messages.checkout') }}</h2>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            <!-- Billing Info -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">{{ __('messages.billing_address') }}</div>
                    <div class="card-body">
                        <form action="{{ route('StoreOrder') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label>{{ __('messages.name') }}</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label>{{ __('messages.email') }}</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label>{{ __('messages.address') }}</label>
                                <input type="text" name="address" class="form-control" value="{{ old('address') }}">
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label>{{ __('messages.phone') }}</label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <h5>{{ __('messages.payment_method') }}</h5>
                            <div class="form-check">
                                <input type="radio" name="payment_method" value="cash" class="form-check-input" checked>
                                <label class="form-check-label">{{ __('messages.cash_on_delivery') }}</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="payment_method" value="card" class="form-check-input">
                                <label class="form-check-label">{{ __('messages.card_payment') }}</label>
                            </div>

                            <div class="mb-3 mt-3">
                                <label>{{ __('messages.note') }}</label>
                                <textarea name="note" class="form-control" rows="3">{{ old('note') }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-success w-100">{{ __('messages.checkout') }}</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Cart Summary -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">{{ __('messages.cart') }}</div>
                    <div class="card-body">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>{{ __('messages.image') }}</th>
                                    <th>{{ __('messages.name') }}</th>
                                    <th>{{ __('messages.qty') }}</th>
                                    <th>{{ __('messages.price') }}</th>
                                    <th>{{ __('messages.total') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($carts as $cart)
                                    <tr>
                                        <td><img src="{{ asset($cart->product->imagePath) }}" width="50"></td>
                                        <td>{{ app()->getLocale() == 'ar' ? $cart->product->name_ar : $cart->product->name_en }}
                                        </td>
                                        <td>{{ $cart->quantity }}</td>
                                        <td>{{ $cart->product->price }} {{ __('messages.egp') }}</td>
                                        <td>{{ $cart->product->price * $cart->quantity }} {{ __('messages.egp') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">{{ __('messages.cart_empty') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-end">{{ __('messages.total') }}</th>
                                    <th>{{ $subtotal }} {{ __('messages.egp') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                        <a href="{{ route('cart') }}" class="btn btn-outline-secondary w-100">←
                            {{ __('messages.backtocart') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
