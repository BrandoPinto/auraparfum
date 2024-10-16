@extends('layouts/contentNavbarLayout')

@section('title', 'Vendedores - Listado')

@section('vendor-style')
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css" rel="stylesheet">
@endsection

@section('content')
    @include('alerts.alerts')
    <div class="d-flex justify-content-between align-items-center py-3 mb-3">
        <h4 class="text-muted fw-light text-uppercase">Vendedores / Listado</h4>
    </div>
    <div class="card p-3">
        <h5 class="card-header">Listado de vendedores</h5>
        <div class="table-responsive text-nowrap">
            <table class="table" id="store_table">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Celular</th>
                        <th class="text-center">DNI</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($users as $item)
                        <tr class="text-center">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td><i class="bx bx-user bx-sm text-warning me-3"></i> <span id="name_user_{{ $item->id }}"
                                    class="fw-medium text-uppercase">{{ $item->name }}</span></td>
                            <td class="text-center">{{ $item->email }}</td>
                            <td class="text-center">{{ $item->cellphone }}</td>
                            <td class="text-center">{{ $item->dni }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('page-script')
    <script src="{{ asset('js/usuarios/usuarios.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
@endsection
