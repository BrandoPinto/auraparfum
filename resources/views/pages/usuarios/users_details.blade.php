@extends('layouts/contentNavbarLayout')

@section('title', 'Perfumes - Sucursales')

@section('vendor-style')
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css" rel="stylesheet">
@endsection

@section('content')
    @include('alerts.alerts')

    <!-- User Name -->
    <div class="row mb-2">
        <div class="col-12">
            <h1 class="display-4 text-start">
                <i class="bx bx-user" style="font-size: 2.5rem;"></i> <!-- Adjust the font-size as needed -->
                {{ $user->name }}
            </h1>
        </div>
    </div>
    <div class="row">
        <!-- User Details Card -->
        <div class="col-md-4 mb-2">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0 text-white">
                        <i class="bx bx-info-circle"></i> Datos Personales
                    </h5>
                </div>
                <div class="card-body mt-4">
                    <p><strong><i class="bx bx-envelope"></i> Email:</strong> {{ $user->email }}</p>
                    <p><strong><i class="bx bx-phone"></i> Celular:</strong> {{ $user->cellphone }}</p>
                    <p><strong><i class="bx bx-id-card"></i> DNI:</strong> {{ $user->dni }}</p>
                </div>
            </div>
        </div>

        <!-- Customers List Card -->
        <div class="col-md-8 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0 text-white">
                        <i class="bx bx-group"></i> Clientes Asociados
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive p-4">
                        <table class="table table-hover" id="customers_table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Celular</th>
                                    <th>DNI</th>
                                    <th>Email</th>
                                    <th>Fecha de Registro</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->cellphone }}</td>
                                        <td>{{ $customer->dni }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>{{ $customer->registration_date->format('d/m/Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0 text-white">
                        <i class="bx bx-calendar"></i> Generar Reporte Ventas por Fecha
                    </h5>
                </div>
                <div class="card-body mt-2">
                    <form action="{{ route('filter.by.date') }}" method="GET" class="mb-4">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-5">
                                <label for="start_date" class="form-label"><i class="bx bx-calendar"></i> Fecha de
                                    Inicio</label>
                                <input type="date" id="start_date" name="start_date" class="form-control" required>
                            </div>
                            <div class="col-md-5">
                                <label for="end_date" class="form-label"><i class="bx bx-calendar"></i> Fecha de Fin</label>
                                <input type="date" id="end_date" name="end_date" class="form-control" required>
                            </div>
                            <input class="d-none" type="number" name="id" value="{{ $id }}">
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bx bx-search"></i> Buscar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @if (isset($filteredData) && $filteredData->isNotEmpty())
            <div class="card shadow-sm mt-4">
                <div class="card-header text-white">
                    <h5 class="mb-0 text-center">
                        Reporte de Ventas entre <i class="bx bx-calendar"></i>{{ $formattedStartDate }} y
                        {{ $formattedEndDate }}
                    </h5>
                </div>
                <div class="card-body">
                    <!-- Summary Cards -->
                    <div class="row mb-4">
                        <!-- Total Ventas Card -->
                        <div class="col-md-6 mb-4">
                            <div class="card shadow-sm" style="background-color: #007bff; color: white;">
                                <div class="card-body text-center">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <i class="bx bx-dollar-circle" style="font-size: 3rem; margin-right: 15px;"></i>
                                        <div>
                                            <h2 class="mb-0 text-white" style="font-size: 2.5rem;">S/
                                                {{ number_format($totalCost, 2) }}</h2>
                                            <p class="mb-0">Total de Ventas</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Cantidad de Ventas Card -->
                        <div class="col-md-6 mb-4">
                            <div class="card shadow-sm" style="background-color: #28a745; color: white;">
                                <div class="card-body text-center">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <i class="bx bx-line-chart" style="font-size: 3rem; margin-right: 15px;"></i>
                                        <div>
                                            <h2 class="mb-0 text-white" style="font-size: 2.5rem;">
                                                {{ $filteredData->count() }}</h2>
                                            <p class="mb-0">Cantidad de Ventas</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Results Table -->
                    <div class="table-responsive p-4">
                        <table class="table table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Perfume</th>
                                    <th>ML</th>
                                    <th>Costo</th>
                                    <th>Cliente</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($filteredData as $item)
                                    <tr>
                                        <td>{{ $item->name_fragrance }}</td>
                                        <td>{{ $item->ml }}</td>
                                        <td>S/ {{ number_format($item->cost, 2) }}</td>
                                        <td>{{ $item->nombre_cliente }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->date)->format('d/m/Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-info mt-4" role="alert">
                No hay datos disponibles para el rango de fechas seleccionado.
            </div>
        @endif
    </div>

@endsection


@section('page-script')
    <script src="{{ asset('js/usuarios/detalles.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
@endsection
