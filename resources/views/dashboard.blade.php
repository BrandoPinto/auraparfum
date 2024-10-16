@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}">
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
@endsection

@section('content')
    @include('alerts.alerts')
    <div class="row">
        @if ($userRole === 1)
            @include('pages.dashboard.admin')
        @endif
        @if ($userRole === 2 || $userRole === 3)
            @include('pages.dashboard.vendedor')
        @endif
        <div class="row"> <!--/ Transactions -->
        </div>

        @include('pages.dashboard.components.modal_newcustomer');
    @endsection
    @section('page-script')
        <script src="{{ asset('js/dashboard.js') }}"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
    @endsection
