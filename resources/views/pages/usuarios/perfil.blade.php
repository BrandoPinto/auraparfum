@extends('layouts/contentNavbarLayout')

@section('title', 'Mi Perfil')

@section('content')
    @include('alerts.alerts')
    <div class="d-flex justify-content-between align-items-center py-3">
        <h4 class="text-muted fw-light text-uppercase">Mi Perfil</h4>
    </div>
    <div class="card p-3">
        <div class="card-header bg-light text-white d-flex align-items-center">
            <h4 class="mb-0">Mi Perfil</h4>
            <i class="bx bxs-user-circle bx-lg ms-3"></i>
        </div>
        <div class="card-body mt-2">
            <form method="POST" action="{{ route('users.update.profile') }}">
                @csrf
                @method('PUT')
                <!-- Nombre -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bx bxs-user"></i></span>
                        <input type="text" id="name" name="name" class="form-control text-uppercase"
                            value="{{ old('name', auth()->user()->name) }}" required>
                    </div>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bx bxs-envelope"></i></span>
                        <input type="email" id="email" name="email" class="form-control"
                            value="{{ old('email', auth()->user()->email) }}" required>
                    </div>
                </div>

                <!-- Celular -->
                <div class="mb-3">
                    <label for="cellphone" class="form-label">Celular</label>
                    <div class="input-group">
                        <span class="input-group-text">+51</span>
                        <input type="text" id="cellphone" name="cellphone" class="form-control"
                            value="{{ old('cellphone', auth()->user()->cellphone) }}" required>
                    </div>
                </div>

                <!-- DNI -->
                <div class="mb-3">
                    <label for="dni" class="form-label">DNI</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bx bxs-id-card"></i></span>
                        <input type="text" id="dni" name="dni" class="form-control"
                            value="{{ old('dni', auth()->user()->dni) }}" required>
                    </div>
                </div>

                <!-- Contraseña -->
                <div class="mb-3">
                    <label for="password" class="form-label">Nueva Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bx bxs-lock"></i></span>
                        <input type="password" id="password" name="password" class="form-control"
                            placeholder="Dejar en blanco si no deseas cambiarla">
                    </div>
                </div>

                <!-- Botón de Guardar -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-warning">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
@endsection
