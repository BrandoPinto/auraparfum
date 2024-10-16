@extends('layouts/contentNavbarLayout')

@section('title', 'Ingresos')

@section('vendor-style')
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css" rel="stylesheet">
@endsection

@section('content')
    @include('alerts.alerts')
    <div class="d-flex justify-content-between align-items-center py-3 mb-3">
        <h4 class="text-muted fw-light text-uppercase">Ingresos</h4>
    </div>

    <!-- Título del reporte -->
    <div class="d-flex align-items-center mb-4">
        <h5 class="text-uppercase me-3">Reporte del mes de {{ $currentMonthName }}</h5>
    </div>

    <!-- Cards de totales -->
    <div class="row mb-4">
        <div class="col-md-12 col-lg-6">
            <div class="card text-center bg-primary text-white mb-3">
                <div class="card-body">
                    <i class='bx bx-money bx-lg'></i>
                    <h5 class="card-title mt-2 text-white">Total Ingresos</h5>
                    <p class="card-text fs-3">S/{{ number_format($totalIncome, 2) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-6">
            <div class="card text-center bg-success text-white mb-3">
                <div class="card-body">
                    <i class='bx bx-cart bx-lg'></i>
                    <h5 class="card-title mt-2 text-white">Total Ventas</h5>
                    <p class="card-text fs-3">{{ $totalSales }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Buscador de ingresos por rango de fechas -->
    <div class="card p-3 mb-4">
        <form method="POST" action="{{ route('ingresos.data') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-5">
                    <label for="startDate" class="form-label">Fecha de Inicio</label>
                    <input type="date" class="form-control" id="startDate" name="start_date" value="{{ $startDate }}"
                        required>
                </div>
                <div class="col-md-5">
                    <label for="endDate" class="form-label">Fecha de Fin</label>
                    <input type="date" class="form-control" id="endDate" name="end_date" value="{{ $endDate }}"
                        required>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-warning w-100">Buscar</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Tabla de resultados -->
    <div class="card p-3">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Perfume</th>
                        <th>ML</th>
                        <th>Costo</th>
                        <th>Cliente</th>
                        <th>Vendedor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($filteredData as $item)
                        <tr>
                            <td>{{ date('d/m/Y', strtotime($item->date)) }}</td>
                            <td>{{ $item->name_fragrance }}</td>
                            <td>{{ $item->ml }}</td>
                            <td>{{ $item->cost }}</td>
                            <td>{{ $item->nombre_cliente }}</td>
                            <td>{{ $item->nombre_vendedor }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
