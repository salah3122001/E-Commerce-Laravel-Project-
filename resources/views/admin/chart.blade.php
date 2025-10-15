@extends('layouts.parent')
@section('title', __('messages.charts'))
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="card-title">{{ __('messages.sales_statistics') }}</h3>
                </div>
                <div class="card-body">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    "{{ __('messages.january') }}", "{{ __('messages.february') }}",
                    "{{ __('messages.march') }}",
                    "{{ __('messages.april') }}", "{{ __('messages.may') }}", "{{ __('messages.june') }}",
                    "{{ __('messages.july') }}", "{{ __('messages.august') }}",
                    "{{ __('messages.september') }}",
                    "{{ __('messages.october') }}", "{{ __('messages.november') }}",
                    "{{ __('messages.december') }}"
                ],
                datasets: [{
                    label: "{{ __('messages.total_sales') }}",
                    data: @json($salesData),
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>


@endsection
