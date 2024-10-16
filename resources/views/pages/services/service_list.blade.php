@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('vendor-style')
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css" rel="stylesheet">
@endsection

@section('content')
    @include('alerts.alerts')
    <div class="d-flex justify-content-between align-items-center py-3 mb-3">
        <h4 class="text-muted fw-light text-uppercase">Servicios / Listado</h4>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNewService">
            <i class="bx bxs-plus-circle me-2"></i>
            Nuevo Servicio
        </button>
    </div>
    <div class="card p-3">
        <h5 class="card-header">Listado de servicios</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Servicio</th>
                        <th>Tipo de pago</th>
                        <th>Cantidad de clientes usando</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($services as $item)
                        <tr>
                            <td><span class="fw-medium">{{ $loop->iteration }}</span></td>
                            <td><i class='bx bxs-briefcase text-primary me-3'></i><span
                                    class="fw-medium">{{ $item->service }}</span>
                            </td>
                            <td><span class="fw-medium">{{ $item->type }}</span>
                            <td><span class="badge bg-label-primary me-1"></span></td>
                            <td>
                                <div class="d-flex">
                                    <button class="btn btn-sm btn-primary me-2" type="button">
                                        <i class="bx bx-edit-alt"></i> Editar
                                    </button>
                                    <button class="btn btn-sm btn-danger" type="button">
                                        <i class="bx bx-trash"></i> Eliminar
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('pages.services.modals.new_service')
@endsection

@section('page-script')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
    <script script src="{{ asset('assets/js/ui-toasts.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#service_table').DataTable({
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
                },
            });
        });
    </script>
@endsection
