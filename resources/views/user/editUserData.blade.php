@extends('layouts.master')
@section('title', __('edituserdata'))
@section('content')

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>{{ __('messages.updateprofile') }}</h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('updateProfile', $user->id) }}" method="post">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold">{{ __('messages.name') }}</label>
                                <input required type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $user->name) }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold">{{ __('messages.email') }}</label>
                                <input required type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email', $user->email) }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label fw-bold">{{ __('messages.newpass') }}</label>
                                <input required type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation"
                                    class="form-label fw-bold">{{ __('messages.confirmpass') }}</label>
                                <input required type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation">
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">{{ __('messages.update') }}</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>


    </div>
@endsection
