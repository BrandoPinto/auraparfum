@extends('layouts/contentNavbarLayout')

@section('title', 'Usuarios - Listado')

@section('vendor-style')
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css" rel="stylesheet">
@endsection

@section('content')
    @include('alerts.alerts')
    <div class="d-flex justify-content-between align-items-center py-3 mb-3">
        <h4 class="text-muted fw-light text-uppercase">Stock / Sucursal</h4>
    </div>
    @if ($stockBajo->isNotEmpty())
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <i class="bx bxs-error-circle me-2"></i>
            <div>
                ¡Alerta! Algunos productos tienen un stock bajo.
            </div>
        </div>
    @endif
    <div class="card p-3">
        <h5 class="card-header"></h5>
        <div class="table-responsive text-nowrap">
            <table class="table text-center" id="stock_table">
                <thead>
                    <tr class="text-center">
                        <th class="text-center">#</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">ML</th>
                        <th class="text-center">Stock</th>
                        <th class="text-center">Precio und</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($stock as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $item->name_fragrance }}</td>
                            <td class="text-center">{{ $item->ml }} ml</td>
                            <td class="text-center">
                                @if ($item->stock <= 5)
                                    <span class="badge bg-danger">
                                        <i class="bx bxs-error"></i> {{ $item->stock }}
                                    </span>
                                @else
                                    <span class="badge bg-dark">
                                        <i class="bx bxs-check-circle"></i> {{ $item->stock }}
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">S/{{ $item->cost }}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
@endsection

@section('page-script')
    <script src="{{ asset('js/sucursales/sucursal_usuario.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
@endsection
