<!-- DataTables Bootstrap 5 CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.bootstrap5.min.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- DataTables JS + Bootstrap 5 -->
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.bootstrap5.min.js"></script>

@extends('layouts.master')
@section('title', __('messages.prod_table'))

@section('content')
    <div class="container mt-5">
        <h3 class="mb-4 text-center text-primary">📦 {{ __('messages.products') }}</h3>

        <div class="card shadow-lg">
            <div class="card-body">
                <table id="myTable" class="table table-striped table-hover align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>{{ __('messages.name') }}</th>
                            <th style="width: 25%">{{ __('messages.description') }}</th>
                            <th>{{ __('messages.price') }}</th>
                            <th>{{ __('messages.available_qty') }}</th>
                            <th>{{ __('messages.image') }}</th>
                            <th style="width: 25%">{{ __('messages.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td><a
                                        href="{{ route('ProdutDetails', $product->id) }}">{{ app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en }}</a>
                                </td>
                                <td>{{ Str::limit(app()->getLocale() == 'ar' ? $product->description_ar : $product->description_en, 50) }}
                                </td>
                                <td>{{ $product->price }} {{ __('messages.egp') }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td class="text-center">
                                    <a href="{{ route('ProdutDetails', $product->id) }}"> <img
                                            src="{{ asset($product->imagePath) }}" class="rounded shadow-sm" width="60"
                                            height="60" alt="Product"></a>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('addcart', $product->id) }}" method="post" class="d-inline">
                                        @csrf
                                        <button class="btn btn-success btn-sm">
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                    </form>


                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let table = new DataTable('#myTable', {
            responsive: true,
            pageLength: 5,
            lengthMenu: [5, 10, 25, 50],
            language: {
                search: "🔍 Search:",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ products",
                paginate: {
                    next: "👉",
                    previous: "👈"
                }
            }
        });
    </script>
@endpush
