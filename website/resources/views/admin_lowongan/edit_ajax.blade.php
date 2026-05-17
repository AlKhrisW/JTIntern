<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content modal-lowongan">

            <!-- <div class="modal-header">
                <h5 class="fw-bold">Edit Lowongan</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div> -->
            <div class="modal-header border-0 pb-0">
                <div class="modal-title-wrap">
                    <div class="modal-icon-badge bg-primary-soft">
                        <i class="bi bi-pencil-square text-primary"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold" id="modalEditLabel">Edit Lowongan</h5>
                        <p class="text-muted small mb-0">Perbarui data lowongan</p>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="formEdit" action="{{ route('admin.lowongan.update_ajax', $lowongan->lowongan_id) }}"
                method="POST" enctype="multipart/form-data">

                @csrf
                <input type="hidden" name="_method" value="PUT">

                <div class="modal-body pt-3">
                    <div class="row g-3">

                        {{-- Nama Perusahaan --}}
                        <div class="edit-company-card col-12">
                            <div class="d-flex align-items-center gap-3">
                                @if($lowongan->perusahaan->logo)
                                <img src="{{ asset('storage/' . $lowongan->perusahaan->logo) }}"
                                    alt="{{ $lowongan->perusahaan->nama_perusahaan }}"
                                    class="edit-logo-img">
                                @else
                                <div class="edit-logo-placeholder">
                                    {{ strtoupper(substr($lowongan->perusahaan->nama_perusahaan, 0, 2)) }}
                                </div>
                                @endif
                                <div class="text-start">
                                    <div class="fw-semibold">{{ $lowongan->posisi }}</div>
                                    <div class="text-muted small">{{ $lowongan->perusahaan->nama_perusahaan }}</div>
                                </div>
                            </div>
                        </div>

                        {{-- Posisi Lowongan --}}
                        <div class="col-5">
                            <i class="bi bi-person-square me-1"></i>
                            <label class="form-label fw-semibold">Posisi Lowongan <span class="text-danger">*</span></label>
                            <input type="text" name="posisi_lowongan" class="form-control form-control-modal"
                                value="{{ $lowongan->posisi }}"
                                placeholder="Contoh: Fullstack Developer">
                            <div class="invalid-feedback" id="err_edit_posisi_lowongan"></div>
                        </div>

                        {{-- Periode --}}
                        <div class="col-3">
                            <i class="bi bi-calendar3 me-1"></i>
                            <label class="form-label fw-semibold">Periode (bulan) <span class="text-danger">*</span></label>
                            <input type="number" name="periode" class="form-control form-control-modal"
                                value="{{ $lowongan->periode }}"
                                placeholder="Contoh: 6">
                            <div class="invalid-feedback" id="err_edit_periode"></div>
                        </div>

                        {{-- Min IPK --}}
                        <div class="col-2">
                            <i class="bi bi-mortarboard me-1"></i>
                            <label class="form-label fw-semibold">Min IPK <span class="text-danger">*</span></label>
                            <input type="text" name="ipk_min" class="form-control form-control-modal"
                                value="{{ number_format($lowongan->ipk_min, 2, '.', '') }}"
                                placeholder="Contoh: 3.00">
                            <div class="invalid-feedback" id="err_edit_ipk_min"></div>
                        </div>

                        {{-- Insentif --}}
                        <div class="col-2">
                            <i class="bi bi-cash-stack me-1"></i>
                            <label class="form-label fw-semibold">Insentif <span class="text-danger">*</span></label>
                            <select name="insentif" class="form-select form-control-modal">
                                <option value="" disabled>-- Pilih Jenis --</option>
                                <option value="paid" {{ $lowongan->insentif == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="unpaid" {{ $lowongan->insentif == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                                <option value="flexible" {{ $lowongan->insentif == 'flexible' ? 'selected' : '' }}>Flexible</option>
                            </select>
                            <div class="invalid-feedback" id="err_edit_insentif"></div>
                        </div>

                        {{-- Skill --}}
                        <div class="col-6">
                            <i class="bi bi-code-square me-1"></i>
                            <label class="form-label fw-semibold">Skills <span class="text-danger">*</span></label>
                            <input type="text" name="skill" class="form-control form-control-modal"
                                value="{{ $lowongan->skill }}"
                                placeholder="Contoh: Pemrograman dasar">
                            <div class="invalid-feedback" id="err_edit_skill"></div>
                        </div>

                        {{-- Tools --}}
                        <div class="col-6">
                            <i class="bi bi-laptop me-1"></i>
                            <label class="form-label fw-semibold">Tools <span class="text-danger">*</span></label>
                            <input type="text" name="tools" class="form-control form-control-modal"
                                value="{{ $lowongan->tools }}"
                                placeholder="Contoh: MySQL">
                            <div class="invalid-feedback" id="err_edit_tools"></div>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="col-12">
                            <i class="bi bi-text-left me-1"></i>
                            <label class="form-label fw-semibold">Deskripsi <span class="text-danger">*</span></label>
                            <textarea name="deskripsi" rows="3" class="form-control form-control-modal"
                                placeholder="Deskripsi singkat tentang lowongan">{{ $lowongan->deskripsi }}</textarea>
                            <div class="invalid-feedback" id="err_edit_deskripsi"></div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-modal-submit btn-primary-modal">
                        <i class="bi bi-check-lg me-1"></i> Perbarui
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<style>
    .modal-lowongan {
        border-radius: 16px;
        border: none;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }

    .modal-header {
        padding: 1.5rem 1.5rem 1rem;
    }

    .modal-title-wrap {
        display: flex;
        align-items: center;
        gap: 0.85rem;
    }

    .modal-icon-badge {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    .edit-company-card {
        background: #fafafa;
        border: 1.5px solid #f0f0f0;
        border-radius: 12px;
        padding: 0.9rem 1.1rem;
        text-align: left;
    }

    .edit-logo-img {
        width: 44px;
        height: 44px;
        object-fit: contain;
        border-radius: 10px;
        border: 1px solid #eee;
    }

    .edit-logo-placeholder {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.88rem;
        color: #2e7d32;
    }

    .bg-primary-soft {
        background: #e3f2fd;
    }

    .form-control-modal {
        border: 1.5px solid #e8e8e8;
        border-radius: 10px;
        padding: 0.55rem 0.9rem;
        font-size: 0.9rem;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .form-control-modal:focus {
        border-color: #1976d2;
        box-shadow: 0 0 0 3px rgba(25, 118, 210, 0.12);
    }

    .form-control-modal.is-invalid {
        border-color: #e53935;
    }

    .input-group .input-group-text {
        border-radius: 10px 0 0 10px;
        border: 1.5px solid #e8e8e8;
        border-right: none;
    }

    .input-group .form-control-modal {
        border-radius: 0 10px 10px 0;
    }

    label.logo-upload-area {
        display: block;
        border: 2px dashed #d0d0d0;
        border-radius: 10px;
        cursor: pointer;
        transition: border-color 0.2s, background 0.2s;
        overflow: hidden;
        height: 90px;
        margin-bottom: 0;
    }

    label.logo-upload-area:hover {
        border-color: #1976d2;
        background: #f0f7ff;
    }

    .logo-preview {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%;
    }

    .logo-preview-img {
        width: 100%;
        height: 90px;
        object-fit: contain;
    }

    .x-small {
        font-size: 0.7rem;
    }

    .btn-modal-cancel {
        background: #f5f5f5;
        color: #555;
        border: none;
        padding: 0.5rem 1.3rem;
        border-radius: 8px;
        font-weight: 500;
    }

    .btn-modal-cancel:hover {
        background: #e0e0e0;
    }

    .btn-modal-submit {
        background: #4CAF50;
        color: #fff;
        border: none;
        padding: 0.5rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
    }

    .btn-primary-modal {
        background: #1976d2 !important;
    }

    .btn-primary-modal:hover {
        background: #1565c0 !important;
        color: #fff;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('logoEditInput');
        if (input) {
            input.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.getElementById('logoEditImg');
                        const placeholder = document.getElementById('logoEditPlaceholder');
                        img.src = e.target.result;
                        img.classList.remove('d-none');
                        if (placeholder) placeholder.classList.add('d-none');
                    };
                    reader.readAsDataURL(this.files[0]);
                }
            });
        }
    });
</script>