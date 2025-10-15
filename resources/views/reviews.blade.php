@extends('layouts.master')
@section('title', __('messages.clients_reviews'))

@section('content')
    @if (session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    {{-- Add Review --}}
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">{{ __('messages.clients_reviews') }}</span></h3>

                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-lg p-4">
                        <h5 class="mb-4 text-center">{{ __('messages.leavereview') }}</h5>
                        @if (auth()->check())
                            <form method="post" enctype="multipart/form-data" action="{{ route('storereviews') }}">
                                @csrf



                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control" placeholder="{{ __('messages.phone') }}"
                                            name="phone" value="{{ old('phone') }}" required>
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control"
                                            placeholder="{{ __('messages.subject') }}" name="subject"
                                            value="{{ old('subject') }}" required>
                                        @error('subject')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control" name="message" rows="5" placeholder="{{ __('messages.message') }}" required>{{ old('message') }}</textarea>
                                    @error('message')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">{{ __('messages.Upolad Image') }}
                                        <b>({{ __('messages.optional') }})</b></label>
                                    <input type="file" name="image" class="form-control">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="text-center">
                                    <button type="submit"
                                        class="btn btn-primary px-5">{{ __('messages.submitreview') }}</button>
                                </div>
                            </form>
                        @else
                            <form method="post" enctype="multipart/form-data" action="{{ route('storereviews') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control" placeholder="Name" name="name"
                                            value="{{ old('name') }}" required>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="email" class="form-control" placeholder="Email" name="email"
                                            value="{{ old('email') }}" required>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control" placeholder="Phone" name="phone"
                                            value="{{ old('phone') }}" required>
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control" placeholder="Subject" name="subject"
                                            value="{{ old('subject') }}" required>
                                        @error('subject')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="mb-3">
                                    <textarea class="form-control" name="message" rows="5" placeholder="Message" required>{{ old('message') }}</textarea>
                                    @error('message')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="mb-3">
                                    <label class="form-label">Upload Your Image <b>(Optinal)</b></label>
                                    <input type="file" name="image" class="form-control">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary px-5">Submit Review</button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Show Reviews --}}
    <div class="testimonail-section mt-80 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 text-center">
                    <h3 class="mb-5">{{ __('messages.What Our Clients Say') }}</h3>
                    <div class="testimonial-sliders">
                        @foreach ($reviews as $review)
                            <div class="single-testimonial-slider card shadow-sm p-4 mb-4">
                                <div class="client-avater mb-3">
                                    <img src="{{ asset($review->image) }}" alt="{{ $review->name }}"
                                        class="rounded-circle shadow" style="width:90px; height:90px; object-fit:cover;">
                                </div>
                                <div class="client-meta">
                                    <h5>{{ $review->name }} <span class="text-muted">({{ $review->subject }})</span></h5>
                                    <p class="testimonial-body fst-italic text-muted">
                                        "{{ $review->message }}"
                                    </p>
                                    <div class="last-icon text-primary">
                                        <i class="fas fa-quote-right fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
