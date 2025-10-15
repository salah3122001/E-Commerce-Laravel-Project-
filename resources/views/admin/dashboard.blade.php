@extends('layouts.parent')
@section('title', __('messages.dashboard'))
@section('content')
    @if (session('status'))
        <div class="alert alert-warning">
            {{ session('status') }}
        </div>
    @endif

    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <a href="{{ route('recentorders') }}" class="small-box-footer">
                    <div class="inner">
                        <h3>{{ $ordersCount }}</h3>
                        <p>{{ __('messages.neworders') }}</p>
                    </div>
                </a>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{ route('recentorders') }}" class="small-box-footer">{{ __('messages.moreinfo') }} <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <a href="{{ route('categoriesforadmin') }}">
                    <div class="inner">
                        <h3>{{ $categoriesCount }}</h3>
                        <p>{{ __('messages.category') }}</p>
                    </div>
                </a>

                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ route('categoriesforadmin') }}" class="small-box-footer">{{ __('messages.moreinfo') }} <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <a href="{{ route('getUsers') }}">
                    <div class="inner">
                        <h3>{{ $usersCount }}</h3>
                        <p>{{ __('messages.user_reg') }}</p>
                    </div>
                </a>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">{{ __('messages.moreinfo') }} <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <a href="{{ route('charts') }}">
                    <div class="inner">
                        <h3>{{ __('messages.charts') }}</h3>
                        <p>{{ __('messages.prod_solds') }}</p>
                    </div>
                </a>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">{{ __('messages.moreinfo') }} <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>



@endsection
