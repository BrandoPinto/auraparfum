@extends('layouts/contentNavbarLayout')

@section('title', 'Perfumes - Listado')

@section('vendor-style')
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css" rel="stylesheet">
@endsection

@section('content')
    @include('alerts.alerts')
    <div class="d-flex justify-content-between align-items-center py-3 mb-3">
        <h4 class="text-muted fw-light text-uppercase">Historial envíos</h4>
    </div>
    <div class="card p-3">
        <h5 class="card-header">Listado de Envíos a sucursales</h5>
        <div class="table-responsive text-nowrap">
            <table class="table" id="history_table">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Perfume</th>
                        <th>ML</th>
                        <th>Sucursal</th>
                        <th>Cantidad</th>
                        <th>Fecha Enviada</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($history as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>
                                <i class="bx bx-droplet bx-sm text-warning me-3"></i>
                                <span class="fw-medium text-uppercase">{{ $item->name_fragrance }} ml</span>
                            </td>
                            <td><span class="fw-medium text-uppercase ">{{ $item->ml }}</span></td>
                            <td><span class="fw-medium text-uppercase ">{{ $item->name_branch }}</span></td>
                            <td><span class="fw-medium text-uppercase ">{{ $item->stock }}</span></td>
                            <td><span class="fw-medium text-uppercase ">{{ date('d/m/Y', strtotime($item->date)) }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('page-script')
    <script src="{{ asset('js/historial/historial.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
@endsection
