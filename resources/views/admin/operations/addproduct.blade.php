@extends('layouts.parent')
@section('title', __('messages.createprod'))
@section('content')
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">{{ __('messages.addproduct') }}</span></h3>
                        <p>{{ __('messages.Fill out the form below to add a new product.') }}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="card shadow p-4">
                        <form method="post" enctype="multipart/form-data" action="{{ route('storeproduct') }}">
                            @csrf

                            {{-- Product Name En , Ar --}}
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="name_en" class="form-label">{{ __('messages.productenglishname') }}</label>
                                    <input required type="text" class="form-control" id="name_en" name="name_en"
                                        value="{{ old('name_en') }}">
                                    @error('name_en')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="name_ar" class="form-label">{{ __('messages.productarabicname') }}
                                        ({{ __('messages.optional') }})</label>
                                    <input type="text" class="form-control" id="name_ar" name="name_ar"
                                        value="{{ old('name_ar') }}">
                                    @error('name_ar')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>


                            {{-- Product Name
                            <div class="mb-3">
                                <label for="name_en" class="form-label">Product Name</label>
                                <input required type="text" class="form-control" id="name_en" name="name_en"
                                    value="{{ old('name_en') }}" placeholder="Enter product name">
                                @error('name_en')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div> --}}

                            {{-- Price & Quantity --}}
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="price" class="form-label">{{ __('messages.price') }}</label>
                                    <input required type="number" class="form-control" id="price" name="price"
                                        value="{{ old('price') }}">
                                    @error('price')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="quantity" class="form-label">{{ __('messages.quantity') }}</label>
                                    <input required type="number" class="form-control" id="quantity" name="quantity"
                                        value="{{ old('quantity') }}">
                                    @error('quantity')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Description --}}
                            <div class="mb-3">
                                <label for="description_en" class="form-label">{{ __('messages.description_en') }}
                                    ({{ __('messages.optional') }})</label>
                                <textarea name="description_en" id="description_en" class="form-control" rows="5">{{ old('description_en') }}</textarea>
                                @error('description_en')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            {{-- Arabic Description --}}
                            <div class="mb-3">
                                <label for="description_ar" class="form-label">{{ __('messages.description_ar') }}
                                    ({{ __('messages.optional') }})</label>
                                <textarea name="description_ar" id="description_ar" class="form-control" rows="5">{{ old('description_ar') }}</textarea>
                                @error('description_ar')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Category --}}
                            <div class="mb-3">
                                <label for="category_id" class="form-label">{{ __('messages.category') }}</label>
                                <select name="category_id" id="category_id" class="form-select">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ app()->getLocale() == 'ar' ? $category->name_ar : $category->name_en }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Product Image --}}
                            <div class="mb-3">
                                <label for="image" class="form-label">{{ __('messages.image') }}</label>
                                <input required type="file" name="image" id="image" class="form-control">
                                @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Submit --}}
                            <div class="d-flex justify-content-between">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> {{ __('messages.back') }}
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-plus-circle"></i> {{ __('messages.addproduct') }}
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
