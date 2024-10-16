@extends('layouts/contentNavbarLayout')

@section('title', 'Perfumes - Listado')

@section('vendor-style')
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css" rel="stylesheet">
@endsection

@section('content')
    @include('alerts.alerts')
    <div class="d-flex justify-content-between align-items-center py-3 mb-3">
        <h4 class="text-muted fw-light text-uppercase">Perfumes / Almacén General</h4>
    </div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#actual" type="button"
                role="tab" aria-controls="actual" aria-selected="true">Actual Stock</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#futuro" type="button"
                role="tab" aria-controls="profile" aria-selected="false">Futuro Stock</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="actual" role="tabpanel" aria-labelledby="actual-tab">
            <div class="card p-3">{{-- LISTADO DE STOCK GENERAL --}}
                <div class="d-flex justify-content-between align-items-center py-3 mb-3">
                    <h5 class="card-header text-uppercase">Listado de stock actual</h5>
                    <div class="ms-auto d-block">
                        <button type="button" class="btn btn-primary me-2 mt-2" data-bs-toggle="modal"
                            data-bs-target="#modalNewStock">
                            <i class="bx bxs-plus-circle me-2"></i>
                            Nuevo
                        </button>
                        <a href="{{ route('historial.index') }}" type="button" class="btn btn-primary mt-2">
                            <i class="bx bx-clipboard me-2"></i>
                            Historial
                        </a>
                    </div>
                </div>

                <div class="table-responsive text-nowrap">
                    <table class="table" id="stock_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">Perfume</th>
                                <th class="text-center">Envase</th>
                                <th class="text-center">Stock</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($stock as $item)
                                <tr class="">
                                    <td class="">{{ $loop->iteration }}</td>
                                    <td class="">
                                        <i class="bx bx-droplet bx-sm text-warning me-3"></i>
                                        <span
                                            class="fw-medium text-uppercase text-center">{{ $item->name_fragrance }}</span>
                                    </td>
                                    <td>
                                        <i class="bx bx-water bx-sm text-warning me-3"></i>
                                        <span class="fw-medium text-uppercase">{{ $item->ml }} ml</span>
                                    </td>
                                    <td class="text-center"><span
                                            class="badge bg-label-primary me-1">{{ $item->stock }}</span></td>
                                    <td class="text-center">
                                        <div class="d-flex text-center">
                                            <button class="btn btn-sm btn-dark me-2 open-sucursal-modal" type="button"
                                                data-warehouse-id="{{ $item->warehouse_id }}">
                                                <i class="bx bx-store"></i> Enviar
                                            </button>
                                            <button class="btn btn-sm btn-primary me-2" type="button"
                                                onclick="editContainers({{ $item->containers_id }})">
                                                <i class="bx bx-edit-alt"></i> Editar
                                            </button>
                                            <button class="btn btn-sm btn-danger" type="button"
                                                onclick="confirmDelete({{ $item->containers_id }})">
                                                <i class="bx bx-trash"></i> Eliminar
                                            </button>
                                            <form id="delete-form-{{ $item->containers_id }}"
                                                action="{{ route('envases.destroy', $item->containers_id) }}" method="POST"
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
        </div>
        <div class="tab-pane fade" id="futuro" role="tabpanel" aria-labelledby="profile-tab">
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center py-3 mb-3">
                    <h5 class="card-header text-uppercase">Listado de futuro stock</h5>
                    <div class="ms-auto d-flex">
                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal"
                            data-bs-target="#modalNewFuture">
                            <i class="bx bxs-plus-circle me-2"></i>
                            Nuevo
                        </button>
                    </div>
                </div>

                <div class="table-responsive text-nowrap">
                    <table class="table w-100" id="future_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">Perfume</th>
                                <th class="text-center">Envase</th>
                                <th class="text-center">Stock</th>
                                <th class="text-center">Fecha fin</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($stock_future as $item)
                                <tr class="">
                                    <td class="">{{ $loop->iteration }}</td>
                                    <td>
                                        <i class="bx bx-droplet bx-sm text-warning me-3"></i>
                                        <span class="fw-medium text-uppercase">{{ $item->name_fragrance }}</span>
                                    </td>
                                    <td>
                                        <i class="bx bx-water bx-sm text-warning me-3"></i>
                                        <span class="fw-medium text-uppercase">{{ $item->ml }} ml</span>
                                    </td>
                                    <td class="text-center"><span
                                            class="badge bg-label-primary me-1">{{ $item->stock }}</span></td>
                                    <td class="text-center"><span
                                            class="me-1">{{ date('d/m/Y', strtotime($item->date)) }}</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex text-center">
                                            <button class="btn btn-sm btn-primary me-2" type="button"
                                                onclick="updateState({{ $item->stock_future_id }})">
                                                <i class="bx bx-check"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger" type="button"
                                                onclick="deleteStock({{ $item->stock_future_id }})">
                                                <i class="bx bx-trash"></i> Eliminar
                                            </button>
                                            <form id="update-form-{{ $item->stock_future_id }}"
                                                action="{{ route('futuro.update', $item->stock_future_id) }}"
                                                method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                            <form id="delete-form-{{ $item->stock_future_id }}"
                                                action="{{ route('futuro.destroy', $item->stock_future_id) }}"
                                                method="POST" style="display: none;">
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
        </div>
    </div>
    @include('pages.almacen.components.modal_newstock')
    @include('pages.almacen.components.modal_newfuture')
    @include('pages.almacen.components.modal_sucursal')
@endsection

@section('page-script')
    <script src="{{ asset('js/almacen/almacen.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
@endsection
