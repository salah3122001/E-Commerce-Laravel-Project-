@extends('Layouts.master')
@section('title', __('messages.c_and_c'))

@section('css')
    <style>
        .single-product-item {
            transition: transform 0.2s ease;
        }

        .single-product-item:hover {
            transform: translateY(-5px);
        }

        svg {
            height: 40px !important;
        }
    </style>

@endsection
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('status'))
        <div class="alert alert-warning">
            {{ session('status') }}
        </div>
    @endif
    <div class="product-section mt-150 mb-150">
        <div class="container">
            {{-- Title Section --}}
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">{{ __('messages.our') }}</span> {{ __('messages.category') }}</h3>
                        <p>{{ __('messages.Browse categories and discover amazing products.') }}</p>
                    </div>
                </div>
            </div>

            {{-- Categories Grid --}}
            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-lg-4 col-md-6 text-center mb-4">
                        <div class="single-product-item shadow-sm p-3 rounded">
                            <div class="product-image mb-3">
                                <a href="{{ route('cat_prods', $category->id) }}">
                                    <img src="{{ asset($category->imagePath) }}"
                                        alt="{{ app()->getLocale() == 'ar' ? $category->name_en_ar : $category->name_en }}"
                                        class="img-fluid rounded"
                                        style="max-height: 200px; min-height:200px; object-fit: cover;">
                                </a>
                            </div>
                            <h4 class="fw-bold">{{ app()->getLocale() == 'ar' ? $category->name_ar : $category->name_en }}
                            </h4>
                            <p class="text-muted">
                                {{ Str::limit(app()->getLocale() == 'ar' ? $category->description_ar : $category->description_en, 100, '...') }}
                            </p>
                            <a href="{{ route('cat_prods', $category->id) }}" class="btn btn-primary btn-sm mt-2">
                                <i class="fas fa-eye"></i> {{ __('messages.viewproducts') }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $categories->links() }}
            </div>
        </div>
    </div>

    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text"> {{ __('messages.latest_added') }}</span> </h3>
                        <p>{{ __('messages.discover_latest') }}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($products as $product)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="single-product-item card shadow-sm h-100">
                            {{-- صورة المنتج --}}
                            <div class="product-image p-3">
                                <a href="{{ route('ProdutDetails', $product->id) }}">
                                    <img src="{{ url($product->imagePath) }}"
                                        alt="{{ app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en }}"
                                        class="img-fluid rounded"
                                        style="max-height:200px;min-height:200px;object-fit:cover;">
                                </a>
                            </div>

                            {{-- تفاصيل المنتج --}}
                            <div class="card-body text-center">
                                <h5 class="card-title">
                                    {{ app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en }}
                                </h5>

                                <p class="product-price mb-3">
                                    <span class="badge bg-secondary">
                                        {{ $product->quantity }} {{ __('messages.pieceavailable') }}
                                    </span>
                                    <br>
                                    <strong class="text-success">
                                        {{ $product->price }} {{ __('messages.egp') }}
                                    </strong>
                                </p>

                                {{-- Add to cart --}}
                                <form action="{{ route('addcart', $product->id) }}" method="post" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="fas fa-shopping-cart"></i> {{ __('messages.add_to_cart') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection

<style>
    svg {
        height: 40px !important;
    }
</style>
