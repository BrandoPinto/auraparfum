<div class="container mt-4">
    <!-- Card para el Título -->
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center">
            <i class='bx bx-cart bx-lg me-2'></i>
            <h5 class="mb-0">NUEVA VENTA</h5>
        </div>
    </div>

    <!-- Formulario dentro de una Card -->
    <div class="card p-4">
        <form id="salesForm" method="POST" action="{{ route('ventas.store') }}">
            @csrf
            <div class="row g-3">
                <!-- Select de Clientes -->
                <div class="col-md-6">
                    <label for="clientSelect" class="form-label d-flex align-items-center">
                        <span>Cliente</span>
                        <i class='bx bx-plus-circle bx-sm ms-2'></i>
                    </label>
                    <select id="clientSelect" class="form-select" name="customers_id">
                        <option hidden value="">Selecciona un cliente</option>
                        @foreach ($customers as $item)
                            <option value="{{ $item->customers_id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Primer Select de Perfumes -->
                <div class="col-md-6">
                    <label for="fragranceSelect1" class="form-label">Perfume 1</label>
                    <select id="fragranceSelect1" name="perfumes[]" class="form-control" data-cost="">
                        <option hidden value="">Selecciona un perfume</option>
                        @foreach ($stock as $perfume)
                            <option value="{{ $perfume->branchstock_id }}"
                                data-fragrance="{{ $perfume->fragrance_name }}" data-cost="{{ $perfume->cost }}">
                                {{ $perfume->fragrance_name }} - {{ $perfume->ml }}ml</option>
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Segundo Select de Perfumes con Checkbox -->
                <div class="col-md-6">
                    <label for="fragranceSelect2" class="form-label">Perfume 2</label>
                    <select id="fragranceSelect2" name="perfumes[]" class="form-control" data-cost="" disabled>
                        <option hidden value="">Selecciona un perfume</option>
                        @foreach ($stock as $perfume)
                            <option value="{{ $perfume->branchstock_id }}"
                                data-fragrance="{{ $perfume->fragrance_name }}" data-cost="{{ $perfume->cost }}">
                                {{ $perfume->fragrance_name }} - {{ $perfume->ml }}ml
                            </option>
                        @endforeach
                    </select>
                    <div class="form-check mt-2">
                        <input type="checkbox" id="enableFragranceSelect2" class="form-check-input">
                        <label class="form-check-label" for="enableFragranceSelect2">¿Desea habilitar otro más?</label>
                    </div>
                </div>

                <!-- Tercer Select de Perfumes con Checkbox -->
                <div class="col-md-6">
                    <label for="fragranceSelect3" class="form-label">Perfume 3</label>
                    <select id="fragranceSelect3" name="perfumes[]" class="form-control" data-cost="" disabled>
                        <option hidden value="">Selecciona un perfume</option>
                        @foreach ($stock as $perfume)
                            <option value="{{ $perfume->branchstock_id }}"
                                data-fragrance="{{ $perfume->fragrance_name }}" data-cost="{{ $perfume->cost }}">
                                {{ $perfume->fragrance_name }} - {{ $perfume->ml }}ml
                            </option>
                        @endforeach
                    </select>
                    <div class="form-check mt-2">
                        <input type="checkbox" id="enableFragranceSelect3" class="form-check-input">
                        <label class="form-check-label" for="enableFragranceSelect3">¿Desea habilitar otro más?</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-4">
                    <label for="clientSelect" class="form-label d-flex align-items-center">
                        <span>Tipo de Pago</span>
                    </label>
                    <select id="clientSelect" class="form-select" name="typepayment_id">
                        <option hidden value="">Selecciona un cliente</option>
                        @foreach ($typePayment as $item)
                            <option value="{{ $item->typepayment_id }}">{{ $item->type_payment }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 row mt-4">
                    <div class="col-md-6">
                        <label for="totalCost" class="form-label">Total</label>
                        <input type="text" id="totalCost" class="form-control" style="background: #ede8d1" readonly>
                    </div>
                </div>
            </div>
            <!-- Botón de Enviar -->
            <div class="row mt-3">
                <div class="col-12">
                    <button type="submit" class="btn btn-warning w-100">Guardar Venta</button>
                </div>
            </div>
        </form>
    </div>
</div>
