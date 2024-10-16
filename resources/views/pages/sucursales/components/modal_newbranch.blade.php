<div class="modal fade" id="modalNewBranch" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Nuevo Lugar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-primary d-flex align-items-center" role="alert">
                    <i class='bx bx-info-circle bx-sm me-2'></i>
                    <div>
                        Si el tipo de lugar de trabajo es <strong>campo</strong>, no será necesario colocar la
                        dirección.
                    </div>
                </div>

                <form action="{{ route('sucursales.store') }}" method="POST">
                    @csrf
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="emailWithTitle" class="form-label">Nombre <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class='bx bx-home'></i></span>
                                <input required type="text" class="form-control text-uppercase"
                                    placeholder="Ingrese nombre" name="name_branch">
                            </div>
                        </div>
                        <div class="col mb-0">
                            <label for="emailWithTitle" class="form-label">Dirección</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class='bx bx-map'></i></span>
                                <input type="text" class="form-control" name="location">
                            </div>
                        </div>
                    </div>
                    <div class="row g-2 mt-2">
                        <label for="emailWithTitle" class="form-label">Tipo de lugar <span
                                class="text-danger">*</span></label>
                        <div class="input-group">
                            <select class="form-control" name="typework_id">
                                <option hidden>Seleccione</option>
                                @foreach ($types as $item)
                                    <option value="{{ $item->typework_id }}">{{ $item->type }}</option>
                                @endforeach
                            </select>
                        </div>
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
