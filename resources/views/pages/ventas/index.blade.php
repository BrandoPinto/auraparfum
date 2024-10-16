@extends('layouts/contentNavbarLayout')

@section('title', 'Mis Ventas')

@section('vendor-style')
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css" rel="stylesheet">
@endsection

@section('content')
    @include('alerts.alerts')
    <div class="d-flex justify-content-between align-items-center py-3 mb-3">
        <h4 class="text-muted fw-light text-uppercase">Mis Ventas</h4>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNewSale">
            <i class="bx bxs-plus-circle me-2"></i>
            Nueva Venta
        </button>
    </div>
    <div class="card p-3">
        <h5 class="card-header">Mis ventas hoy</h5>
        <div class="table-responsive text-nowrap">
            <table class="table" id="store_table">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Perfume</th>
                        <th>Cantidad</th>
                        <th>Tipo de pago</th>
                        <th class="text-center">Total</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    @include('pages.ventas.components.modal_newsale')
@endsection

@section('page-script')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
@endsection
