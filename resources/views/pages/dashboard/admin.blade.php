<div class="col-lg-12 mb-4 order-0">
    <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-sm-7">
                <div class="card-body">
                    @if (auth()->check())
                        <h5 class="card-title text-primary">¡Bienvenido, {{ auth()->user()->name }}! 🎉</h5>
                    @else
                        <h5 class="card-title text-primary">¡Bienvenido! 🎉</h5>
                    @endif
                    <p class="mb-4">Esté es el panel administrativo <span class="fw-medium"></span><br>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Tarjetas de Ingresos y Ventas -->
<div class="col-lg-12 mb-4">
    <div class="row">
        <!-- Tarjeta de Ingresos -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class='bx bx-dollar-circle bx-sm text-primary'></i> <!-- Icono de ingresos con color -->
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Ingresos {{ $currentMonthName }}</span>
                    <h3 class="card-title mb-2">S/ {{ $totalIncome }}</h3>
                    <small class="text-success fw-semibold"><i class='bx bx-up-arrow-alt'></i></small>
                </div>
            </div>
        </div>
        <!-- Tarjeta de Ventas -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class='bx bx-cart bx-sm text-success'></i> <!-- Icono de ventas con color -->
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Cantidad Ventas {{ $currentMonthName }}</span>
                    <h3 class="card-title text-nowrap mb-1">{{ $totalSales }}</h3>
                    <small class="text-success fw-medium"><i class='bx bx-up-arrow-alt'></i></small>
                </div>
            </div>
        </div>
        <!-- Tarjeta de Total Perfumes -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class='bx bx-droplet bx-sm text-warning'></i> <!-- Icono de perfumes con color -->
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Total Perfumes</span>
                    <h3 class="card-title mb-2">{{ $cantFragrances }}</h3>
                    <small class="text-success fw-semibold"><i class='bx bx-up-arrow-alt'></i></small>
                </div>
            </div>
        </div>
        <!-- Tarjeta de Total Usuarios -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class='bx bx-user bx-sm text-info'></i> <!-- Icono de usuarios con color -->
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Total Usuarios</span>
                    <h3 class="card-title text-nowrap mb-1">{{ $cantUsers }}</h3>
                    <small class="text-success fw-medium"><i class='bx bx-up-arrow-alt'></i></small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-12 mb-4">
    <div class="card">
        <div class="row row-bordered g-0">
            <div class="col-md-12">
                <h5 class="card-header m-0 me-2 pb-3">Top Vendedores {{ $currentMonthName }}</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Celular</th>
                                <th>Cantidad de Ventas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($topSellers as $index => $seller)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $seller->name }}</td>
                                    <td>{{ $seller->cellphone }}</td>
                                    <td>{{ $seller->quantity }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- Total Revenue
<div class="col-12 mb-4">
    <div class="card">
        <div class="row row-bordered g-0">
            <div class="col-md-12">
                <h5 class="card-header m-0 me-2 pb-3">Stock</h5>
                <div id="totalRevenueChart" class="px-2"></div>
            </div>
        </div>
    </div>
</div>
-->
