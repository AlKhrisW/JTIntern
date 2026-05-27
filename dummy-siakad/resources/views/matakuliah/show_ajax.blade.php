<div class="modal fade" id="modalShow" tabindex="-1" aria-labelledby="modalShowLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content modal-matkul">

            <div class="modal-header border-0 pb-0">
                <div class="modal-title-wrap">
                    <div class="modal-icon-badge bg-info-soft">
                        <i class="bi bi-eye text-info"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold" id="modalShowLabel">Detail Mata Kuliah</h5>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body pt-3">
                <div class="show-header-card mb-4">
                    <h5 class="fw-bold mb-1">{{ $mataKuliah->nama_matkul }}</h5>
                    <span class="badge badge-prodi">{{ $mataKuliah->programStudi->nama_program_studi ?? '-' }}</span>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="detail-item">
                            <div class="detail-label">ID Matkul</div>
                            <div class="detail-value">{{ $mataKuliah->id_matkul }}</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="detail-item">
                            <div class="detail-label">Keahlian / Kompetensi</div>
                            <div class="detail-value detail-keahlian">
                                {{ $mataKuliah->keahlian }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal">Tutup</button>
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

    .show-header-card {
        background: linear-gradient(135deg, #f8fffe, #e8f5e9);
        border: 1.5px solid #c8e6c9;
        border-radius: 12px;
        padding: 1.2rem 1.4rem;
    }

    .badge-prodi {
        background: #e8f5e9;
        color: #2e7d32;
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-size: 0.82rem;
        font-weight: 500;
    }

    .detail-item {
        background: #fafafa;
        border-radius: 10px;
        padding: 0.85rem 1rem;
        border: 1px solid #f0f0f0;
    }

    .detail-label {
        font-size: 0.72rem;
        font-weight: 700;
        color: #888;
        text-transform: uppercase;
        margin-bottom: 0.4rem;
    }

    .detail-value {
        font-size: 0.92rem;
        color: #1a1a1a;
    }

    .detail-keahlian {
        white-space: pre-wrap;
        line-height: 1.6;
    }

    .btn-modal-cancel {
        background: #f5f5f5;
        color: #555;
        border: none;
        padding: 0.5rem 1.3rem;
        border-radius: 8px;
    }
</style>
