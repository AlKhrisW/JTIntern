<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
        <div class="modal-content modal-nilai">

            <div class="modal-body text-center p-4">
                <div class="delete-icon-wrap mb-3 d-flex justify-content-center">
                    <div class="delete-icon-outer">
                        <div class="delete-icon-inner">
                            <i class="bi bi-trash3"></i>
                        </div>
                    </div>
                </div>

                <h5 class="fw-bold mb-1">Hapus Data Nilai?</h5>
                <p class="text-muted mb-3">Anda akan menghapus data nilai berikut:</p>

                @php
                    $h = strtolower(str_replace('+', '-plus', $nilai->nilai_huruf));
                @endphp

                <div class="delete-item-card mb-3">
                    <div class="d-flex align-items-center gap-3 justify-content-center">
                        <div class="badge badge-huruf badge-huruf-{{ $h }} fs-6 px-3 py-2">
                            {{ $nilai->nilai_huruf }}
                        </div>
                        <div class="text-start">
                            <strong>{{ $nilai->mahasiswa->nama_mahasiswa ?? '-' }}</strong><br>
                            <small class="text-muted">{{ $nilai->mataKuliah->nama_matkul ?? '-' }}</small><br>
                            <small class="text-muted">Nilai Angka: {{ number_format($nilai->nilai_angka, 2) }}</small>
                        </div>
                    </div>
                </div>

                <p class="text-danger small mb-4">
                    <i class="bi bi-exclamation-triangle me-1"></i>
                    Tindakan ini tidak dapat dibatalkan.
                </p>

                {{-- method POST saja, tanpa _method DELETE, sesuai route web.php --}}
                <form id="formDelete" action="{{ route('nilai.destroy', $nilai->id_nilai) }}" method="POST">
                    @csrf

                    <div class="d-flex gap-2 justify-content-center">
                        <button type="button" class="btn btn-modal-cancel flex-grow-1"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-modal-delete flex-grow-1">
                            <i class="bi bi-trash3 me-1"></i> Ya, Hapus
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .modal-nilai { border-radius: 16px; border: none; box-shadow: 0 20px 60px rgba(0,0,0,.15); }

    .delete-icon-outer {
        width: 72px; height: 72px; border-radius: 50%; background: #fff0f0;
        display: flex; align-items: center; justify-content: center;
    }
    .delete-icon-inner {
        width: 50px; height: 50px; border-radius: 50%; background: #ffebee;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.4rem; color: #e53935;
    }
    .delete-item-card {
        background: #fafafa; border: 1.5px solid #f0f0f0; border-radius: 12px; padding: 1rem;
    }

    .badge-huruf { display: inline-block; padding: .25rem .65rem; border-radius: 6px; font-weight: 700; font-size: .85rem; }
    .badge-huruf-a      { background: #e8f5e9; color: #2e7d32; }
    .badge-huruf-b-plus { background: #e3f2fd; color: #0d47a1; }
    .badge-huruf-b      { background: #e3f2fd; color: #1565c0; }
    .badge-huruf-c-plus { background: #fff8e1; color: #e65100; }
    .badge-huruf-c      { background: #fff8e1; color: #f57f17; }
    .badge-huruf-d      { background: #fce4ec; color: #c62828; }
    .badge-huruf-e      { background: #ffebee; color: #b71c1c; }

    .btn-modal-cancel { background: #f5f5f5; color: #555; border: none; padding: .55rem 1.3rem; border-radius: 8px; }
    .btn-modal-delete { background: #e53935; color: #fff; border: none; padding: .55rem 1.3rem; border-radius: 8px; font-weight: 600; }
</style>