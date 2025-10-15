@extends('layouts.parent')
@section('title', __('messages.category'))

@section('content')

    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif
    <div class="product-section mt-150 mb-150">
        <div class="container">
            {{-- Title Section --}}
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">{{ __('messages.category') }}</span></h3>
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
                                <a href="{{ route('cat_prodsforadmin', $category->id) }}">
                                    <img src="{{ asset($category->imagePath) }}" alt="{{ $category->name_en }}"
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
                            <div class="mt-3">
                                {{-- Delete --}}
                                <a href="{{ route('deletecategory', $category->id) }}" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this category?');">
                                    <i class="fas fa-trash"></i> {{ __('messages.delete') }}
                                </a>

                                {{-- Edit --}}
                                <a href="{{ route('editcategory', $category->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> {{ __('messages.edit') }}
                                </a>
                            </div>
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
@endsection

<style>
    svg {
        height: 40px !important;
    }
</style>
