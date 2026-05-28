<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content">

            <div class="modal-header border-0 pb-0">
                <div class="modal-title-wrap">
                    <div class="modal-icon-badge bg-success-soft">
                        <i class="bi bi-book text-success"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold">Tambah Program Studi</h5>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="formTambah" action="{{ route('prodi.store') }}" method="POST">
                @csrf

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Program Studi <span
                                class="text-danger">*</span></label>
                        <input type="text" name="nama_prodi" class="form-control form-control-modal"
                            placeholder="Contoh: Teknik Informatika" required>
                        <div class="invalid-feedback" id="err_nama_prodi"></div>
                    </div>
                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-modal-submit">
                        <i class="bi bi-check-lg me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .modal-content {
        border-radius: 16px;
        border: none;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }

    .modal-icon-badge {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #e8f5e9;
    }

    .form-control-modal {
        border: 1.5px solid #e8e8e8;
        border-radius: 10px;
        padding: 0.6rem 1rem;
    }

    .btn-modal-cancel {
        background: #f5f5f5;
        color: #555;
        border: none;
        border-radius: 8px;
    }

    .btn-modal-submit {
        background: #4CAF50;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-weight: 600;
    }
</style>
