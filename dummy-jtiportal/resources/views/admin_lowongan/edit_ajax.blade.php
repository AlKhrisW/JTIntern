<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content modal-lowongan">
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

            <form id="formEdit" action="{{ route('lowongan.update_ajax', $lowongan->lowongan_id) }}"
                method="POST">

                @csrf
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="perusahaan_id" value="{{ $lowongan->perusahaan_id }}">

                <div class="modal-body pt-3">
                    <div class="row g-3">

                        {{-- Nama Perusahaan --}}
                        <div class="edit-company-card col-12">
                            <div class="d-flex align-items-center gap-3">
                                @if ($lowongan->perusahaan->logo)
                                    <img src="{{ asset('storage/' . $lowongan->perusahaan->logo) }}"
                                        alt="{{ $lowongan->perusahaan->nama_perusahaan }}" class="edit-logo-img">
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
                            <label class="form-label fw-semibold">Posisi Lowongan <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="posisi" class="form-control form-control-modal"
                                value="{{ $lowongan->posisi }}" placeholder="Contoh: Fullstack Developer" required>
                            <div class="invalid-feedback" id="err_edit_posisi"></div>
                        </div>

                        {{-- Periode --}}
                        <div class="col-3">
                            <i class="bi bi-calendar3 me-1"></i>
                            <label class="form-label fw-semibold">Periode (bulan) <span
                                    class="text-danger">*</span></label>
                            <input type="number" min="1" name="periode" class="form-control form-control-modal"
                                value="{{ $lowongan->periode }}" placeholder="Contoh: 6" required>
                            <div class="invalid-feedback" id="err_edit_periode"></div>
                        </div>

                        {{-- Min IPK --}}
                        <div class="col-2">
                            <i class="bi bi-mortarboard me-1"></i>
                            <label class="form-label fw-semibold">Min IPK <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" min="0" max="4" name="ipk_min"
                                class="form-control form-control-modal"
                                value="{{ number_format($lowongan->ipk_min, 2, '.', '') }}" placeholder="Contoh: 3.00"
                                required>
                            <div class="invalid-feedback" id="err_edit_ipk_min"></div>
                        </div>

                        {{-- Insentif --}}
                        <div class="col-2">
                            <i class="bi bi-cash-stack me-1"></i>
                            <label class="form-label fw-semibold">Insentif <span class="text-danger">*</span></label>
                            <select name="insentif" class="form-select form-control-modal" required>
                                <option value="" disabled>-- Pilih Jenis --</option>
                                <option value="paid" {{ $lowongan->insentif == 'paid' ? 'selected' : '' }}>Paid
                                </option>
                                <option value="unpaid" {{ $lowongan->insentif == 'unpaid' ? 'selected' : '' }}>Unpaid
                                </option>
                                <option value="flexible" {{ $lowongan->insentif == 'flexible' ? 'selected' : '' }}>
                                    Flexible</option>
                            </select>
                            <div class="invalid-feedback" id="err_edit_insentif"></div>
                        </div>

                        {{-- Skill --}}
                        <div class="col-5">
                            <i class="bi bi-code-square me-1"></i>
                            <label class="form-label fw-semibold">Skills <span class="text-danger">*</span></label>
                            <textarea name="skill" rows="3" class="form-control form-control-modal"
                                placeholder="Contoh: HTML, CSS, JavaScript" required>{{ $lowongan->skill }}</textarea>
                            <div class="invalid-feedback" id="err_edit_skill"></div>
                        </div>

                        {{-- Tools --}}
                        <div class="col-5">
                            <i class="bi bi-laptop me-1"></i>
                            <label class="form-label fw-semibold">Tools <span class="text-danger">*</span></label>
                            <textarea name="tools" rows="3" class="form-control form-control-modal"
                                placeholder="Contoh: VS Code, Figma, MySQL" required>{{ $lowongan->tools }}</textarea>
                            <div class="invalid-feedback" id="err_edit_tools"></div>
                        </div>

                        {{-- Status --}}
                        <div class="col-2">
                            <i class="bi bi-info-circle me-1"></i>
                            <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select form-control-modal" required>
                                <option value="" disabled>-- Pilih Status --</option>
                                <option value="Aktif" {{ $lowongan->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Selesai" {{ $lowongan->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                            <div class="invalid-feedback" id="err_edit_status"></div>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="col-12">
                            <i class="bi bi-text-left me-1"></i>
                            <label class="form-label fw-semibold">Deskripsi <span class="text-danger">*</span></label>
                            <textarea name="deskripsi" rows="3" class="form-control form-control-modal"
                                placeholder="Deskripsi singkat tentang lowongan" required>{{ $lowongan->deskripsi }}</textarea>
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

    .edit-logo-img {
        width: 44px;
        height: 44px;
        object-fit: contain;
        border-radius: 10px;
        border: 1px solid #eee;
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

        function showError(name, message) {
            const el = document.querySelector('#formEdit [name="' + name + '"]');
            const errEl = document.getElementById('err_edit_' + name);

            if (el) el.classList.add('is-invalid');
            if (errEl) errEl.textContent = message;
        }

        function clearError(el) {
            el.classList.remove('is-invalid');
            const errEl = document.getElementById('err_edit_' + el.name);
            if (errEl) errEl.textContent = '';
        }

        function clearAllErrors() {
            document.querySelectorAll('#formEdit .form-control-modal, #formEdit select')
                .forEach(function(el) {
                    el.classList.remove('is-invalid');
                });
            document.querySelectorAll('#formEdit [id^="err_edit_"]')
                .forEach(function(el) {
                    el.textContent = '';
                });
        }

        document.querySelectorAll('#formEdit .form-control-modal, #formEdit select')
            .forEach(function(el) {
                el.addEventListener('input', function() {
                    clearError(el);
                });
                el.addEventListener('change', function() {
                    clearError(el);
                });
            });

        function validateForm() {
            let valid = true;
            clearAllErrors();

            const posisi = document.querySelector('[name="posisi"]');
            if (!posisi.value.trim()) {
                showError('posisi', 'Posisi wajib diisi.');
                valid = false;
            }

            const periode = document.querySelector('[name="periode"]');
            if (!periode.value || periode.value <= 0) {
                showError('periode', 'Periode wajib diisi.');
                valid = false;
            }

            const ipk = document.querySelector('[name="ipk_min"]');
            if (!ipk.value || ipk.value < 0 || ipk.value > 4) {
                showError('ipk_min', 'IPK harus antara 0 - 4.');
                valid = false;
            }

            const insentif = document.querySelector('[name="insentif"]');
            if (!insentif.value) {
                showError('insentif', 'Insentif wajib dipilih.');
                valid = false;
            }

            const skill = document.querySelector('[name="skill"]');
            if (!skill.value.trim()) {
                showError('skill', 'Skill wajib diisi.');
                valid = false;
            }

            const tools = document.querySelector('[name="tools"]');
            if (!tools.value.trim()) {
                showError('tools', 'Tools wajib diisi.');
                valid = false;
            }

            const deskripsi = document.querySelector('[name="deskripsi"]');
            if (!deskripsi.value.trim()) {
                showError('deskripsi', 'Deskripsi wajib diisi.');
                valid = false;
            }

            return valid;
        }

        const form = document.getElementById('formEdit');
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                if (!validateForm()) {
                    const firstInvalid = form.querySelector('.is-invalid');
                    if (firstInvalid) {
                        firstInvalid.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        firstInvalid.focus();
                    }
                    return;
                }

                const submitBtn = form.querySelector('[type="submit"]');

                submitBtn.disabled = true;
                submitBtn.innerHTML =
                    '<span class="spinner-border spinner-border-sm me-1"></span> Menyimpan...';

                fetch(form.action, {
                        method: 'POST',
                        body: new FormData(form),
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {

                        if (data.status) {
                            const modal = bootstrap.Modal.getInstance(
                                document.getElementById('modalEdit')
                            );

                            if (modal) modal.hide();
                            $('#tabelLowongan').DataTable().ajax.reload(null, false);
                        } else {
                            if (data.msgField) {
                                Object.entries(data.msgField)
                                    .forEach(([field, messages]) => {
                                        showError(field, messages[0]);
                                    });
                            }
                        }
                    })
                    .catch(() => {
                        alert('Terjadi kesalahan server.');
                    })
                    .finally(() => {

                        submitBtn.disabled = false;
                        submitBtn.innerHTML =
                            '<i class="bi bi-check-lg me-1"></i> Perbarui';
                    });
            });
        }
    });
</script>