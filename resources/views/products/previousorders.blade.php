@extends('layouts.master')
@section('title', __('messages.previous_orders'))
@section('content')
    <div class="container mt-5 mb-5">
        <h2 class="text-center mb-4">{{ __('messages.previous_orders') }}</h2>


        @forelse ($orders as $order)
            <div class="card shadow-lg mb-4">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <span>Order #{{ $order->id }}</span>
                    <small>{{ $order->created_at->format('d M, Y h:i A') }}</small>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h5 class="mb-2">{{ __('messages.cust_info') }}</h5>
                        <p><strong>{{ __('messages.name') }}:</strong> {{ $order->name }}</p>
                        <p><strong>{{ __('messages.email') }}:</strong> {{ $order->email }}</p>
                        <p><strong>{{ __('messages.phone') }}:</strong> {{ $order->phone }}</p>
                        <p><strong>{{ __('messages.address') }}:</strong> {{ $order->address }}</p>
                        @if ($order->note)
                            <p><strong>{{ __('messages.note') }}:</strong> {{ $order->note }}</p>
                        @endif
                    </div>

                    <h5 class="mb-3">{{ __('messages.products') }}</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle text-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th>{{ __('messages.image') }}</th>
                                    <th>{{ __('messages.name') }}</th>
                                    <th>{{ __('messages.category') }}</th>
                                    <th>{{ __('messages.price') }}</th>
                                    <th>{{ __('messages.quantity') }}</th>
                                    <th>{{ __('messages.total') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($order->order_details as $detail)
                                    <tr>
                                        <td>
                                            <a href="{{ route('ProdutDetails', $detail->product->id) }}">
                                                <img src="{{ asset($detail->product->imagePath) }}" width="60"
                                                    class="img-thumbnail">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('ProdutDetails', $detail->product->id) }}">
                                                {{ app()->getLocale() == 'ar' ? $detail->product->name_ar : $detail->product->name_en }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('cat_prods', $detail->product->category_id) }}">
                                                {{ app()->getLocale() == 'ar' ? $detail->product->category->name_ar : $detail->product->category->name_en }}
                                            </a>
                                        </td>
                                        <td>{{ $detail->price }} {{ __('messages.egp') }}</td>
                                        <td>{{ $detail->quantity }}</td>
                                        <td class="text-success"><b>{{ $detail->price * $detail->quantity }} EGP</b></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">No products in this order</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" class="text-right"><strong>{{ __('messages.total') }}:</strong></td>
                                    <td class="text-danger">
                                        <strong>
                                            {{ $order->order_details->sum(fn($d) => $d->price * $d->quantity) }} EGP
                                        </strong>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-info text-center">
                {{ __('messages.You have no previous orders yet.') }}
            </div>
        @endforelse
    </div>
@endsection
