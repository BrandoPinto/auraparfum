<div class="modal fade" id="modalNewEnvase" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Nuevo Envase</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('envases.store') }}" method="POST">
                    @csrf
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="emailWithTitle" class="form-label">Ml <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class='bx bx-droplet'></i></span>
                                <input required type="number" class="form-control" placeholder="Ingrese Ml"
                                    name="ml">
                            </div>
                        </div>
                        <div class="col mb-0">
                            <label for="emailWithTitle" class="form-label">Precio <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">S/</span>
                                <input required type="number" class="form-control"
                                    placeholder="Ingrese precio de envase" name="cost">
                            </div>
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
