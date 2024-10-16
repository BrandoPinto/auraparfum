@extends('layouts/contentNavbarLayout')

@section('title', 'Perfumes - Tipos')

@section('vendor-style')
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css" rel="stylesheet">
@endsection

@section('content')
    @include('alerts.alerts')
    <div class="d-flex justify-content-between align-items-center py-3 mb-3">
        <h4 class="text-muted fw-light text-uppercase">Perfumes / Tipos</h4>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNewType">
            <i class="bx bxs-plus-circle me-2"></i>
            Nuevo Tipo
        </button>
    </div>
    <div class="card p-3">
        <h5 class="card-header">Listado de Tipos</h5>
        <div class="table-responsive text-nowrap">
            <table class="table" id="types_table">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Tipo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($types_fragrances as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>
                                <i class="bx bxs-droplet-half bx-sm text-warning me-3"></i>
                                <span class="fw-medium" id="name_type_{{ $item->typefragrance_id }}">
                                    {{ $item->name_type }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex">
                                    <button class="btn btn-sm btn-primary me-2" type="button"
                                        onclick="editType({{ $item->typefragrance_id }})">
                                        <i class="bx bx-edit-alt"></i> Editar
                                    </button>
                                    <button class="btn btn-sm btn-danger" type="button"
                                        onclick="confirmDelete({{ $item->typefragrance_id }})">
                                        <i class="bx bx-trash"></i> Eliminar
                                    </button>
                                    <form id="delete-form-{{ $item->typefragrance_id }}"
                                        action="{{ route('tipos.destroy', $item->typefragrance_id) }}" method="POST"
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
    @include('pages.perfumes.components.modal_newtype')
    @include('pages.perfumes.components.modal_edittype')
@endsection

@section('page-script')
    <script src="{{ asset('js/perfumes/tipos.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
@endsection
