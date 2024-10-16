<!-- Modal for assigning team leader -->
<div class="modal fade" id="assignSellerModal" tabindex="-1" aria-labelledby="assignTeamLeaderModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignTeamLeaderModalLabel">Asignar Team Leader</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sucursales.assignSeller') }}" method="POST">
                    @csrf
                    <input type="hidden" name="branch_id" id="branchsId">
                    <div class="mb-3">
                        <label for="teamLeader" class="form-label">Seleccionar Vendedor</label>
                        <select class="form-control" name="seller" id="seller">
                            <option hidden value="">Seleccione</option>
                            @foreach ($sellers as $seller)
                                <option value="{{ $seller->id }}">{{ $seller->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Asignar</button>
                </form>
            </div>
        </div>
    </div>
</div>
