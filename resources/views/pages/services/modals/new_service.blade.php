<div class="modal fade" id="modalNewService" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Nuevo Servicio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('new.service') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nombre del servicio <span class="text-danger">*</span></label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                    class="bx bx-category"></i></span>
                            <input required type="text" class="form-control text-uppercase"
                                placeholder="Nombre del servicio" name="service" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Tipo de pago para servicio <span
                                    class="text-danger">*</span></label>
                            <select required class="form-control" name="idtypeofpayment">
                                <option hidden>Seleccione tipo</option>
                                @foreach ($typesofpayment as $item)
                                    <option value="{{ $item->idtypeofpayment }}">{{ $item->type }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Registrar</button>
            </div>
            </form>
        </div>
    </div>
</div>
