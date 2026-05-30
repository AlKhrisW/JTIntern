<div class="modal fade" id="modalShow" tabindex="-1" aria-labelledby="modalShowLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content modal-nilai">

            <div class="modal-header border-0 pb-0">
                <div class="modal-title-wrap">
                    <div class="modal-icon-badge bg-info-soft">
                        <i class="bi bi-eye text-info"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold" id="modalShowLabel">Detail Nilai Mahasiswa</h5>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body pt-3">

                {{-- Hero Card --}}
                <div class="show-hero-card mb-4">
                    <div class="d-flex align-items-center gap-4 flex-wrap">
                        @php
                            $h = strtolower(str_replace('+', '-plus', $nilai->nilai_huruf));
                            $na = $nilai->nilai_angka;
                            $barClass = $na >= 3.0 ? 'bg-success' : ($na >= 2.0 ? 'bg-warning' : 'bg-danger');
                            $barWidth = min(($na / 4) * 100, 100);
                        @endphp
                        <div class="nilai-badge-hero badge-huruf-{{ $h }}">
                            {{ $nilai->nilai_huruf }}
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="fw-bold mb-1">{{ $nilai->mahasiswa->nama_mahasiswa ?? '-' }}</h5>
                            <div class="text-muted small">{{ $nilai->mahasiswa->nim ?? '-' }}</div>
                            <div class="mt-2">
                                <span class="badge badge-matkul-show">{{ $nilai->mataKuliah->nama_matkul ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="text-end">
                            <div class="angka-display {{ $na >= 3.0 ? 'text-success' : ($na >= 2.0 ? 'text-warning' : 'text-danger') }}">
                                {{ number_format($na, 2) }}
                            </div>
                            <div class="text-muted small">Nilai Angka</div>
                            <div class="nilai-bar-bg-lg mt-2">
                                <div class="nilai-bar-lg {{ $barClass }}" style="width: {{ $barWidth }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="detail-item">
                            <div class="detail-label">ID Nilai</div>
                            <div class="detail-value">{{ $nilai->id_nilai }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="detail-item">
                            <div class="detail-label">Nilai Angka</div>
                            <div class="detail-value fw-bold text-primary">{{ number_format($nilai->nilai_angka, 2) }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="detail-item">
                            <div class="detail-label">Nilai Huruf</div>
                            <div class="detail-value fw-bold">
                                <span class="badge badge-huruf badge-huruf-{{ $h }}">{{ $nilai->nilai_huruf }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-item">
                            <div class="detail-label">NIM</div>
                            <div class="detail-value">{{ $nilai->id_mahasiswa }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-item">
                            <div class="detail-label">Nama Mahasiswa</div>
                            <div class="detail-value">{{ $nilai->mahasiswa->nama_mahasiswa ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="detail-item">
                            <div class="detail-label">Mata Kuliah</div>
                            <div class="detail-value">{{ $nilai->mataKuliah->nama_matkul ?? '-' }}</div>
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
    .modal-nilai { border-radius: 16px; border: none; box-shadow: 0 20px 60px rgba(0,0,0,.15); }
    .modal-title-wrap { display: flex; align-items: center; gap: 12px; }
    .modal-icon-badge { width: 42px; height: 42px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; }
    .bg-info-soft { background: #e0f7fa; }

    .show-hero-card {
        background: linear-gradient(135deg,#f8fbff,#e0f7fa);
        border: 1.5px solid #b2ebf2; border-radius: 14px; padding: 1.3rem 1.5rem;
    }

    /* Flat hero badge */
    .nilai-badge-hero {
        padding: .4rem 1rem; border-radius: 10px;
        font-size: 1.4rem; font-weight: 800; flex-shrink: 0;
        box-shadow: 0 2px 8px rgba(0,0,0,.08);
    }
    /* Flat inline badge */
    .badge-huruf {
        display: inline-block; padding: .25rem .65rem;
        border-radius: 6px; font-weight: 700; font-size: .85rem;
    }
    .badge-huruf-a      { background: #e8f5e9; color: #2e7d32; }
    .badge-huruf-b-plus { background: #e3f2fd; color: #0d47a1; }
    .badge-huruf-b      { background: #e3f2fd; color: #1565c0; }
    .badge-huruf-c-plus { background: #fff8e1; color: #e65100; }
    .badge-huruf-c      { background: #fff8e1; color: #f57f17; }
    .badge-huruf-d      { background: #fce4ec; color: #c62828; }
    .badge-huruf-e      { background: #ffebee; color: #b71c1c; }

    .angka-display { font-size: 2rem; font-weight: 800; line-height: 1; }

    .nilai-bar-bg-lg { height: 6px; background: #f0f0f0; border-radius: 6px; width: 100px; overflow: hidden; }
    .nilai-bar-lg    { height: 100%; border-radius: 6px; }

    .badge-matkul-show {
        background: #e8eaf6; color: #3949ab;
        padding: .3rem .7rem; border-radius: 20px; font-size: .8rem; font-weight: 500;
    }
    .detail-item { background: #fafafa; border-radius: 10px; padding: .85rem 1rem; border: 1px solid #f0f0f0; }
    .detail-label { font-size: .72rem; font-weight: 700; color: #888; text-transform: uppercase; margin-bottom: .4rem; }
    .detail-value { font-size: .92rem; color: #1a1a1a; }
    .btn-modal-cancel { background: #f5f5f5; color: #555; border: none; padding: .5rem 1.3rem; border-radius: 8px; }
</style>