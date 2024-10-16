@if (session('success'))
    <div id="success-toast" class="bs-toast toast toast-placement-ex fade show m-2 bg-primary" role="alert"
        aria-live="assertive" aria-atomic="true" data-bs-delay="5000" data-bs-autohide="true"
        style="position: fixed; bottom: 0; right: 0;">
        <div class="toast-header">
            <i class='bx bxs-check-circle p-2'></i>
            <div class="me-auto fw-medium">Éxito</div>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{ session('success') }}
        </div>
    </div>
@endif

@if (session('error'))
    <div id="error-toast" class="bs-toast toast toast-placement-ex fade show m-2 bg-danger" role="alert"
        aria-live="assertive" aria-atomic="true" data-bs-delay="5000" data-bs-autohide="true"
        style="position: fixed; bottom: 0; right: 0;">
        <div class="toast-header">
            <i class='bx bxs-x-circle p-2'></i>
            <div class="me-auto fw-medium">Error</div>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{ session('error') }}
        </div>
    </div>
@endif

<script>
    window.setTimeout(function() {
        var successToast = document.getElementById('success-toast');
        if (successToast) {
            var bootstrapToast = new bootstrap.Toast(successToast);
            bootstrapToast.hide();
        }

        var errorToast = document.getElementById('error-toast');
        if (errorToast) {
            var bootstrapToast = new bootstrap.Toast(errorToast);
            bootstrapToast.hide();
        }
    }, 3000);
</script>
