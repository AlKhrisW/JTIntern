<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
        <div class="modal-content modal-lowongan">

            <div class="modal-body text-center p-4">

                {{-- Icon --}}
                <div class="delete-icon-wrap mb-3">
                    <div class="delete-icon-outer">
                        <div class="delete-icon-inner">
                            <i class="bi bi-trash3"></i>
                        </div>
                    </div>
                </div>

                <h5 class="fw-bold mb-1">Hapus Lowongan Perusahaan?</h5>
                <p class="text-muted mb-3" style="font-size: 0.9rem;">
                    Kamu akan menghapus lowongan berikut secara permanen:
                </p>

                {{-- Company Card --}}
                <div class="delete-company-card mb-4">
                    <div class="d-flex align-items-center gap-3">
                        @if($lowongan->perusahaan->logo)
                        <img src="{{ asset('storage/' . $lowongan->perusahaan->logo) }}"
                            alt="{{ $lowongan->perusahaan->nama_perusahaan }}"
                            class="delete-logo-img">
                        @else
                        <div class="delete-logo-placeholder">
                            {{ strtoupper(substr($lowongan->perusahaan->nama_perusahaan, 0, 2)) }}
                        </div>
                        @endif
                        <div class="text-start">
                            <div class="fw-semibold">{{ $lowongan->posisi }}</div>
                            <div class="text-muted small">{{ $lowongan->perusahaan->nama_perusahaan }}</div>
                        </div>
                    </div>
                </div>

                <p class="text-danger small mb-4">
                    <i class="bi bi-exclamation-triangle me-1"></i>
                    Tindakan ini tidak dapat dibatalkan.
                </p>

                {{-- Hapus @method('DELETE'), gunakan POST saja --}}
                <form id="formDelete"
                    action="{{ route('lowongan.destroy_ajax', $lowongan->lowongan_id) }}"
                    method="POST">
                    @csrf

                    <div class="d-flex gap-2 justify-content-center">
                        <button type="button" class="btn btn-modal-cancel flex-grow-1" data-bs-dismiss="modal">
                            Batal
                        </button>
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
    .modal-lowongan {
        border-radius: 16px;
        border: none;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }

    .delete-icon-wrap {
        display: flex;
        justify-content: center;
    }

    .delete-icon-outer {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: #fff0f0;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: pulse-red 2s infinite;
    }

    .delete-icon-inner {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: #ffebee;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        color: #e53935;
    }

    @keyframes pulse-red {

        0%,
        100% {
            box-shadow: 0 0 0 0 rgba(229, 57, 53, 0.15);
        }

        50% {
            box-shadow: 0 0 0 10px rgba(229, 57, 53, 0);
        }
    }

    .delete-company-card {
        background: #fafafa;
        border: 1.5px solid #f0f0f0;
        border-radius: 12px;
        padding: 0.9rem 1.1rem;
        text-align: left;
    }

    .delete-logo-img {
        width: 44px;
        height: 44px;
        object-fit: contain;
        border-radius: 10px;
        border: 1px solid #eee;
    }

    .delete-logo-placeholder {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.88rem;
        color: #2e7d32;
    }

    .btn-modal-cancel {
        background: #f5f5f5;
        color: #555;
        border: none;
        padding: 0.55rem 1.3rem;
        border-radius: 8px;
        font-weight: 500;
    }

    .btn-modal-cancel:hover {
        background: #e0e0e0;
    }

    .btn-modal-delete {
        background: #e53935;
        color: #fff;
        border: none;
        padding: 0.55rem 1.3rem;
        border-radius: 8px;
        font-weight: 600;
    }

    .btn-modal-delete:hover {
        background: #b71c1c;
        color: #fff;
    }
</style>