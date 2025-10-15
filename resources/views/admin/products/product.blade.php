@extends('layouts.parent')
@section('title', __('messages.allproducts'))
@section('content')
    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif



    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">{{ __('messages.our') }}</span> {{ __('messages.products') }}</h3>
                        <p>{{ __('messages.Enjoy Shopping Our Products.') }}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($products as $product)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="single-product-item card shadow-sm h-100">
                            {{-- صورة المنتج --}}
                            <div class="product-image p-3">
                                <a href="{{ route('ProdutDetailsforadmin', $product->id) }}">
                                    <img src="{{ url($product->imagePath) }}"
                                        alt="{{ app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en }}"
                                        class="img-fluid rounded"
                                        style="max-height:200px;min-height:200px;object-fit:cover;">
                                </a>
                            </div>

                            {{-- تفاصيل المنتج --}}
                            <div class="card-body text-center">
                                <h5 class="card-title">
                                    {{ app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en }}</h5>
                                <p class="product-price mb-3">
                                    <span class="badge bg-secondary">{{ $product->quantity }}
                                        {{ __('messages.available_qty') }}</span>
                                    <br>
                                    <strong class="text-success">{{ $product->price }} {{ __('messages.egp') }}</strong>
                                </p>

                                {{-- Add to cart --}}
                                <form action="{{ route('addcart', $product->id) }}" method="post" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="fas fa-shopping-cart"></i> {{ __('messages.add_to_cart') }}
                                    </button>
                                </form>

                                {{-- Add images --}}
                                <a href="{{ route('addimages', $product->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-image"></i> {{ __('messages.addimages') }}
                                </a>

                                <div class="mt-3">
                                    {{-- Delete --}}
                                    <a href="{{ route('deleteproduct', $product->id) }}" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this product?');">
                                        <i class="fas fa-trash"></i> {{ __('messages.delete') }}
                                    </a>

                                    {{-- Edit --}}
                                    <a href="{{ route('editproduct', $product->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> {{ __('messages.edit') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{-- Pagination --}}
                <div class="d-flex justify-content-center">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    svg {
        height: 40px !important;
    }
</style>
