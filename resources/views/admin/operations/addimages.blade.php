@extends('layouts.parent')
@section('title', __('messages.addimages'))

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container my-4">

        <h5>{{ __('messages.mainimage') }}</h5>
        <img src="{{ asset($product->imagePath) }}" alt="Main Image" class="img-thumbnail mb-3"
            style="width:180px; height:180px; object-fit:cover;">

        <h5>{{ __('messages.otherimages') }}</h5>
        <div class="row g-3">
            @foreach ($productImages as $productImage)
                <div class="col-6 col-md-3 text-center position-relative">

                    {{-- صورة المنتج --}}
                    <img src="{{ asset($productImage->images) }}" alt="Product Image" class="img-thumbnail"
                        style="width:180px; height:180px; object-fit:cover;">

                    {{-- زرار الحذف --}}
                    <a href="{{ route('deleteimage', $productImage->id) }}"
                        class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1" title="Delete">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
            @endforeach
        </div>
    </div>





    <div class="container my-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h6 class="mb-0">{{ __('messages.addmoreimages') }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('storeimages', $product->id) }}" method="post" enctype="multipart/form-data"
                    class="d-flex flex-column flex-md-row align-items-center gap-3">
                    @csrf

                    {{-- Input file --}}
                    <input type="file" name="images[]" multiple class="form-control" style="max-width:300px;">
                    @error('images')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    @error('images.*')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    {{-- Submit button --}}
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Save
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection
