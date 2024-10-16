@extends('layouts/contentNavbarLayout')

@section('title', 'Usuarios - Listado')

@section('vendor-style')
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css" rel="stylesheet">
@endsection

@section('content')
    @include('alerts.alerts')
    <div class="d-flex justify-content-between align-items-center py-3 mb-3">
        <h4 class="text-muted fw-light text-uppercase">Usuarios / Listado</h4>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNewUser">
            <i class="bx bxs-plus-circle me-2"></i>
            Nuevo Usuario
        </button>
    </div>
    <div class="card p-3">
        <h5 class="card-header">Listado de usuarios</h5>
        <div class="table-responsive text-nowrap">
            <table class="table" id="store_table">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Celular</th>
                        <th class="text-center">Tipo de usuario</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($users as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td><i class="bx bx-user bx-sm text-warning me-3"></i> <span id="name_user_{{ $item->id }}"
                                    class="fw-medium text-uppercase">{{ $item->name }}</span></td>
                            <td id="email_user_{{ $item->id }}" class="">{{ $item->email }}</td>
                            <td id="cellphone_user_{{ $item->id }}" class="">{{ $item->cellphone }}</td>
                            <td class="text-center text-uppercase text-sm">
                                <span class="badge bg-primary">{{ $item->role_name }}</span>
                            </td>
                            <td>
                                <div class="d-flex">
                                    <button class="btn btn-sm btn-primary me-2" type="button"
                                        onclick="editUser({{ $item->id }})">
                                        <i class="bx bx-edit-alt"></i> Editar
                                    </button>
                                    <button class="btn btn-sm btn-danger" type="button"
                                        onclick="confirmDelete({{ $item->id }})">
                                        <i class="bx bx-trash"></i> Eliminar
                                    </button>
                                    <form id="delete-form-{{ $item->id }}"
                                        action="{{ route('usuarios.destroy', $item->id) }}" method="POST"
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
    @include('pages.usuarios.components.modal_newuser')
    @include('pages.usuarios.components.modal_edituser')
@endsection

@section('page-script')
    <script src="{{ asset('js/usuarios/usuarios.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
@endsection
