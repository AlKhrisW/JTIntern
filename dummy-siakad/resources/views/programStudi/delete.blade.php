<div class="modal fade" id="modalDelete" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 420px;">
        <div class="modal-content">

            <div class="modal-body text-center p-4">
                <div class="delete-icon-wrap mb-3">
                    <div class="delete-icon-outer">
                        <div class="delete-icon-inner">
                            <i class="bi bi-trash3"></i>
                        </div>
                    </div>
                </div>

                <h5 class="fw-bold mb-2">Hapus Program Studi?</h5>
                <p class="text-muted mb-4">Anda akan menghapus:</p>

                <div class="mb-4 p-3 bg-light rounded">
                    <strong>{{ $programStudi->nama_prodi }}</strong>
                </div>

                <p class="text-danger small mb-4">
                    <i class="bi bi-exclamation-triangle me-1"></i>
                    Tindakan ini tidak dapat dibatalkan.
                </p>

                <form id="formDelete"
                    action="{{ route('prodi.destroy', $programStudi->prodi_id) }}"
                    method="POST">
                    @csrf

                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-modal-cancel flex-grow-1"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-modal-delete flex-grow-1">
                            <i class="bi bi-trash3 me-1"></i> Ya, Hapus
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .delete-icon-outer {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: #fff0f0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .delete-icon-inner {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: #ffebee;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: #e53935;
    }

    .btn-modal-cancel {
        background: #f5f5f5;
        color: #555;
        border: none;
        border-radius: 8px;
    }

    .btn-modal-delete {
        background: #e53935;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-weight: 600;
    }
</style>
