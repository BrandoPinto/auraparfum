<div class="modal fade" id="modalSucursal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Llevar stock a sucursal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="alertMessage" class="alert alert-warning" role="alert">
                    <i class="bx bx-error-circle"></i> El stock a llevar no puede ser mayor que el stock actual.
                </div>
                <form action="{{ route('stock.sucursal') }}" method="POST">
                    @csrf
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="emailWithTitle" class="form-label">Stock a llevar <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class='bx bx-droplet'></i></span>
                                <input required type="number" class="form-control" placeholder="Ingrese stock"
                                    name="stock">
                            </div>
                        </div>
                        <div class="col mb-0">
                            <label for="emailWithTitle" class="form-label">Sucursal <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bx bxs-store-alt"></i></span>
                                <select class="form-control" name="branch_id" id="">
                                    <option hidden>Seleccione</option>
                                    @foreach ($branch as $item)
                                        <option value="{{ $item->branch_id }}">{{ $item->name_branch }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2 mt-2 d-none">
                        <input required type="number" id="warehouseId" class="form-control" name="warehouse_id">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Registrar</button>
            </div>
            </form>
        </div>
    </div>
</div>
