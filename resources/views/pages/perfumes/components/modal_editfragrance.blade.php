<div class="modal fade" id="modalEditFragrance" tabindex="-1" aria-labelledby="editTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editFragranceForm" action="{{ route('perfumes.update', ['perfume' => '__fragrance_id__']) }}"
                method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editTypeModalLabel">Editar Perfume</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-0">
                            <label for="emailWithTitle" class="form-label">Nombre
                                <div class="input-group">
                                    <span class="input-group-text"><i class='bx bx-user'></i></span>
                                    <input type="text" class="form-control" id="editNameFragrance"
                                        name="name_fragrance">
                                </div>
                        </div>

                    </div>
                    <div class="mb-3 d-none">
                        <input type="text" id="editFragranceId" name="fragrance_id">
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
