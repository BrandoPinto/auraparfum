<div class="modal fade" id="modalEditBranch" tabindex="-1" aria-labelledby="editTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editTypeForm" action="{{ route('sucursales.update', ['sucursale' => '__sucursal_id__']) }}"
                method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editTypeModalLabel">Editar Sucursal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col mb-0">
                        <label for="emailWithTitle" class="form-label">Nombre: <span
                                class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class='bx bxs-store'></i></span>
                            <input type="text" class="form-control text-uppercase" id="editNameBranch"
                                name="name_branch">
                        </div>
                    </div>
                    <div class="mb-3 d-none">
                        <input type="text" id="editBranchId" name="branch_id">
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
