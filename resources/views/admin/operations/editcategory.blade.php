@extends('layouts.parent')
@section('title', __('messages.editcategory'))

@section('content')
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">{{ __('messages.updateproduct') }}</span></h3>
                        <p>{{ __('messages.Modify product details below and save changes.') }}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="card shadow p-4">
                        <form method="post" enctype="multipart/form-data"
                            action="{{ route('updatecategory', $category->id) }}">
                            @csrf


                            {{-- Product Name En , Ar --}}
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="name_en"
                                        class="form-label">{{ __('messages.categoryenglishname') }}</label>
                                    <input required type="text" class="form-control" id="name_en" name="name_en"
                                        value="{{ old('name_en', $category->name_en) }}">
                                    @error('name_en')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="name_ar" class="form-label">{{ __('messages.categoryarabicname') }}
                                        ({{ __('messages.optional') }})</label>
                                    <input type="text" class="form-control" id="name_ar" name="name_ar"
                                        value="{{ old('name_ar', $category->name_ar) }}">
                                    @error('name_ar')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>




                            {{-- Description --}}
                            <div class="mb-3">
                                <label for="description_en" class="form-label">{{ __('messages.description_en') }}
                                    ({{ __('messages.optional') }})</label>
                                <textarea class="form-control" id="description_en" name="description_en" rows="5">{{ old('description_en', $category->description_en) }}</textarea>
                                @error('description_en')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            {{-- Arabic Description --}}
                            <div class="mb-3">
                                <label for="description_ar" class="form-label">{{ __('messages.description_ar') }}
                                    ({{ __('messages.optional') }})</label>
                                <textarea class="form-control" id="description_ar" name="description_ar" rows="5">{{ old('description_ar', $category->description_ar) }}</textarea>
                                @error('description_ar')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            {{-- Current Image --}}
                            <div class="mb-3">
                                <label class="form-label">{{ __('messages.Current Image') }}</label><br>
                                <img src="{{ url($category->imagePath) }}" alt="Product Image" class="img-thumbnail"
                                    style="width:150px; height:150px; object-fit:cover;">
                            </div>

                            {{-- New Image --}}
                            <div class="mb-3">
                                <label for="updatedimage" class="form-label">{{ __('messages.Upload New Image') }}</label>
                                <input type="file" name="updatedimage" id="updatedimage" class="form-control">
                                @error('updatedimage')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Submit --}}
                            <div class="d-flex justify-content-between">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> {{ __('messages.back') }}
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> {{ __('messages.update') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
