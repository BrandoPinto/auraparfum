@extends('layouts/contentNavbarLayout')

@section('title', 'Usuarios - Listado')

@section('vendor-style')
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css" rel="stylesheet">
@endsection

@section('content')
    @include('alerts.alerts')
    <div class="d-flex justify-content-between align-items-center py-3 mb-3">
        <h4 class="text-muted fw-light text-uppercase">Clientes / Mis clientes</h4>
        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNewUser">
                                                <i class="bx bxs-plus-circle me-2"></i>
                                                Nuevo Usuario
                                            </button>-->
    </div>
    <div class="card p-3">
        <h5 class="card-header">Listado de usuarios</h5>
        <div class="table-responsive text-nowrap">
            <table class="table text-center" id="customers_table">
                <thead>
                    <tr class="text-center">
                        <th class="text-center">#</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Celular</th>
                        <th class="text-center">DNI</th>
                        <th class="text-center">Fecha de registro</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($customers as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <!-- Asigna un id a cada celda de la tabla para poder obtener los valores -->
                            <td class="text-center" id="name_customer_{{ $item->customers_id }}">
                                <i class="bx bx-user"></i> {{ $item->name }}
                            </td>
                            <td class="text-center" id="email_customer_{{ $item->customers_id }}">
                                <i class="bx bx-envelope"></i> {{ $item->email }}
                            </td>
                            <td class="text-center" id="cellphone_customer_{{ $item->customers_id }}">
                                <a href="https://wa.me/51{{ $item->cellphone }}" target="_blank">
                                    <i class="bx bxl-whatsapp"></i> {{ $item->cellphone }}
                                </a>
                            </td>
                            <td class="text-center" id="dni_customer_{{ $item->customers_id }}">
                                <i class="bx bx-id-card"></i> {{ $item->dni }}
                            </td>
                            <td class="text-center"><i class="bx bx-calendar"></i>
                                {{ date('d/m/Y', strtotime($item->registration_date)) }}
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <!-- Botón para editar que llama a la función editUser -->
                                    <button class="btn btn-sm btn-primary me-2" type="button"
                                        onclick="editCustomer({{ $item->customers_id }})">
                                        <i class="bx bx-edit-alt"></i> Editar
                                    </button>

                                    <!-- Botón para eliminar -->
                                    <button class="btn btn-sm btn-danger" type="button"
                                        onclick="confirmDelete({{ $item->customers_id }})">
                                        <i class="bx bx-trash"></i> Eliminar
                                    </button>
                                    <!-- Formulario oculto para eliminar -->
                                    <form id="delete-form-{{ $item->customers_id }}"
                                        action="{{ route('clientes.destroy', $item->customers_id) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

    @include('pages.clientes.components.modal_editcustomer')
@endsection

@section('page-script')
    <script src="{{ asset('js/clientes/clientes.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
@endsection
