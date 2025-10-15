@extends('layouts.master')
@section('title', __('messages.profile'))

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>{{ __('messages.userprofile') }}</h4>
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <label class="fw-bold text-muted">Name:</label>
                            <p class="fs-5">{{ $user->name }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold text-muted">Email:</label>
                            <p class="fs-5">{{ $user->email }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold text-muted">Orders Count:</label>
                            <span class="badge bg-info fs-6">{{ $order }}</span>
                        </div>

                        <div class="text-center mt-4">
                            <a href="{{ route('editProfile', $user->id) }}" class="btn btn-warning px-4">
                                <i class="fas fa-edit me-2"></i>{{ __('messages.edit') }}
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
