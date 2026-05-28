<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content modal-perusahaan">

            <div class="modal-header border-0 pb-0">
                <div class="modal-title-wrap">
                    <div class="modal-icon-badge bg-primary-soft">
                        <i class="bi bi-pencil-square text-primary"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold" id="modalEditLabel">Edit Perusahaan</h5>
                        <p class="text-muted small mb-0">Perbarui data perusahaan atau instansi</p>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="formEdit"
                  action="{{ route('admin.perusahaan.update_ajax', $perusahaan->perusahaan_id) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">

                <div class="modal-body pt-3">
                    <div class="row g-3">

                        {{-- Nama Perusahaan --}}
                        <div class="col-12">
                            <label class="form-label fw-semibold">Nama Perusahaan <span class="text-danger">*</span></label>
                            <input type="text" name="nama_perusahaan" class="form-control form-control-modal"
                                   value="{{ $perusahaan->nama_perusahaan }}"
                                   placeholder="Contoh: PT. Maju Bersama Indonesia">
                            <div class="invalid-feedback" id="err_edit_nama_perusahaan"></div>
                        </div>

                        {{-- Jenis Perusahaan --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Jenis Perusahaan <span class="text-danger">*</span></label>
                            <select name="jenis_perusahaan" class="form-select form-control-modal">
                                <option value="" disabled>-- Pilih Jenis --</option>
                                <option value="swasta"              {{ $perusahaan->jenis_perusahaan == 'swasta'              ? 'selected' : '' }}>Swasta</option>
                                <option value="swasta nasional"     {{ $perusahaan->jenis_perusahaan == 'swasta nasional'     ? 'selected' : '' }}>Swasta Nasional</option>
                                <option value="BUMN"                {{ $perusahaan->jenis_perusahaan == 'BUMN'                ? 'selected' : '' }}>BUMN</option>
                                <option value="instansi pendidikan" {{ $perusahaan->jenis_perusahaan == 'instansi pendidikan' ? 'selected' : '' }}>Instansi Pendidikan</option>
                            </select>
                            <div class="invalid-feedback" id="err_edit_jenis_perusahaan"></div>
                        </div>

                        {{-- Lokasi --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Lokasi <span class="text-danger">*</span></label>
                            <input type="text" name="lokasi" class="form-control form-control-modal"
                                   value="{{ $perusahaan->lokasi }}"
                                   placeholder="Contoh: Malang, Jawa Timur">
                            <div class="invalid-feedback" id="err_edit_lokasi"></div>
                        </div>

                        {{-- Profil Perusahaan --}}
                        <div class="col-12">
                            <label class="form-label fw-semibold">Profil Perusahaan <span class="text-danger">*</span></label>
                            <textarea name="profil_perusahaan" rows="3" class="form-control form-control-modal"
                                      placeholder="Deskripsi singkat tentang perusahaan...">{{ $perusahaan->profil_perusahaan }}</textarea>
                            <div class="invalid-feedback" id="err_edit_profil_perusahaan"></div>
                        </div>

                        {{-- Web Career --}}
                        <div class="col-md-8">
                            <label class="form-label fw-semibold">Website / Career Page</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-link-45deg text-muted"></i>
                                </span>
                                <input type="url" name="web_career" class="form-control form-control-modal border-start-0"
                                       value="{{ $perusahaan->web_career }}"
                                       placeholder="https://careers.perusahaan.com">
                            </div>
                            <div class="invalid-feedback d-block" id="err_edit_web_career"></div>
                        </div>

                        {{-- Logo Upload --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Logo Perusahaan</label>

                            <input type="file" name="logo" id="logoEditInput" accept="image/*" class="d-none">

                            <div class="input-group">
                                <label for="logoEditInput"
                                       class="form-control form-control-modal logo-path-display text-truncate mb-0"
                                       id="logoEditDisplay"
                                       title="{{ $perusahaan->logo ?? '' }}">
                                    <span class="logo-text {{ $perusahaan->logo ? '' : 'text-muted' }}">
                                        {{ $perusahaan->logo ?? 'Pilih file gambar...' }}
                                    </span>
                                </label>
                                <label for="logoEditInput" class="btn btn-browse mb-0">Browse</label>
                            </div>

                            <div class="invalid-feedback d-block" id="err_edit_logo"></div>
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
.modal-perusahaan { border-radius: 16px; border: none; box-shadow: 0 20px 60px rgba(0,0,0,0.15); }
.modal-header { padding: 1.5rem 1.5rem 1rem; }
.modal-title-wrap { display: flex; align-items: center; gap: 0.85rem; }
.modal-icon-badge {
    width: 44px; height: 44px; border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.2rem;
}
.bg-primary-soft { background: #e3f2fd; }
.form-control-modal {
    border: 1.5px solid #e8e8e8; border-radius: 10px;
    padding: 0.55rem 0.9rem; font-size: 0.9rem;
    transition: border-color 0.2s, box-shadow 0.2s;
}
.form-control-modal:focus {
    border-color: #1976d2;
    box-shadow: 0 0 0 3px rgba(25,118,210,0.12);
}
.form-control-modal.is-invalid { border-color: #e53935; }
.input-group .input-group-text { border-radius: 10px 0 0 10px; border: 1.5px solid #e8e8e8; border-right: none; }
.input-group .form-control-modal { border-radius: 0 10px 10px 0; }

.logo-path-display {
    border-radius: 10px 0 0 10px !important;
    border-right: none !important;
    background: #fff;
    color: #555;
    cursor: pointer;
    user-select: none;
    min-width: 0;
    flex: 1 1 0;
    display: flex;
    align-items: center;
    min-height: calc(1.5em + 1.1rem + 3px);
}
.logo-text { font-size: 0.88rem; }

.btn-browse {
    background: #f0f0f0;
    border: 1.5px solid #e8e8e8;
    border-left: none;
    border-radius: 0 10px 10px 0 !important;
    font-size: 0.85rem;
    font-weight: 500;
    color: #444;
    padding: 0 0.85rem;
    white-space: nowrap;
    cursor: pointer;
    display: flex;
    align-items: center;
    transition: background 0.15s;
}
.btn-browse:hover { background: #e0e0e0; color: #222; }

.btn-modal-cancel {
    background: #f5f5f5; color: #555; border: none;
    padding: 0.5rem 1.3rem; border-radius: 8px; font-weight: 500;
}
.btn-modal-cancel:hover { background: #e0e0e0; }
.btn-modal-submit {
    background: #4CAF50; color: #fff; border: none;
    padding: 0.5rem 1.5rem; border-radius: 8px; font-weight: 600;
}
.btn-primary-modal { background: #1976d2 !important; }
.btn-primary-modal:hover { background: #1565c0 !important; color: #fff; }
</style>