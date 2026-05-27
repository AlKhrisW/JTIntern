<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content modal-perusahaan">

            <div class="modal-header border-0 pb-0">
                <div class="modal-title-wrap">
                    <div class="modal-icon-badge bg-success-soft">
                        <i class="bi bi-building-add text-success"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold" id="modalTambahLabel">Tambah Perusahaan</h5>
                        <p class="text-muted small mb-0">Isi data perusahaan atau instansi dengan lengkap</p>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="formTambah"
                  action="{{ route('admin.perusahaan.store_ajax') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf

                <div class="modal-body pt-3">
                    <div class="row g-3">

                        {{-- Nama Perusahaan --}}
                        <div class="col-12">
                            <label class="form-label fw-semibold">Nama Perusahaan <span class="text-danger">*</span></label>
                            <input type="text" name="nama_perusahaan" class="form-control form-control-modal"
                                   placeholder="Contoh: PT. Maju Bersama Indonesia">
                            <div class="invalid-feedback" id="err_nama_perusahaan"></div>
                        </div>

                        {{-- Jenis Perusahaan --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Jenis Perusahaan <span class="text-danger">*</span></label>
                            <select name="jenis_perusahaan" class="form-select form-control-modal">
                                <option value="" disabled selected>-- Pilih Jenis --</option>
                                <option value="swasta">Swasta</option>
                                <option value="swasta nasional">Swasta Nasional</option>
                                <option value="BUMN">BUMN</option>
                                <option value="instansi pendidikan">Instansi Pendidikan</option>
                            </select>
                            <div class="invalid-feedback" id="err_jenis_perusahaan"></div>
                        </div>

                        {{-- Lokasi --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Lokasi <span class="text-danger">*</span></label>
                            <input type="text" name="lokasi" class="form-control form-control-modal"
                                   placeholder="Contoh: Malang, Jawa Timur">
                            <div class="invalid-feedback" id="err_lokasi"></div>
                        </div>

                        {{-- Profil Perusahaan --}}
                        <div class="col-12">
                            <label class="form-label fw-semibold">Profil Perusahaan <span class="text-danger">*</span></label>
                            <textarea name="profil_perusahaan" rows="3" class="form-control form-control-modal"
                                      placeholder="Deskripsi singkat tentang perusahaan..."></textarea>
                            <div class="invalid-feedback" id="err_profil_perusahaan"></div>
                        </div>

                        {{-- Web Career --}}
                        <div class="col-md-8">
                            <label class="form-label fw-semibold">Website / Career Page</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-link-45deg text-muted"></i>
                                </span>
                                <input type="url" name="web_career" class="form-control form-control-modal border-start-0"
                                       placeholder="https://careers.perusahaan.com">
                            </div>
                            <div class="invalid-feedback d-block" id="err_web_career"></div>
                        </div>

                        {{-- Logo Upload --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Logo Perusahaan</label>
                            <input type="file" name="logo" id="logoInput" accept="image/*"
                                   class="form-control form-control-modal">
                            <div class="small text-muted mt-1" id="logoFileName"></div>
                            <div class="invalid-feedback d-block" id="err_logo"></div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer border-0 pt-0">
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
.modal-perusahaan { border-radius: 16px; border: none; box-shadow: 0 20px 60px rgba(0,0,0,0.15); }
.modal-header { padding: 1.5rem 1.5rem 1rem; }
.modal-title-wrap { display: flex; align-items: center; gap: 0.85rem; }
.modal-icon-badge {
    width: 44px; height: 44px; border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.2rem;
}
.bg-success-soft { background: #e8f5e9; }
.form-control-modal {
    border: 1.5px solid #e8e8e8;
    border-radius: 10px;
    padding: 0.55rem 0.9rem;
    font-size: 0.9rem;
    transition: border-color 0.2s, box-shadow 0.2s;
}
.form-control-modal:focus {
    border-color: #4CAF50;
    box-shadow: 0 0 0 3px rgba(76,175,80,0.12);
}
.form-control-modal.is-invalid { border-color: #e53935; }
.input-group .input-group-text { border-radius: 10px 0 0 10px; border: 1.5px solid #e8e8e8; border-right: none; }
.input-group .form-control-modal { border-radius: 0 10px 10px 0; }

.btn-modal-cancel {
    background: #f5f5f5; color: #555; border: none;
    padding: 0.5rem 1.3rem; border-radius: 8px; font-weight: 500;
}
.btn-modal-cancel:hover { background: #e0e0e0; }
.btn-modal-submit {
    background: #4CAF50; color: #fff; border: none;
    padding: 0.5rem 1.5rem; border-radius: 8px; font-weight: 600;
}
.btn-modal-submit:hover { background: #388e3c; color: #fff; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // ── Tampilkan nama file saat dipilih ─────────────────────────
    var input = document.getElementById('logoInput');
    if (input) {
        input.addEventListener('change', function () {
            var label = document.getElementById('logoFileName');
            if (this.files && this.files[0]) {
                label.textContent = '📎 ' + this.files[0].name;
            } else {
                label.textContent = '';
            }
        });
    }

    // ── Helper: tampilkan / hapus error ──────────────────────────
    function showError(name, message) {
        var el    = document.querySelector('#formTambah [name="' + name + '"]');
        var errEl = document.getElementById('err_' + name);
        if (el)    el.classList.add('is-invalid');
        if (errEl) errEl.textContent = message;
    }

    function clearError(el) {
        el.classList.remove('is-invalid');
        var errEl = document.getElementById('err_' + el.name);
        if (errEl) errEl.textContent = '';
    }

    function clearAllErrors() {
        document.querySelectorAll('#formTambah .form-control-modal, #formTambah select').forEach(function (el) {
            el.classList.remove('is-invalid');
        });
        document.querySelectorAll('#formTambah [id^="err_"]').forEach(function (el) {
            el.textContent = '';
        });
    }

    // ── Clear error saat user mengetik / memilih ─────────────────
    document.querySelectorAll('#formTambah .form-control-modal, #formTambah select').forEach(function (el) {
        el.addEventListener('input',  function () { clearError(el); });
        el.addEventListener('change', function () { clearError(el); });
    });

    // ── Validasi client-side ──────────────────────────────────────
    function validateForm() {
        var valid = true;
        clearAllErrors();

        var nama = document.querySelector('#formTambah [name="nama_perusahaan"]');
        if (!nama.value.trim()) {
            showError('nama_perusahaan', 'Nama perusahaan wajib diisi.');
            valid = false;
        }

        var jenis = document.querySelector('#formTambah [name="jenis_perusahaan"]');
        if (!jenis.value) {
            showError('jenis_perusahaan', 'Jenis perusahaan wajib dipilih.');
            valid = false;
        }

        var lokasi = document.querySelector('#formTambah [name="lokasi"]');
        if (!lokasi.value.trim()) {
            showError('lokasi', 'Lokasi wajib diisi.');
            valid = false;
        }

        var profil = document.querySelector('#formTambah [name="profil_perusahaan"]');
        if (!profil.value.trim()) {
            showError('profil_perusahaan', 'Profil perusahaan wajib diisi.');
            valid = false;
        }

        var webCareer = document.querySelector('#formTambah [name="web_career"]');
        if (webCareer.value.trim()) {
            try { new URL(webCareer.value.trim()); }
            catch (_) {
                showError('web_career', 'Format URL tidak valid. Contoh: https://...');
                valid = false;
            }
        }

        var logoFile = document.getElementById('logoInput');
        if (logoFile.files && logoFile.files[0]) {
            var file    = logoFile.files[0];
            var allowed = ['image/jpeg', 'image/png', 'image/svg+xml', 'image/webp'];
            if (!allowed.includes(file.type)) {
                showError('logo', 'File harus berupa gambar (JPG, PNG, SVG, WebP).');
                valid = false;
            } else if (file.size > 2 * 1024 * 1024) {
                showError('logo', 'Ukuran logo maksimal 2MB.');
                valid = false;
            }
        }

        return valid;
    }

    // ── Submit: validasi dulu, baru AJAX ─────────────────────────
    var form = document.getElementById('formTambah');
    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            if (!validateForm()) {
                var firstInvalid = form.querySelector('.is-invalid');
                if (firstInvalid) {
                    firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstInvalid.focus();
                }
                return;
            }

            var submitBtn = form.querySelector('[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Menyimpan...';

            fetch(form.action, {
                method:  'POST',
                body:    new FormData(form),
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
            })
            .then(function (res) { return res.json(); })
            .then(function (data) {
                if (data.status) {
                    var modal = bootstrap.Modal.getInstance(document.getElementById('modalTambah'));
                    if (modal) modal.hide();

                    if (window.$ && $.fn.dataTable && $.fn.dataTable.isDataTable('#tabelPerusahaan')) {
                        $('#tabelPerusahaan').DataTable().ajax.reload(null, false);
                    } else {
                        location.reload();
                    }
                } else {
                    if (data.msgField) {
                        Object.entries(data.msgField).forEach(function ([field, messages]) {
                            showError(field, messages[0]);
                        });
                        var firstInvalid = form.querySelector('.is-invalid');
                        if (firstInvalid) firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    } else {
                        alert(data.message || 'Terjadi kesalahan.');
                    }
                }
            })
            .catch(function () {
                alert('Gagal terhubung ke server. Silakan coba lagi.');
            })
            .finally(function () {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="bi bi-check-lg me-1"></i> Simpan';
            });
        });
    }

    // ── Reset form saat modal ditutup ────────────────────────────
    var modalEl = document.getElementById('modalTambah');
    if (modalEl) {
        modalEl.addEventListener('hidden.bs.modal', function () {
            form.reset();
            clearAllErrors();
            document.getElementById('logoFileName').textContent = '';
        });
    }
});
</script>