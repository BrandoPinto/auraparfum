<div class="modal fade" id="modalEditContainers" tabindex="-1" aria-labelledby="editContainerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editTypeForm" action="{{ route('envases.update', ['envase' => '__containers_id__']) }}"
                method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editTypeModalLabel">Editar Envase</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col mb-0">
                        <label for="emailWithTitle" class="form-label">Ml <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class='bx bx-water'></i></span>
                            <input type="text" class="form-control" id="editMl" name="ml">
                        </div>
                    </div>
                    <div class="col mb-0 mt-2">
                        <label for="emailWithTitle" class="form-label">Precio <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">S/</span>
                            <input type="number" class="form-control" id="editCost" name="cost">
                        </div>
                    </div>
                    <div class="mb-3 d-none">
                        <input type="text" id="editContainersId" name="containers_id">
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
