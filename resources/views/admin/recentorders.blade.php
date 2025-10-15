@extends('layouts.parent')
@section('title', __('messages.recent_orders'))



@section('content')
    <div class="card mt-4">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title">{{ __('messages.recent_orders') }}</h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>{{ __('messages.user') }}</th>
                        <th>{{ __('messages.email') }}</th>
                        <th>{{ __('messages.total') }}</th>
                        <th>{{ __('messages.date') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentOrders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->user->email }}</td>
                            <td>
                                {{ $order->order_details->sum(fn($d) => $d->price * $d->quantity) }}
                                {{ __('messages.egp') }}
                            </td>

                            <td>{{ $order->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">{{ __('messages.No orders found') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
