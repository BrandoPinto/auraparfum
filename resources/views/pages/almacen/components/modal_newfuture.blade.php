<div class="modal fade" id="modalNewFuture" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Futuro Stock</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('futuro.store') }}" method="POST">
                    @csrf
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="emailWithTitle" class="form-label">Perfume <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bx bx-droplet"></i></span>
                                <select class="form-control" name="fragrance_id" id="">
                                    <option hidden>Seleccione</option>
                                    @foreach ($fragrances as $item)
                                        <option value="{{ $item->fragrance_id }}">{{ $item->name_fragrance }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col mb-0">
                            <label for="emailWithTitle" class="form-label">Envase <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bx bx-droplet"></i></span>
                                <select class="form-control" name="containers_id" id="">
                                    <option hidden>Seleccione</option>
                                    @foreach ($containers as $item)
                                        <option value="{{ $item->containers_id }}">{{ $item->ml }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2 mt-3">
                        <div class="col mb-0">
                            <label for="emailWithTitle" class="form-label">Stock <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bx bx-droplet"></i></span>
                                <input type="number" class="form-control" name="stock" placeholder="Stock">
                            </div>
                        </div>
                        <div class="col mb-0">
                            <label for="emailWithTitle" class="form-label">Fecha a salir <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                <input type="date" class="form-control" name="date" placeholder="Fecha">
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
