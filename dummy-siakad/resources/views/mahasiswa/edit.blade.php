<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content modal-mahasiswa">

            <div class="modal-header border-0 pb-0">
                <div class="modal-title-wrap">
                    <div class="modal-icon-badge bg-primary-soft">
                        <i class="bi bi-pencil-square text-primary"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold" id="modalEditLabel">Edit Mahasiswa</h5>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="formEdit" action="{{ route('mahasiswa.update', $mahasiswa->nim) }}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="PUT">

                <div class="modal-body pt-3">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Program Studi <span
                                    class="text-danger">*</span></label>
                            <select name="prodi_id" class="form-select form-control-modal">
                                <option value="" disabled>-- Pilih Program Studi --</option>
                                @foreach ($programStudis as $prodi)
                                    <option value="{{ $prodi->prodi_id }}"
                                        {{ $mahasiswa->prodi_id == $prodi->prodi_id ? 'selected' : '' }}>
                                        {{ $prodi->nama_prodi }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" id="err_edit_prodi_id"></div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">NIM</label>
                            <input type="text" name="nim" class="form-control form-control-modal"
                                value="{{ $mahasiswa->nim }}" readonly>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label fw-semibold">Nama Mahasiswa <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="nama_mahasiswa" class="form-control form-control-modal"
                                value="{{ $mahasiswa->nama_mahasiswa }}">
                            <div class="invalid-feedback" id="err_edit_nama_mahasiswa"></div>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control form-control-modal"
                                value="{{ $mahasiswa->email }}">
                            <div class="invalid-feedback" id="err_edit_email"></div>
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
    .modal-mahasiswa {
        border-radius: 16px;
        border: none;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }

    .form-control-modal {
        border: 1.5px solid #e8e8e8;
        border-radius: 10px;
        padding: 0.55rem 0.9rem;
    }

    .btn-modal-cancel {
        background: #f5f5f5;
        color: #555;
        border: none;
        padding: 0.5rem 1.3rem;
        border-radius: 8px;
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
</style>
