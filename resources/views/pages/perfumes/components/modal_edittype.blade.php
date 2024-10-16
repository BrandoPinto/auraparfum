<div class="modal fade" id="modalEditType" tabindex="-1" aria-labelledby="editTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editTypeForm" action="{{ route('tipos.update', ['tipo' => '__tipo_id__']) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editTypeModalLabel">Editar Tipo de Fragancia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col mb-0">
                        <label for="emailWithTitle" class="form-label">Tipo <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class='bx bxs-droplet-half'></i></span>
                            <input type="text" class="form-control" id="editNameType" name="name_type">
                        </div>
                    </div>
                    <div class="mb-3 d-none">
                        <input type="text" id="editTypefragranceId" name="typefragrance_id">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
