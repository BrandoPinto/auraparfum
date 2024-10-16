@extends('layouts/contentNavbarLayout')

@section('title', 'Sucursal - Mis sucursales')

@section('vendor-style')
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css" rel="stylesheet">
@endsection

@section('content')
    @include('alerts.alerts')
    <div class="d-flex justify-content-between align-items-center py-3 mb-3">
        <h4 class="text-muted fw-light text-uppercase">Stock</h4>
    </div>

    <div class="container">
        <h1 class="mb-4">Lugares de trabajo</h1>
        <div class="row">
            @if ($branches->isEmpty())
                <div class="col-12">
                    <div class="alert alert-info" role="alert">
                        No hay sucursales asociadas.
                    </div>
                </div>
            @else
                @foreach ($branches as $branch)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $branch->name_branch }}</h5>
                                <p class="card-text">
                                    <strong>Ubicación:</strong> {{ $branch->location }}<br>
                                </p>
                                <!-- Formulario para enviar el branch_id -->
                                <form action="{{ route('sucursal.usuario.detalle') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="branch_id" value="{{ $branch->branch_id }}">
                                    <button type="submit" class="btn btn-warning">Ver Stock</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>


@endsection

@section('page-script')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
@endsection
