<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content modal-nilai">

            <div class="modal-header border-0 pb-0">
                <div class="modal-title-wrap">
                    <div class="modal-icon-badge bg-success-soft">
                        <i class="bi bi-journal-plus text-success"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold" id="modalTambahLabel">Tambah Nilai Mahasiswa</h5>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="formTambah" action="{{ route('nilai.store') }}" method="POST">
                @csrf

                <div class="modal-body pt-3">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Mahasiswa <span class="text-danger">*</span></label>
                            <select name="id_mahasiswa" class="form-select form-control-modal" id="selectMahasiswa">
                                <option value="" disabled selected>-- Pilih Mahasiswa --</option>
                                @foreach ($mahasiswas as $mhs)
                                    <option value="{{ $mhs->nim }}">{{ $mhs->nama_mahasiswa }} ({{ $mhs->nim }})</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" id="err_id_mahasiswa"></div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Mata Kuliah <span class="text-danger">*</span></label>
                            <select name="id_matkul" class="form-select form-control-modal">
                                <option value="" disabled selected>-- Pilih Mata Kuliah --</option>
                                @foreach ($mataKuliahs as $mk)
                                    <option value="{{ $mk->id_matkul }}">{{ $mk->nama_matkul }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" id="err_id_matkul"></div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nilai Angka <span class="text-danger">*</span></label>
                            <input type="number" name="nilai_angka" id="nilaiAngka"
                                min="0" max="4" step="0.01"
                                class="form-control form-control-modal" placeholder="0.00 – 4.00">
                            <div class="invalid-feedback" id="err_nilai_angka"></div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nilai Huruf <span class="text-danger">*</span></label>
                            <select name="nilai_huruf" id="nilaiHuruf" class="form-select form-control-modal">
                                <option value="" disabled selected>-- Pilih / Otomatis --</option>
                                <option value="A">A</option>
                                <option value="B+">B+</option>
                                <option value="B">B</option>
                                <option value="C+">C+</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                            </select>
                            <div class="invalid-feedback" id="err_nilai_huruf"></div>
                        </div>

                        {{-- Preview --}}
                        <div class="col-12" id="nilaiPreviewWrap" style="display:none;">
                            <div class="nilai-preview-card">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="preview-badge" id="previewBadge">-</div>
                                    <div>
                                        <div class="preview-label">Nilai Angka</div>
                                        <div class="preview-angka fw-bold" id="previewAngka">-</div>
                                    </div>
                                    <div class="ms-auto text-end">
                                        <div class="preview-label">Nilai Huruf</div>
                                        <div class="preview-huruf fw-bold" id="previewHuruf">-</div>
                                    </div>
                                </div>
                            </div>
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
    .modal-nilai {
        border-radius: 16px;
        border: none;
        box-shadow: 0 20px 60px rgba(0,0,0,.15);
    }
    .modal-title-wrap { display: flex; align-items: center; gap: 12px; }
    .modal-icon-badge {
        width: 42px; height: 42px; border-radius: 12px;
        display: flex; align-items: center; justify-content: center; font-size: 1.2rem;
    }
    .bg-success-soft { background: #e8f5e9; }
    .form-control-modal {
        border: 1.5px solid #e8e8e8; border-radius: 10px; padding: .55rem .9rem; transition: border-color .2s;
    }
    .form-control-modal:focus { border-color: #4CAF50; box-shadow: 0 0 0 3px rgba(76,175,80,.12); }
    .btn-modal-cancel { background: #f5f5f5; color: #555; border: none; padding: .5rem 1.3rem; border-radius: 8px; }
    .btn-modal-submit { background: #4CAF50; color: #fff; border: none; padding: .5rem 1.5rem; border-radius: 8px; font-weight: 600; }
    .nilai-preview-card {
        background: linear-gradient(135deg,#f8fffe,#e8f5e9);
        border: 1.5px solid #c8e6c9; border-radius: 12px; padding: 1rem 1.2rem;
    }
    .preview-badge {
        padding: .25rem .75rem; border-radius: 8px; background: #fff; border: 2px solid #4CAF50;
        font-size: 1rem; font-weight: 700; color: #2e7d32; flex-shrink: 0;
    }
    .preview-label { font-size: .7rem; font-weight: 600; color: #888; text-transform: uppercase; letter-spacing: .05em; }
    .preview-angka { font-size: 1.1rem; color: #1a1a1a; }
    .preview-huruf { font-size: 1.1rem; color: #1a1a1a; }
</style>

<script>
(function () {
    const nilaiAngkaInput  = document.getElementById('nilaiAngka');
    const nilaiHurufSelect = document.getElementById('nilaiHuruf');
    const previewWrap      = document.getElementById('nilaiPreviewWrap');
    const previewBadge     = document.getElementById('previewBadge');
    const previewAngka     = document.getElementById('previewAngka');
    const previewHuruf     = document.getElementById('previewHuruf');

    // 0-4 scale conversion
    function angkaToHuruf(n) {
        if (n >= 3.75) return 'A';
        if (n >= 3.25) return 'B+';
        if (n >= 2.75) return 'B';
        if (n >= 2.25) return 'C+';
        if (n >= 2.00) return 'C';
        if (n >= 1.00) return 'D';
        return 'E';
    }

    function updatePreview() {
        const angka = nilaiAngkaInput.value;
        const huruf = nilaiHurufSelect.value;
        if (angka !== '' || huruf) {
            previewWrap.style.display = 'block';
            previewAngka.textContent = angka !== '' ? parseFloat(angka).toFixed(2) : '-';
            previewHuruf.textContent = huruf || '-';
            previewBadge.textContent = huruf || (angka !== '' ? angkaToHuruf(parseFloat(angka)) : '-');
        } else {
            previewWrap.style.display = 'none';
        }
    }

    nilaiAngkaInput.addEventListener('input', function () {
        const n = parseFloat(this.value);
        if (this.value !== '') nilaiHurufSelect.value = angkaToHuruf(n);
        updatePreview();
    });

    nilaiHurufSelect.addEventListener('change', updatePreview);
})();
</script>