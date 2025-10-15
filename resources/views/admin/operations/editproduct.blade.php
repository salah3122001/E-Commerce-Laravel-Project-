@extends('layouts.parent')
@section('title', {{__('messages.editproduct')}})

@section('content')
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">{{__('messages.updateproduct')}}</span></h3>
                        <p>{{__('messages.Modify product details below and save changes.')}}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="card shadow p-4">
                        <form method="post" enctype="multipart/form-data"
                            action="{{ route('updateproduct', $product->id) }}">
                            @csrf


                            {{-- Product Name En , Ar --}}
                            <div class="row mb-3">
                                <div class="col">
                                     <label for="name_en" class="form-label">{{__('messages.productenglishname')}}</label>
                                <input required type="text" class="form-control" id="name_en" name="name_en"
                                    value="{{ old('name_en', $product->name_en) }}">
                                @error('name_en')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                                <div class="col">
                                    <label for="name_ar" class="form-label">{{__('messages.productarabicname')}} ({{__('messages.optional')}})</label>
                                <input type="text" class="form-control" id="name_ar" name="name_ar"
                                    value="{{ old('name_ar', $product->name_ar) }}">
                                @error('name_ar')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                            </div>


                            {{-- Price & Quantity --}}
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="price" class="form-label">{{__('messages.price')}}</label>
                                    <input required type="number" class="form-control" id="price" name="price"
                                        value="{{ old('price', $product->price) }}">
                                    @error('price')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="quantity" class="form-label">{{__('messages.quantity')}}</label>
                                    <input required type="number" class="form-control" id="quantity" name="quantity"
                                        value="{{ old('quantity', $product->quantity) }}">
                                    @error('quantity')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>


                            {{-- Description --}}
                            <div class="mb-3">
                               <label for="description_en" class="form-label">{{__('messages.description_en')}} ({{__('messages.optional')}})</label>
                                <textarea class="form-control" id="description_en" name="description_en" rows="5">{{ old('description_en', $product->description_en) }}</textarea>
                                @error('description_en')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            {{-- Arabic Description --}}
                            <div class="mb-3">
                                <label for="description_ar" class="form-label">{{__('messages.description_ar')}} ({{__('messages.optional')}})</label>
                                <textarea class="form-control" id="description_ar" name="description_ar" rows="5">{{ old('description_ar', $product->description_ar) }}</textarea>
                                @error('description_ar')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Category --}}
                            <div class="mb-3">
                                <label for="category_id" class="form-label">{{__('messages.category')}}</label>
                                <select name="category_id" id="category_id" class="form-select">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name_en }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Current Image --}}
                            <div class="mb-3">
                                <label class="form-label">{{__("messages.Current Image")}}</label><br>
                                <img src="{{ url($product->imagePath) }}" alt="Product Image" class="img-thumbnail"
                                    style="width:150px; height:150px; object-fit:cover;">
                            </div>

                            {{-- New Image --}}
                            <div class="mb-3">
                                <label for="updatedimage" class="form-label">{{__('messages.Upload New Image')}}</label>
                                <input type="file" name="updatedimage" id="updatedimage" class="form-control">
                                @error('updatedimage')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Submit --}}
                            <div class="d-flex justify-content-between">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> {{__('messages.back')}}
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> {{__('messages.update')}}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
