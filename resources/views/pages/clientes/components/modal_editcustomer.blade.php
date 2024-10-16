<div class="modal fade" id="modalEditCustomer" tabindex="-1" aria-labelledby="editCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editCustomerForm" action="{{ route('clientes.update', ['cliente' => '__cliente_id__']) }}"
                method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editCustomerModalLabel">Editar Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-0">
                            <label for="editNameCustomer" class="form-label">Nombre <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class='bx bx-user'></i></span>
                                <input type="text" class="form-control" id="editNameCustomer" name="name">
                            </div>
                        </div>
                        <div class="col mb-0">
                            <label for="editCellphoneCustomer" class="form-label">Teléfono <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class='bx bxs-phone'></i></span>
                                <input type="text" class="form-control" id="editCellphoneCustomer" name="cellphone">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-0">
                            <label for="editEmailCustomer" class="form-label">Email <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class='bx bxl-gmail'></i></span>
                                <input type="text" class="form-control" id="editEmailCustomer" name="email">
                            </div>
                        </div>
                        <div class="col mb-0">
                            <label for="editDniCustomer" class="form-label">DNI <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class='bx bx-id-card'></i></span>
                                <input type="text" class="form-control" id="editDniCustomer" name="dni">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 d-none">
                        <input type="text" id="editCustomerId" name="id">
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
