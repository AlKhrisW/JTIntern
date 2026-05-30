<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content modal-nilai">

            <div class="modal-header border-0 pb-0">
                <div class="modal-title-wrap">
                    <div class="modal-icon-badge bg-primary-soft">
                        <i class="bi bi-pencil-square text-primary"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold" id="modalEditLabel">Edit Nilai Mahasiswa</h5>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="formEdit" action="{{ route('nilai.update', $nilai->id_nilai) }}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="PUT">

                <div class="modal-body pt-3">
                    <div class="row g-3">

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">ID Nilai</label>
                            <input type="text" class="form-control form-control-modal"
                                value="{{ $nilai->id_nilai }}" readonly>
                        </div>

                        <div class="col-md-8">
                            <label class="form-label fw-semibold">Mahasiswa <span class="text-danger">*</span></label>
                            <select name="id_mahasiswa" class="form-select form-control-modal">
                                <option value="" disabled>-- Pilih Mahasiswa --</option>
                                @foreach ($mahasiswas as $mhs)
                                    <option value="{{ $mhs->nim }}"
                                        {{ $nilai->id_mahasiswa == $mhs->nim ? 'selected' : '' }}>
                                        {{ $mhs->nama_mahasiswa }} ({{ $mhs->nim }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" id="err_edit_id_mahasiswa"></div>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Mata Kuliah <span class="text-danger">*</span></label>
                            <select name="id_matkul" class="form-select form-control-modal">
                                <option value="" disabled>-- Pilih Mata Kuliah --</option>
                                @foreach ($mataKuliahs as $mk)
                                    <option value="{{ $mk->id_matkul }}"
                                        {{ $nilai->id_matkul == $mk->id_matkul ? 'selected' : '' }}>
                                        {{ $mk->nama_matkul }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" id="err_edit_id_matkul"></div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nilai Angka <span class="text-danger">*</span></label>
                            <input type="number" name="nilai_angka" id="editNilaiAngka"
                                min="0" max="4" step="0.01"
                                class="form-control form-control-modal"
                                value="{{ number_format($nilai->nilai_angka, 2) }}">
                            <div class="invalid-feedback" id="err_edit_nilai_angka"></div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nilai Huruf <span class="text-danger">*</span></label>
                            <select name="nilai_huruf" id="editNilaiHuruf" class="form-select form-control-modal">
                                <option value="" disabled>-- Pilih Nilai Huruf --</option>
                                @foreach (['A', 'B+', 'B', 'C+', 'C', 'D', 'E'] as $huruf)
                                    <option value="{{ $huruf }}"
                                        {{ $nilai->nilai_huruf == $huruf ? 'selected' : '' }}>
                                        {{ $huruf }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" id="err_edit_nilai_huruf"></div>
                        </div>

                        {{-- Preview --}}
                        <div class="col-12">
                            <div class="nilai-preview-card">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="preview-badge" id="editPreviewBadge">{{ $nilai->nilai_huruf }}</div>
                                    <div>
                                        <div class="preview-label">Nilai Angka</div>
                                        <div class="preview-angka fw-bold" id="editPreviewAngka">{{ number_format($nilai->nilai_angka, 2) }}</div>
                                    </div>
                                    <div class="ms-auto text-end">
                                        <div class="preview-label">Nilai Huruf</div>
                                        <div class="preview-huruf fw-bold" id="editPreviewHuruf">{{ $nilai->nilai_huruf }}</div>
                                    </div>
                                </div>
                            </div>
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
    .modal-nilai { border-radius: 16px; border: none; box-shadow: 0 20px 60px rgba(0,0,0,.15); }
    .modal-title-wrap { display: flex; align-items: center; gap: 12px; }
    .modal-icon-badge { width: 42px; height: 42px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; }
    .bg-primary-soft { background: #e3f2fd; }
    .form-control-modal { border: 1.5px solid #e8e8e8; border-radius: 10px; padding: .55rem .9rem; }
    .form-control-modal:focus { border-color: #1976d2; box-shadow: 0 0 0 3px rgba(25,118,210,.12); }
    .btn-modal-cancel { background: #f5f5f5; color: #555; border: none; padding: .5rem 1.3rem; border-radius: 8px; }
    .btn-modal-submit { color: #fff; border: none; padding: .5rem 1.5rem; border-radius: 8px; font-weight: 600; }
    .btn-primary-modal { background: #1976d2 !important; }
    .nilai-preview-card {
        background: linear-gradient(135deg,#f8fbff,#e3f2fd);
        border: 1.5px solid #bbdefb; border-radius: 12px; padding: 1rem 1.2rem;
    }
    .preview-badge {
        padding: .25rem .75rem; border-radius: 8px; background: #fff;
        border: 2px solid #1976d2; font-size: 1rem; font-weight: 700; color: #1565c0; flex-shrink: 0;
    }
    .preview-label { font-size: .7rem; font-weight: 600; color: #888; text-transform: uppercase; letter-spacing: .05em; }
    .preview-angka { font-size: 1.1rem; color: #1a1a1a; }
    .preview-huruf { font-size: 1.1rem; color: #1a1a1a; }
</style>

<script>
(function () {
    const nilaiAngkaInput  = document.getElementById('editNilaiAngka');
    const nilaiHurufSelect = document.getElementById('editNilaiHuruf');
    const previewBadge     = document.getElementById('editPreviewBadge');
    const previewAngka     = document.getElementById('editPreviewAngka');
    const previewHuruf     = document.getElementById('editPreviewHuruf');

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
        previewAngka.textContent = angka !== '' ? parseFloat(angka).toFixed(2) : '-';
        previewHuruf.textContent = huruf || '-';
        previewBadge.textContent = huruf || (angka !== '' ? angkaToHuruf(parseFloat(angka)) : '-');
    }

    nilaiAngkaInput.addEventListener('input', function () {
        const n = parseFloat(this.value);
        if (this.value !== '') nilaiHurufSelect.value = angkaToHuruf(n);
        updatePreview();
    });

    nilaiHurufSelect.addEventListener('change', updatePreview);
})();
</script>