<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content modal-lowongan">

            <div class="modal-header border-0 pb-0">
                <div class="modal-title-wrap">
                    <div class="modal-icon-badge bg-success-soft">
                        <i class="bi bi-file-earmark-plus-fill text-success"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold" id="modalTambahLabel">Tambah Lowongan Magang</h5>
                        <p class="text-muted small mb-0">Isi data lowongan magang dengan lengkap</p>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="formTambah"
                action="{{ route('admin.lowongan.store_ajax') }}"
                method="POST"
                enctype="multipart/form-data">
                @csrf

                <div class="modal-body pt-3">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <i class="bi bi-building"></i>
                            <label class="form-label fw-semibold">
                                Nama Perusahaan <span class="text-danger">*</span>
                            </label>
                            <select name="perusahaan_id"
                                class="form-select form-control-modal select2-perusahaan">

                                <option value="" selected disabled>
                                    -- Pilih Perusahaan --
                                </option>

                                @foreach($perusahaans as $perusahaan)
                                <option value="{{ $perusahaan->perusahaan_id }}">
                                    {{ $perusahaan->nama_perusahaan }}
                                </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" id="err_perusahaan_id"></div>
                        </div>

                        {{-- Posisi Lowongan --}}
                        <div class="col-6">
                            <i class="bi bi-person-square me-1"></i>
                            <label class="form-label fw-semibold">Posisi <span class="text-danger">*</span></label>
                            <input type="text" name="posisi" class="form-control form-control-modal"
                                placeholder="Contoh: Frontend Developer Intern">
                            <div class="invalid-feedback" id="err_posisi"></div>
                        </div>

                        {{-- Periode --}}
                        <div class="col-4">
                            <i class="bi bi-calendar3 me-1"></i>
                            <label class="form-label fw-semibold">Periode (bulan) <span class="text-danger">*</span></label>
                            <input type="number" name="periode" class="form-control form-control-modal"
                                placeholder="Contoh: 6">
                            <div class="invalid-feedback" id="err_periode"></div>
                        </div>

                        {{-- Min IPK --}}
                        <div class="col-4">
                            <i class="bi bi-mortarboard me-1"></i>
                            <label class="form-label fw-semibold">Min IPK <span class="text-danger">*</span></label>
                            <input type="text" name="ipk_min" class="form-control form-control-modal"
                                placeholder="Contoh: 3.00">
                            <div class="invalid-feedback" id="err_ipk_min"></div>
                        </div>

                        {{-- Insentif --}}
                        <div class="col-4">
                            <i class="bi bi-cash-stack me-1"></i>
                            <label class="form-label fw-semibold">Insentif <span class="text-danger">*</span></label>
                            <select name="insentif" class="form-select form-control-modal">
                                <option value="" disabled selected>-- Pilih Jenis --</option>
                                <option value="paid">Paid</option>
                                <option value="unpaid">Unpaid</option>
                                <option value="flexible">Flexible</option>
                            </select>
                            <div class="invalid-feedback" id="err_insentif"></div>
                        </div>

                        {{-- Skills --}}
                        <div class="col-6">
                            <i class="bi bi-code-square me-1"></i>
                            <label class="form-label fw-semibold">Skills <span class="text-danger">*</span></label>
                            <textarea name="skills" rows="3" class="form-control form-control-modal"
                                placeholder="Keterangan skill yang dibutuhkan (contoh: HTML, CSS, JavaScript)"></textarea>
                            <div class="invalid-feedback" id="err_skill"></div>
                        </div>

                        {{-- Tools --}}
                        <div class="col-6">
                            <i class="bi bi-laptop me-1"></i>
                            <label class="form-label fw-semibold">Tools <span class="text-danger">*</span></label>
                            <textarea name="tools" rows="3" class="form-control form-control-modal"
                                placeholder="Keterangan tools/perangkat yang dibutuhkan (contoh: Visual Studio Code)"></textarea>
                            <div class="invalid-feedback" id="err_tools"></div>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="col-12">
                            <i class="bi bi-text-left me-1"></i>
                            <label class="form-label fw-semibold">Deskripsi <span class="text-danger">*</span></label>
                            <textarea name="deskripsi" rows="3" class="form-control form-control-modal"
                                placeholder="Deskripsi singkat tentang lowongan"></textarea>
                            <div class="invalid-feedback" id="err_tools"></div>
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

    .bg-success-soft {
        background: #e8f5e9;
    }

    .form-control-modal {
        border: 1.5px solid #e8e8e8;
        border-radius: 10px;
        padding: 0.55rem 0.9rem;
        font-size: 0.9rem;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .form-control-modal:focus {
        border-color: #4CAF50;
        box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.12);
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
        border-color: #4CAF50;
        background: #f9fffe;
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

    .btn-modal-submit:hover {
        background: #388e3c;
        color: #fff;
    }

    .select2-container .select2-selection--single {
        height: 44px !important;
        border: 1.5px solid #e8e8e8 !important;
        border-radius: 10px !important;
        padding: 0.35rem 0.75rem;
        display: flex !important;
        align-items: center;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: normal !important;
        color: #333;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 100% !important;
        right: 10px;
    }

    .select2-dropdown {
        border-radius: 10px !important;
        border: 1px solid #ddd !important;
        overflow: hidden;
    }

    .select2-search__field {
        border-radius: 8px !important;
        padding: 6px 10px !important;
    }
</style>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // INIT SELECT2
        $('.select2-perusahaan').select2({
            placeholder: '-- Pilih Perusahaan --',
            width: '100%',
            dropdownParent: $('#modalTambah')
        });
    });

    document.addEventListener('DOMContentLoaded', function() {

        // ── Logo preview ──────────────────────────────────────────────
        var input = document.getElementById('logoInput');
        if (input) {
            input.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var img = document.getElementById('logoImg');
                        var preview = document.getElementById('logoPreview');
                        img.src = e.target.result;
                        img.classList.remove('d-none');
                        preview.classList.add('d-none');
                    };
                    reader.readAsDataURL(this.files[0]);
                }
            });
        }

        // ── Helper: tampilkan / hapus error ──────────────────────────
        function showError(name, message) {
            var el = document.querySelector('#formTambah [name="' + name + '"]');
            var errEl = document.getElementById('err_' + name);
            if (el) el.classList.add('is-invalid');
            if (errEl) errEl.textContent = message;
        }

        function clearError(el) {
            el.classList.remove('is-invalid');
            var errEl = document.getElementById('err_' + el.name);
            if (errEl) errEl.textContent = '';
        }

        function clearAllErrors() {
            document.querySelectorAll('#formTambah .form-control-modal, #formTambah select').forEach(function(el) {
                el.classList.remove('is-invalid');
            });
            document.querySelectorAll('#formTambah [id^="err_"]').forEach(function(el) {
                el.textContent = '';
            });
        }

        // ── Clear error saat user mengetik / memilih ─────────────────
        document.querySelectorAll('#formTambah .form-control-modal, #formTambah select').forEach(function(el) {
            el.addEventListener('input', function() {
                clearError(el);
            });
            el.addEventListener('change', function() {
                clearError(el);
            });
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
                try {
                    new URL(webCareer.value.trim());
                } catch (_) {
                    showError('web_career', 'Format URL tidak valid. Contoh: https://...');
                    valid = false;
                }
            }

            var logoFile = document.getElementById('logoInput');
            if (logoFile.files && logoFile.files[0]) {
                var file = logoFile.files[0];
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
            form.addEventListener('submit', function(e) {
                e.preventDefault(); // SELALU cegah submit native

                if (!validateForm()) {
                    // Scroll ke field pertama yang error
                    var firstInvalid = form.querySelector('.is-invalid');
                    if (firstInvalid) {
                        firstInvalid.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        firstInvalid.focus();
                    }
                    return; // berhenti di sini, tidak kirim ke server
                }

                // Lolos validasi → kirim AJAX
                var submitBtn = form.querySelector('[type="submit"]');
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Menyimpan...';

                fetch(form.action, {
                        method: 'POST',
                        body: new FormData(form),
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                    })
                    .then(function(res) {
                        return res.json();
                    })
                    .then(function(data) {
                        if (data.status) {
                            var modal = bootstrap.Modal.getInstance(document.getElementById('modalTambah'));
                            if (modal) modal.hide();

                            // Reload DataTable kalau ada, atau reload halaman
                            if (window.$ && $.fn.dataTable && $.fn.dataTable.isDataTable('#tabelPerusahaan')) {
                                $('#tabelPerusahaan').DataTable().ajax.reload(null, false);
                            } else {
                                location.reload();
                            }
                        } else {
                            // Validasi server-side gagal → tampilkan error per field
                            if (data.msgField) {
                                Object.entries(data.msgField).forEach(function([field, messages]) {
                                    showError(field, messages[0]);
                                });
                                var firstInvalid = form.querySelector('.is-invalid');
                                if (firstInvalid) firstInvalid.scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'center'
                                });
                            } else {
                                alert(data.message || 'Terjadi kesalahan.');
                            }
                        }
                    })
                    .catch(function() {
                        alert('Gagal terhubung ke server. Silakan coba lagi.');
                    })
                    .finally(function() {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = '<i class="bi bi-check-lg me-1"></i> Simpan';
                    });
            });
        }

        // ── Reset form saat modal ditutup ────────────────────────────
        var modalEl = document.getElementById('modalTambah');
        if (modalEl) {
            modalEl.addEventListener('hidden.bs.modal', function() {
                form.reset();
                clearAllErrors();
                document.getElementById('logoImg').classList.add('d-none');
                document.getElementById('logoPreview').classList.remove('d-none');
            });
        }
    });
</script>