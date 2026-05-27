<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content modal-matkul">

            <div class="modal-header border-0 pb-0">
                <div class="modal-title-wrap">
                    <div class="modal-icon-badge bg-primary-soft">
                        <i class="bi bi-pencil-square text-primary"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold" id="modalEditLabel">Edit Mata Kuliah</h5>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="formEdit" action="{{ route('admin.mata_kuliah.update_ajax', $mataKuliah->id_matkul) }}"
                method="POST">
                @csrf
                <input type="hidden" name="_method" value="PUT">

                <div class="modal-body pt-3">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">ID Matkul</label>
                            <input type="text" name="id_matkul" class="form-control form-control-modal"
                                value="{{ $mataKuliah->id_matkul }}" readonly>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label fw-semibold">Nama Mata Kuliah <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="nama_matkul" class="form-control form-control-modal"
                                value="{{ $mataKuliah->nama_matkul }}">
                            <div class="invalid-feedback" id="err_edit_nama_matkul"></div>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Program Studi <span
                                    class="text-danger">*</span></label>
                            <select name="prodi_id" class="form-select form-control-modal">
                                <option value="" disabled>-- Pilih Program Studi --</option>
                                @foreach ($programStudis as $prodi)
                                    <option value="{{ $prodi->prodi_id }}"
                                        {{ $mataKuliah->prodi_id == $prodi->prodi_id ? 'selected' : '' }}>
                                        {{ $prodi->nama_program_studi }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" id="err_edit_prodi_id"></div>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Keahlian</label>
                            <textarea name="keahlian" rows="5" class="form-control form-control-modal">{{ $mataKuliah->keahlian }}</textarea>
                            <div class="invalid-feedback" id="err_edit_keahlian"></div>
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
    .modal-matkul {
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
