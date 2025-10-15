@extends('layouts.master')
@section('title', __('messages.prod_details'))

@section('content')
    <!-- single product -->
    <div class="single-product mt-150 mb-150">
        <div class="container">
            <div class="row g-4">
                {{-- صورة المنتج --}}
                <div class="col-md-5">
                    <div class="card shadow-sm border-0">
                        <img src="{{ asset($product->imagePath) }}"
                            alt="{{ app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en }}"
                            class="card-img-top img-fluid single-product-img">
                    </div>
                </div>

                {{-- تفاصيل المنتج --}}
                <div class="col-md-7">
                    <div class="card shadow-sm border-0 p-4 h-100">
                        <h2 class="fw-bold mb-3">{{ app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en }}
                        </h2>
                        <p class="fs-5 text-success fw-bold mb-3">💰 {{ $product->price }} {{ __('messages.egp') }}</p>

                        <p class="mb-2"><b>{{ __('messages.description') }}:</b>
                            {{ app()->getLocale() == 'ar' ? $product->description_ar : $product->description_en }}</p>
                        <p class="mb-4"><b>{{ __('messages.available_qty') }}</b>
                            <span class="badge bg-secondary">{{ $product->quantity }}
                                {{ __('messages.pieceavailable') }}</span>
                        </p>

                        {{-- Add to cart --}}
                        <form action="{{ route('addcart', $product->id) }}" method="post" class="mb-3">
                            @csrf
                            <button type="submit" class="btn btn-lg btn-primary w-100">
                                <i class="fas fa-shopping-cart"></i> {{ __('messages.add_to_cart') }}
                            </button>
                        </form>

                        <p><strong>{{ __('messages.category') }}: </strong>
                            <a href="{{ route('cat_prods', $product->category_id) }}" class="text-decoration-none">
                                {{ app()->getLocale() == 'ar' ? $product->category->name_ar : $product->category->name_en }}
                            </a>
                        </p>

                        <div class="row g-3">
                            @foreach ($product->images as $image)
                                <div class="col-6 col-md-3 text-center position-relative">

                                    {{-- صورة المنتج --}}
                                    <img src="{{ asset($image->images) }}" alt="Product Image" class="img-thumbnail"
                                        style="width:180px; height:180px; object-fit:cover;">


                                </div>
                            @endforeach
                        </div>

                        {{-- Social Share --}}
                        <div class="mt-4">
                            <h5>{{ __('messages.Share this product:') }}</h5>
                            <div class="d-flex gap-2">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::fullUrl()) }}&quote={{ app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en }}"
                                    target="_blank" class="btn btn-sm btn-outline-primary rounded-circle">
                                    <i class="fab fa-facebook-f"></i>
                                </a>

                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(Request::fullUrl()) }}&text={{ app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en }}"
                                    target="_blank" class="btn btn-sm btn-outline-info rounded-circle">
                                    <i class="fab fa-twitter"></i>
                                </a>

                                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(Request::fullUrl()) }}&title={{ app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en }}"
                                    target="_blank" class="btn btn-sm btn-outline-secondary rounded-circle">
                                    <i class="fab fa-linkedin"></i>
                                </a>

                                <a href="https://api.whatsapp.com/send?text={{ urlencode((app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en) . ' ' . Request::fullUrl()) }}"
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
    <!-- end single product -->


    <!-- related products -->
    <div class="more-products mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">{{ __('messages.related_products') }}</span></h3>
                        <p>{{ __('messages.similar_products') }}</p>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                @foreach ($relatedProducts as $relatedProduct)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="card shadow-sm border-0 h-100 product-card">
                            <a href="{{ route('ProdutDetails', $relatedProduct->id) }}" class="d-block">
                                <img src="{{ url($relatedProduct->imagePath) }}"
                                    alt="{{ app()->getLocale() == 'ar' ? $relatedProduct->name_ar : $relatedProduct->name_en }}"
                                    class="card-img-top img-fluid product-img">
                            </a>
                            <div class="card-body text-center">
                                <h6 class="card-title fw-bold">
                                    <a href="{{ route('ProdutDetails', $relatedProduct->id) }}"
                                        class="text-dark text-decoration-none">
                                        {{ app()->getLocale() == 'ar' ? $relatedProduct->name_ar : $relatedProduct->name_en }}
                                    </a>
                                </h6>
                                <p class="small text-muted mb-2">
                                    {{ $relatedProduct->quantity }} {{ __('messages.pieceavailable') }}
                                </p>
                                <p class="text-success fw-bold">{{ $relatedProduct->price }} {{ __('messages.egp') }}</p>

                                <form action="{{ route('addcart', $relatedProduct->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-primary w-100">
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
    <!-- end related products -->



@endsection
