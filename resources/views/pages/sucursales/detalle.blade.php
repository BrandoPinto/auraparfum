@extends('layouts/contentNavbarLayout')

@section('title', 'Perfumes - Sucursales')

@section('vendor-style')
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css" rel="stylesheet">
@endsection

@section('content')
    @include('alerts.alerts')
    <div class="d-flex justify-content-between align-items-center py-3 mb-3">
        <h4 class="text-muted fw-light text-uppercase">Sucursales / Detalle</h4>
    </div>

    <div class="row">
        <!-- Información de la sucursal -->
        <div class="col-md-6 mb-4">
            <div class="row">
                <div class="card border-primary mb-4 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <i class="bx bx-building-house bx-lg text-primary"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-1 text-uppercase">{{ $branch->name_branch }}</h5>
                            <p class="card-text text-muted">
                                <i class="bx bx-map me-2"></i>{{ $branch->location ?: 'No disponible' }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card border-info mb-4 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        @if (!$team_leader)
                            <div class="d-flex justify-content-end mb-2">
                                <button class="btn btn-warning btn-sm {{ Auth::user()->idRole != 1 ? 'disabled' : '' }}"
                                    data-bs-toggle="modal" data-bs-target="#assignTeamLeaderModal"
                                    data-branch-id="{{ $branch_id }}">
                                    <i class="bx bx-user-plus"></i> Asignar Team Leader
                                </button>
                            </div>
                        @endif

                        <div class="d-flex align-items-center mb-3">
                            <div class="me-3">
                                <i class="bx bx-user bx-lg text-info"></i>
                            </div>
                            <div>
                                <h5 class="card-title mb-1 text-uppercase">
                                    {{ $team_leader ? $team_leader->name : 'SIN ASIGNAR' }}
                                </h5>
                                <p class="card-text text-muted mb-0">
                                    <i class="bx bx-envelope me-2"></i>{{ $team_leader ? $team_leader->email : ' —' }}
                                </p>
                                <p class="card-text text-muted">
                                    <i class="bx bxs-phone me-2"></i>{{ $team_leader ? $team_leader->cellphone : ' —' }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light border-top-0">
                        <div class="d-flex justify-content-end">
                            <a href="{{ $team_leader ? route('users.profile', $team_leader->id) : '#' }}"
                                class="btn btn-info btn-sm me-2 {{ $team_leader ? '' : 'disabled' }} {{ Auth::user()->idRole != 1 ? 'disabled' : '' }}">
                                <i class="bx bx-user"></i> Ver perfil
                            </a>
                            <button type="button"
                                class="btn btn-danger btn-sm {{ $team_leader ? '' : 'disabled' }} {{ Auth::user()->idRole != 1 ? 'disabled' : '' }}"
                                data-teamleader-id="{{ $team_leader ? $team_leader->id : '' }}"
                                data-branch-id="{{ $branch_id }}"
                                onclick="{{ $team_leader ? 'confirmDesasignar(' . $team_leader->id . ', ' . $branch_id . ')' : '' }}">
                                <i class="bx bx-trash"></i> Desasignar
                            </button>
                            @if ($team_leader)
                                <form id="desasignar-form-{{ $team_leader->id }}-{{ $branch_id }}"
                                    action="{{ route('sucursales.desasignar', ['teamLeaderId' => $team_leader->id, 'branchId' => $branch_id]) }}"
                                    method="POST" style="display: none;">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" name="branchId" value="{{ $branch_id }}">
                                    <input type="hidden" name="teamLeaderId" value="{{ $team_leader->id }}">
                                </form>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Información de los vendedores -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title">Vendedores</h5>
                        <div class="d-flex justify-content-end mb-2">
                            <button class="btn btn-warning btn-sm {{ Auth::user()->idRole != 1 ? 'disabled' : '' }}"
                                data-bs-toggle="modal" data-bs-target="#assignSellerModal"
                                data-branchs-id="{{ $branch_id }}">
                                <i class="bx bx-user-plus"></i> Vendedor
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="sellers-table" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sellersBranches as $seller)
                                    <tr>
                                        <td>
                                            @if (Auth::user()->idRole == 1)
                                                <a href="{{ route('users.profile', $seller->id) }}">
                                                    {{ $seller->name }}
                                                </a>
                                            @else
                                                <span>{{ $seller->name }}</span>
                                            @endif

                                        </td>
                                        <td>{{ $seller->email }}</td>
                                        <td>
                                            <button type="button"
                                                class="btn btn-sm btn-danger {{ Auth::user()->idRole != 1 ? 'disabled' : '' }}"
                                                onclick="confirmDeleteSeller({{ $seller->id }}, {{ $branch_id }})">
                                                <i class='bx bx-trash'></i> Desasignar
                                            </button>
                                            <form id="delete-seller-form-{{ $seller->id }}-{{ $branch_id }}"
                                                action="{{ route('sucursales.desasignarSeller', ['sellerId' => $seller->id, 'branchId' => $branch_id]) }}"
                                                method="POST" style="display: none;">
                                                @csrf
                                                @method('POST')
                                                <input type="hidden" name="branchId" value="{{ $branch_id }}">
                                                <input type="hidden" name="sellerId" value="{{ $seller->id }}">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Información del stock -->
        @if ($stock->isNotEmpty())
            <div class="card mt-2">
                <div class="card-body">
                    <h5 class="card-title">Total Stock en {{ $branch->name_branch }}</h5>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="table_stock">
                            <thead>
                                <tr>
                                    <th>Perfume</th>
                                    <th>Envase (ml)</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stock as $item)
                                    <tr>
                                        <td>{{ $item->name_fragrance }}</td>
                                        <td>{{ $item->ml }} ml</td>
                                        <td>{{ $item->stock }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-info mt-2" role="alert">
                No hay stock disponible en {{ $branch->name_branch }}.
            </div>
        @endif


    </div>

    <!-- Modales -->
    @include('pages.sucursales.components.modal_teamleader')
    @include('pages.sucursales.components.modal_newseller')
@endsection

@section('page-script')
    <script src="{{ asset('js/sucursales/sucursales.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
@endsection
