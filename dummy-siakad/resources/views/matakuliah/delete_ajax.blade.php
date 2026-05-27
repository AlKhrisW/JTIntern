<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
        <div class="modal-content modal-matkul">

            <div class="modal-body text-center p-4">
                <div class="delete-icon-wrap mb-3">
                    <div class="delete-icon-outer">
                        <div class="delete-icon-inner">
                            <i class="bi bi-trash3"></i>
                        </div>
                    </div>
                </div>

                <h5 class="fw-bold mb-1">Hapus Mata Kuliah?</h5>
                <p class="text-muted mb-3">Anda akan menghapus mata kuliah berikut:</p>

                <div class="delete-item-card mb-4">
                    <strong>{{ $mataKuliah->nama_matkul }}</strong><br>
                    <small class="text-muted">{{ $mataKuliah->id_matkul }}</small>
                </div>

                <p class="text-danger small mb-4">
                    <i class="bi bi-exclamation-triangle me-1"></i>
                    Tindakan ini tidak dapat dibatalkan.
                </p>

                <form id="formDelete" action="{{ route('admin.mata_kuliah.destroy_ajax', $mataKuliah->id_matkul) }}"
                    method="POST">
                    @csrf

                    <div class="d-flex gap-2 justify-content-center">
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
    .modal-matkul {
        border-radius: 16px;
        border: none;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }

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
        font-size: 1.4rem;
        color: #e53935;
    }

    .delete-item-card {
        background: #fafafa;
        border: 1.5px solid #f0f0f0;
        border-radius: 12px;
        padding: 1rem;
    }

    .btn-modal-cancel {
        background: #f5f5f5;
        color: #555;
        border: none;
        padding: 0.55rem 1.3rem;
        border-radius: 8px;
    }

    .btn-modal-delete {
        background: #e53935;
        color: #fff;
        border: none;
        padding: 0.55rem 1.3rem;
        border-radius: 8px;
        font-weight: 600;
    }
</style>
