<!-- Modal para agregar un nuevo cliente -->
<div class="modal fade" id="addClientModal" tabindex="-1" aria-labelledby="addClientModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addClientModalLabel">Agregar Nuevo Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario para agregar un nuevo cliente -->
                <form id="addClientForm" action="{{ route('clientes.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="clientName" class="form-label">Nombre del Cliente</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class='bx bx-user'></i></span>
                            <input type="text" class="form-control text-uppercase" id="clientName"
                                placeholder="Ingresa el nombre" name="name">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="clientDni" class="form-label">DNI</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class='bx bx-id-card'></i></span>
                            <input type="text" class="form-control" id="clientDni" placeholder="Ingresa el DNI"
                                name="dni">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="clientPhone" class="form-label">Teléfono</label>
                        <div class="input-group">
                            <span class="input-group-text">+51</span>
                            <input type="text" class="form-control" id="clientPhone"
                                placeholder="Ingresa el teléfono" name="cellphone">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="clientEmail" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class='bx bx-envelope'></i></span>
                            <input type="email" class="form-control" id="clientEmail" placeholder="Ingresa el email"
                                name="email">
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar Cliente</button>
            </div>
            </form>
        </div>
    </div>
</div>
