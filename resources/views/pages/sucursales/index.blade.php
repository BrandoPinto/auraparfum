@extends('layouts/contentNavbarLayout')

@section('title', 'Perfumes - Sucursales')

@section('vendor-style')
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css" rel="stylesheet">
@endsection

@section('content')
    @include('alerts.alerts')
    <div class="d-flex justify-content-between align-items-center py-3 mb-3">
        <h4 class="text-muted fw-light text-uppercase">Lugar de trabajo / Listado</h4>
        <button type="button" class="btn btn-warning {{ Auth::user()->idRole != 1 ? 'disabled' : '' }}" data-bs-toggle="modal"
            data-bs-target="#modalNewBranch">
            <i class="bx bxs-plus-circle me-2"></i>
            Nuevo Lugar
        </button>
    </div>

    <div class="row">
        @foreach ($branches as $branch)
            <div class="col-md-4 mb-4">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="d-flex justify-content-center align-items-center mb-3">
                            <i class='bx bx-building-house bx-lg me-2'></i>
                            <div>
                                <h5 class="card-title m-0">{{ $branch->name_branch }}</h5>
                                <span class="badge bg-primary mt-2">{{ $branch->type }}</span>
                            </div>
                        </div>
                        <a href="{{ route('sucursales.show', $branch->branch_id) }}" class="btn btn-primary mt-3">
                            <i class='bx bx-right-arrow-alt'></i> Ver más
                        </a>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <!-- Botón de editar -->
                        <a href="javascript:void(0);"
                            onclick="editSucursal({{ $branch->branch_id }}, '{{ $branch->name_branch }}')"
                            class="btn btn-warning btn-sm {{ Auth::user()->idRole != 1 ? 'disabled' : '' }}"
                            {{ Auth::user()->idRole != 1 ? 'aria-disabled=true' : '' }}>
                            <i class='bx bx-edit'></i>
                        </a>
                        <!-- Botón de eliminar -->
                        <button class="btn btn-sm btn-danger {{ Auth::user()->idRole != 1 ? 'disabled' : '' }}"
                            type="button" onclick="deleteBranch({{ $branch->branch_id }})"
                            {{ Auth::user()->idRole != 1 ? 'aria-disabled=true' : '' }}>
                            <i class="bx bx-trash"></i> Eliminar
                        </button>
                        <form id="delete-form-{{ $branch->branch_id }}"
                            action="{{ route('sucursales.destroy', $branch->branch_id) }}" method="POST"
                            style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>




    @include('pages.sucursales.components.modal_newbranch')
    @include('pages.sucursales.components.modal_editbranch')
@endsection

@section('page-script')
    <script src="{{ asset('js/sucursales/sucursales.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
@endsection
