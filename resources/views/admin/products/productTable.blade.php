<!-- DataTables Bootstrap 5 CSS -->
<link rel="stylesheet" href="{{ asset('assets/data_table/prod_table_bootstrap5datatable.css') }}">

<!-- jQuery -->
<script src="{{ asset('assets/data_table/prod_table_jquery.js') }}"></script>

<!-- DataTables JS + Bootstrap 5 -->
<script src="{{ asset('assets/data_table/prod_table_morefile.js') }}"></script>
<script src="{{ asset('assets/data_table/prod_table_integration.js') }}"></script>

@extends('layouts.parent')
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
                                        href="{{ route('ProdutDetailsforadmin', $product->id) }}">{{ app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en }}</a>
                                </td>
                                <td>{{ Str::limit(app()->getLocale() == 'ar' ? $product->description_ar : $product->description_en, 50) }}
                                </td>
                                <td>{{ $product->price }} {{ __('messages.egp') }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td class="text-center">
                                    <a href="{{ route('ProdutDetailsforadmin', $product->id) }}"> <img
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

                                    <a href="{{ route('addimages', $product->id) }}"
                                        class="btn btn-info btn-sm text-white">
                                        <i class="fas fa-image"></i>
                                    </a>
                                    <a href="{{ route('editproduct', $product->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('deleteproduct', $product->id) }}" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a>
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
