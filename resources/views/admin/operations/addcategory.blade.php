@extends('layouts.parent')
@section('title', __('messages.createcategory'))

@section('content')


    <div class="category-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">{{ __('messages.addcategory') }}</span></h3>
                        <p>{{ __('messages.Fill out the form below to add a new category.') }}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="card shadow p-4">
                        <form method="post" enctype="multipart/form-data" action="{{ route('storecategory') }}">
                            @csrf
                            {{-- Category Name En , Ar --}}
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="name_en"
                                        class="form-label">{{ __('messages.categoryenglishname') }}</label>
                                    <input required type="text" class="form-control" id="name_en" name="name_en"
                                        value="{{ old('name_en') }}">
                                    @error('name_en')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col">
                                    <label for="name_ar" class="form-label">{{ __('messages.categoryarabicname') }}
                                        ({{ __('messages.optional') }})</label>
                                    <input type="text" class="form-control" id="name_ar" name="name_ar"
                                        value="{{ old('name_ar') }}">
                                    @error('name_ar')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>



                            {{-- Description --}}
                            <div class="mb-3">
                                <label for="description_en" class="form-label">{{ __('messages.description_en') }}
                                    ({{ __('messages.optional') }})
                                    ({{ __('messages.optional') }})</label>
                                <textarea class="form-control" id="description_en" name="description_en" rows="5">{{ old('description_en') }}</textarea>
                                @error('description_en')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            {{-- Arabic Description --}}
                            <div class="mb-3">
                                <label for="description_ar" class="form-label">{{ __('messages.description_ar') }}
                                    ({{ __('messages.optional') }})
                                    ({{ __('messages.optional') }})</label>
                                <textarea class="form-control" id="description_ar" name="description_ar" rows="5">{{ old('description_ar') }}</textarea>
                                @error('description_ar')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Category Image --}}
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
                                    <i class="fas fa-plus-circle"></i> {{ __('messages.addcategory') }}
                                </button>
                            </div>
                        </form>

                    @endsection
