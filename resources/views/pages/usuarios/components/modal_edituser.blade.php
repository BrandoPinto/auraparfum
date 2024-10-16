<div class="modal fade" id="modalEditUser" tabindex="-1" aria-labelledby="editTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editTypeForm" action="{{ route('usuarios.update', ['usuario' => '__tipo_id__']) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editTypeModalLabel">Editar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-0">
                            <label for="emailWithTitle" class="form-label">Name <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class='bx bx-user'></i></span>
                                <input type="text" class="form-control" id="editNameUser" name="name">
                            </div>
                        </div>
                        <div class="col mb-0">
                            <label for="emailWithTitle" class="form-label">Cellphone <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class='bx bxs-phone'></i></span>
                                <input type="text" class="form-control" id="editCellphoneUser" name="cellphone">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-0">
                            <label for="emailWithTitle" class="form-label">Email <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class='bx bxl-gmail'></i></span>
                                <input type="text" class="form-control" id="editEmailUser" name="email">
                            </div>
                        </div>
                        <div class="col mb-0">
                            <label for="emailWithTitle" class="form-label">Password <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class='bx bx-lock-alt'></i></span>
                                <input type="password" class="form-control" name="editPasswordUser">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 d-none">
                        <input type="text" id="editUserId" name="id">
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
