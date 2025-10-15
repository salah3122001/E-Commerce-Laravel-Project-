@extends('layouts.parent')
@section('title', __('messages.prod_details'))

@section('content')
    <style>
        /* ====== عام ====== */
        .single-product,
        .more-products {
            margin-top: 80px;
            margin-bottom: 100px;
        }

        h2,
        h3,
        h5 {
            font-weight: 700;
        }

        .text-success {
            color: #28a745 !important;
        }

        /* ====== قسم المنتج الرئيسي ====== */
        .single-product .card {
            border-radius: 12px;
        }

        .single-product-img {
            border-radius: 12px;
            height: 400px;
            object-fit: cover;
        }

        .single-product .btn {
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .single-product .btn:hover {
            transform: translateY(-3px);
            opacity: 0.9;
        }

        /* ====== صور إضافية ====== */
        .single-product .img-thumbnail {
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .single-product .img-thumbnail:hover {
            transform: scale(1.05);
        }

        /* ====== الأزرار ====== */
        .single-product .row a.btn {
            width: auto;
            min-width: 130px;
            margin-right: 10px;
            margin-top: 10px;
        }

        /* ====== قسم المنتجات المشابهة ====== */
        .more-products {
            background: #fafafa;
            padding: 80px 0;
            border-top: 1px solid #e0e0e0;
        }

        .more-products .section-title h3 {
            font-weight: 700;
            color: #333;
        }

        .more-products .section-title p {
            color: #777;
            font-size: 15px;
        }

        .card.transition-all {
            transition: all 0.3s ease-in-out;
            border-radius: 12px;
        }

        .card.transition-all:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
        }

        .card-img-top {
            height: 230px;
            object-fit: cover;
            border-radius: 12px 12px 0 0;
            transition: transform 0.3s ease;
        }

        .card:hover img {
            transform: scale(1.05);
        }

        [dir="rtl"] .card-body {
            text-align: right;
        }

        /* ====== المشاركة ====== */
        .btn-outline-primary,
        .btn-outline-info,
        .btn-outline-secondary,
        .btn-outline-success {
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* ====== تحسين التباعد ====== */
        .card-body h6 {
            font-weight: 600;
            font-size: 15px;
        }

        .card-body p {
            font-size: 14px;
        }

        /* متجاوب */
        @media (max-width: 767px) {
            .single-product-img {
                height: 300px;
            }

            .single-product .btn-lg {
                font-size: 14px;
                padding: 10px;
            }
        }
    </style>

    <!-- single product -->
    <div class="single-product">
        <div class="container">
            <div class="row g-4 align-items-start">
                {{-- صورة المنتج --}}
                <div class="col-md-5">
                    <div class="card shadow-sm border-0">
                        <img src="{{ asset($product->imagePath) }}" alt="{{ $product->name_en }}"
                            class="card-img-top img-fluid single-product-img">
                    </div>
                </div>

                {{-- تفاصيل المنتج --}}
                <div class="col-md-7">
                    <div class="card shadow-sm border-0 p-4 h-100">
                        <h2 class="fw-bold mb-3">
                            {{ app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en }}
                        </h2>

                        <p class="fs-5 text-success fw-bold mb-3">
                            💰 {{ $product->price }} {{ __('messages.egp') }}
                        </p>

                        <p class="mb-2">
                            <b>{{ __('messages.description') }}:</b>
                            {{ app()->getLocale() == 'ar' ? $product->description_ar : $product->description_en }}
                        </p>

                        <p class="mb-4">
                            <b>{{ __('messages.available_qty') }}</b>
                            <span class="badge bg-secondary">
                                {{ $product->quantity }} {{ __('messages.pieceavailable') }}
                            </span>
                        </p>

                        {{-- Add to cart --}}
                        <form action="{{ route('addcart', $product->id) }}" method="post" class="mb-3">
                            @csrf
                            <button type="submit" class="btn btn-lg btn-primary w-100">
                                <i class="fas fa-shopping-cart"></i>
                                {{ __('messages.add_to_cart') }}
                            </button>
                        </form>

                        <p>
                            <strong>{{ __('messages.category') }}: </strong>
                            <a href="{{ route('cat_prods', $product->category_id) }}" class="text-decoration-none">
                                {{ app()->getLocale() == 'ar' ? $product->category->name_ar : $product->category->name_en }}
                            </a>
                        </p>

                        {{-- صور إضافية --}}
                        <div class="row g-3 mt-3">
                            @foreach ($product->images as $image)
                                <div class="col-6 col-md-3 text-center position-relative">
                                    <img src="{{ asset($image->images) }}" alt="Product Image" class="img-thumbnail"
                                        style="width:100%; height:180px; object-fit:cover;">
                                </div>
                            @endforeach
                        </div>

                        {{-- أزرار العمليات --}}
                        <div class="row mt-4">
                            <div class="col d-flex flex-wrap gap-2">
                                <a href="{{ route('addimages', $product->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-image"></i> {{ __('messages.addimages') }}
                                </a>

                                <a href="{{ route('deleteproduct', $product->id) }}" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this product?');">
                                    <i class="fas fa-trash"></i> {{ __('messages.delete') }}
                                </a>

                                <a href="{{ route('editproduct', $product->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> {{ __('messages.edit') }}
                                </a>
                            </div>
                        </div>

                        {{-- روابط المشاركة --}}
                        <div class="mt-4">
                            <h5>{{ __('messages.Share this product:') }}</h5>
                            <div class="d-flex gap-2">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::fullUrl()) }}"
                                    target="_blank" class="btn btn-sm btn-outline-primary rounded-circle">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(Request::fullUrl()) }}"
                                    target="_blank" class="btn btn-sm btn-outline-info rounded-circle">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(Request::fullUrl()) }}"
                                    target="_blank" class="btn btn-sm btn-outline-secondary rounded-circle">
                                    <i class="fab fa-linkedin"></i>
                                </a>
                                <a href="https://api.whatsapp.com/send?text={{ urlencode(Request::fullUrl()) }}"
                                    target="_blank" class="btn btn-sm btn-outline-success rounded-circle">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- related products -->
    <div class="more-products">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title mb-5">
                        <h3><span class="orange-text">{{ __('messages.related_products') }}</span></h3>
                        <p>{{ __('messages.similar_products') }}</p>
                    </div>
                </div>
            </div>

            <div class="row g-4 justify-content-center">
                @foreach ($relatedProducts as $relatedProduct)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 d-flex">
                        <div class="card shadow-sm border-0 h-100 w-100 text-center transition-all">
                            <a href="{{ route('ProdutDetailsforadmin', $relatedProduct->id) }}" class="d-block">
                                <img src="{{ url($relatedProduct->imagePath) }}" alt="{{ $relatedProduct->name_en }}"
                                    class="card-img-top">
                            </a>

                            <div class="card-body d-flex flex-column justify-content-between">
                                <h6 class="card-title fw-bold mb-2" style="min-height: 40px;">
                                    <a href="{{ route('ProdutDetailsforadmin', $relatedProduct->id) }}"
                                        class="text-dark text-decoration-none">
                                        {{ app()->getLocale() == 'ar' ? $relatedProduct->name_ar : $relatedProduct->name_en }}
                                    </a>
                                </h6>

                                <p class="small text-muted mb-1">
                                    {{ $relatedProduct->quantity }} {{ __('messages.pieceavailable') }}
                                </p>

                                <p class="text-success fw-bold mb-3">
                                    {{ $relatedProduct->price }} {{ __('messages.egp') }}
                                </p>

                                <form action="{{ route('addcart', $relatedProduct->id) }}" method="post" class="mt-auto">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary w-100">
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
