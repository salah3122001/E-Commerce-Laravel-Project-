    @extends('Layouts.master')
    @section('title', __('messages.cart'))

    @section('content')
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif




        <div class="cart-section mt-150 mb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="cart-table-wrap">
                            <table class="cart-table">
                                <thead class="cart-table-head">
                                    <tr class="table-head-row">
                                        <th class="product-remove">{{ __('messages.Remove From Cart') }}</th>
                                        <th class="product-image">{{ __('messages.image') }}</th>
                                        <th class="product-name">{{ __('messages.name') }}</th>
                                        <th class="product-category">{{ __('messages.category') }}</th>
                                        <th class="product-price">{{ __('messages.price') }}</th>
                                        <th class="product-quantity">{{ __('quantity') }}</th>
                                        <th class="product-total">{{ __('messages.total') }}</th>
                                        <th>{{ __('messages.Update Product Quantity') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($carts as $cart)
                                        <tr>
                                            <td class="product-remove"><a href="{{ route('deletecart', $cart->id) }}"><i
                                                        class="far fa-window-close"></i></a></td>
                                            <td class="product-image">
                                                <a href="{{ route('ProdutDetails', $cart->product->id) }}">
                                                    <img src="{{ asset($cart->product->imagePath) }}" width="60">
                                                </a>

                                            </td>
                                            <td><a
                                                    href="{{ route('ProdutDetails', $cart->product->id) }}">{{ app()->getLocale() == 'ar' ? $cart->product->name_ar : $cart->product->name_en }}</a>
                                            </td>
                                            <td><a
                                                    href="{{ route('cat_prods', $cart->product->category_id) }}">{{ app()->getLocale() == 'ar' ? $cart->product->category->name_ar : $cart->product->category->name_en }}</a>
                                            </td>
                                            <td>{{ $cart->product->price }} {{ __('messages.egp') }}</td>
                                            <td>{{ $cart->quantity }}</td>
                                            <td>{{ $cart->product->price * $cart->quantity }}</td>

                                            <td>
                                                <form action="{{ route('editcart', $cart->id) }}" method="post"
                                                    class="mb-2">
                                                    @csrf
                                                    <div class="input-group input-group-sm" style="max-width: 220px;">
                                                        <input type="number" name="quantity{{ $cart->id }}"
                                                            value="{{ $cart->quantity }}" min="1"
                                                            class="form-control text-center me-2"
                                                            style="min-width: 70px; padding-right: 25px;">
                                                        <button class="btn btn-primary" type="submit"
                                                            title="Update Quantity">
                                                            <i class="fas fa-sync-alt"></i> {{ __('messages.update') }}
                                                        </button>
                                                    </div>

                                                    @error("quantity$cart->id")
                                                        <span class="text-danger small">{{ $message }}</span>
                                                    @enderror
                                                </form>



                                            </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">{{ __('messages.cart_empty') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>

                            </table>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="total-section">
                            <table class="total-table">
                                <thead class="total-table-head">
                                    <tr class="table-total-row">
                                        <th>{{ __('messages.total') }}</th>
                                        <th>{{ __('messages.price') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="total-data">
                                        <td><strong>{{ __('messages.total') }} </strong></td>
                                        <td>{{ $subtotal }} <b>{{ __('messages.egp') }}</b></td>
                                    </tr>


                                </tbody>
                            </table>
                            <div class="cart-buttons">

                                <a href="{{ route('checkout') }}"
                                    class="boxed-btn black">{{ __('messages.checkout') }}</a>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    @endsection
