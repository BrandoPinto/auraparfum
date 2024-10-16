<div class="modal fade" id="modalNewType" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Nuevo Tipo de Perfume</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('tipos.store') }}" method="POST">
                    @csrf
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label class="form-label">Nuevo tipo <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class='bx bxs-droplet-half'></i></span>
                                <input required type="text" class="form-control" placeholder="Ingrese nuevo tipo"
                                    name="name_type">
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
