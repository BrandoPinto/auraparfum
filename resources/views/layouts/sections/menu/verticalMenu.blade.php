<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

    <!-- ! Hide app brand if navbar-full -->
    <div class="app-brand demo">
        <a href="{{ url('/dashboard') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('assets/img/logo/logo_aura.jpg') }}" alt="Logo" class="img-fluid"
                    style="max-width: 65px;">
            </span>
            <span class="app-brand-text demo menu-text fw-bold ms-2">Aura</span>
        </a>

        <a href="javascript:void(0);"
            class="layout-menu-toggle text-warning menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle rounded-circle bg-warning text-white d-flex justify-content-center align-items-center"
                style="width: 2rem; height: 2rem; font-size: 1.5rem;"></i>

        </a>
    </div>

    <div class="menu-inner-shadow"></div>
    @php
        $userRole = auth()->user()->idRole;
        $currentRouteName = Route::currentRouteName();
    @endphp

    <ul class="menu-inner py-1">
        {{-- Mostrar siempre el menú de Dashboard --}}
        <li class="menu-item">
            <a href="{{ url('/dashboard') }}"
                class="menu-link {{ $currentRouteName === 'dashboard' ? 'bg-warning text-white' : '' }}">
                <i class="bx bxs-dashboard"></i>
                <div class="text ps-3">Inicio</div>
            </a>
        </li>

        {{-- Menú según el rol 1 (Administración) --}}
        @if ($userRole === 1)
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Perfumes</span>
            </li>
            <li class="menu-item">
                <a href="{{ route('perfumes.index') }}"
                    class="menu-link {{ str_contains($currentRouteName, 'perfumes') ? 'bg-warning text-white' : '' }}">
                    <i class="bx bx-droplet"></i>
                    <div class="text ps-3">Perfumes</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('tipos.index') }}"
                    class="menu-link {{ str_contains($currentRouteName, 'tipos') ? 'bg-warning text-white' : '' }}">
                    <i class="bx bxs-droplet-half"></i>
                    <div class="text ps-3">Tipos de Perfume</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('envases.index') }}"
                    class="menu-link {{ str_contains($currentRouteName, 'envases') ? 'bg-warning text-white' : '' }}">
                    <i class="bx bx-water"></i>
                    <div class="text ps-3">Envases</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('almacen.index') }}"
                    class="menu-link {{ str_contains($currentRouteName, 'almacen') || str_contains($currentRouteName, 'historial') ? 'bg-warning text-white' : '' }}">
                    <i class='bx bxs-objects-vertical-bottom'></i>
                    <div class="text ps-3">Almacén General</div>
                </a>
            </li>

            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Finanzas</span>
            </li>
            <li class="menu-item">
                <a href="{{ route('ingresos.index') }}"
                    class="menu-link {{ str_contains($currentRouteName, 'ingresos') ? 'bg-warning text-white' : '' }}">
                    <i class="bx bx-money"></i>
                    <div class="text ps-3">Mis Ingresos</div>
                </a>
            </li>
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Trabajo</span>
            </li>
            <li class="menu-item">
                <a href="{{ route('usuarios.index') }}"
                    class="menu-link {{ str_contains($currentRouteName, 'usuarios') ? 'bg-warning text-white' : '' }}">
                    <i class="bx bx-user"></i>
                    <div class="text ps-3">Usuarios</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('sucursales.index') }}"
                    class="menu-link {{ str_contains($currentRouteName, 'sucursales') ? 'bg-warning text-white' : '' }}">
                    <i class="bx bxs-store"></i>
                    <div class="text ps-3">Lugar de Trabajo</div>
                </a>
            </li>
        @endif

        {{-- Menú según el rol 2 (Tienda) --}}
        @if ($userRole === 2)
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Trabajo</span>
            </li>
            <li class="menu-item">
                <a href="{{ route('sucursales.index') }}"
                    class="menu-link {{ str_contains($currentRouteName, 'sucursales') ? 'bg-warning text-white' : '' }}">
                    <i class="bx bxs-store"></i>
                    <div class="text ps-3">Lugar de Trabajo</div>
                </a>
            </li>
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Usuarios</span>
            </li>
            <li class="menu-item">
                <a href="{{ route('clientes.index') }}"
                    class="menu-link {{ str_contains($currentRouteName, 'clientes') ? 'bg-warning text-white' : '' }}">
                    <i class="bx bxs-store-alt"></i>
                    <div class="text ps-3">Mis clientes</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('sellers.list') }}"
                    class="menu-link {{ str_contains($currentRouteName, 'sellers.list') ? 'bg-warning text-white' : '' }}">
                    <i class="bx bxs-store-alt"></i>
                    <div class="text ps-3">Vendedores</div>
                </a>
            </li>
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Finanzas</span>
            </li>
            <li class="menu-item">
                <a href="{{ route('ingresos.usuarios') }}"
                    class="menu-link {{ str_contains($currentRouteName, 'ingresos.usuarios') ? 'bg-warning text-white' : '' }}">
                    <i class="bx bx-money"></i>
                    <div class="text ps-3">Mis finanzas</div>
                </a>
            </li>
        @endif
        @if ($userRole === 3)
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Stock</span>
            </li>
            <li class="menu-item">
                <a href="{{ route('sucursal.usuario.listado') }}"
                    class="menu-link  {{ str_contains($currentRouteName, 'sucursal.usuario.listado') || str_contains($currentRouteName, 'sucursal.usuario.detalle') ? 'bg-warning text-white' : '' }}">
                    <i class="bx bxs-store-alt"></i>
                    <div class="text ps-3">Stock Tienda</div>
                </a>
            </li>
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Clientes</span>
            </li>
            <li class="menu-item">
                <a href="{{ route('clientes.index') }}"
                    class="menu-link {{ str_contains($currentRouteName, 'clientes') ? 'bg-warning text-white' : '' }}">
                    <i class="bx bxs-store-alt"></i>
                    <div class="text ps-3">Mis clientes</div>
                </a>
            </li>
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Finanzas</span>
            </li>
            <li class="menu-item">
                <a href="{{ route('ingresos.usuarios') }}"
                    class="menu-link {{ str_contains($currentRouteName, 'ingresos.usuarios') ? 'bg-warning text-white' : '' }}">
                    <i class="bx bx-money"></i>
                    <div class="text ps-3">Mis finanzas</div>
                </a>
            </li>
        @endif
        {{-- Elementos comunes para todos los roles --}}
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Otros Páginas</span>
        </li>
        <li class="menu-item">
            <a href="{{ route('users.my.profile') }}"
                class="menu-link {{ str_contains($currentRouteName, 'users.my.profile') ? 'bg-warning text-white' : '' }}">
                <i class="bx bx-user"></i>
                <div class="text ps-3">Perfil</div>
            </a>
        </li>
        <li class="menu-item">
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit"
                    class="menu-link w-100 text-start border-0 bg-transparent {{ $currentRouteName === 'logout' ? 'bg-warning text-white' : '' }}"
                    style="cursor: pointer;">
                    <i class="bx bx-log-out"></i>
                    <div class="text ps-3">Cerrar Sesión</div>
                </button>
            </form>
        </li>
    </ul>

</aside>
