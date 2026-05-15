<div class="modal fade" id="modalShow" tabindex="-1" aria-labelledby="modalShowLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content modal-perusahaan">

            <div class="modal-header border-0 pb-0">
                <div class="modal-title-wrap">
                    <div class="modal-icon-badge bg-info-soft">
                        <i class="bi bi-eye text-info"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold" id="modalShowLabel">Detail Lowongan Magang</h5>
                        <p class="text-muted small mb-0">Informasi lengkap lowongan magang</p>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body pt-3">
                {{-- Header Card --}}
                <div class="show-header-card mb-4">
                    <div class="d-flex align-items-center gap-3">
                        @if ($lowongan->perusahaan->logo)
                        <img src="{{ asset('storage/' . $lowongan->perusahaan->logo) }}"
                            alt="{{ $lowongan->perusahaan->nama_perusahaan }}" class="show-logo-img">
                        @else
                        <div class="show-logo-placeholder">
                            {{ strtoupper(substr($lowongan->perusahaan->nama_perusahaan, 0, 2)) }}
                        </div>
                        @endif
                        <div>
                            <h6 class="fw-bold mb-1 fs-5">{{ $lowongan->perusahaan->nama_perusahaan }}</h6>
                            <span class="badge-jenis">{{ $lowongan->perusahaan->jenis_perusahaan }}</span>
                        </div>
                    </div>
                </div>

                {{-- Detail Grid --}}
                <div class="row g-3">

                    <div class="col-12">
                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="bi bi-geo-alt me-1"></i> Lokasi
                            </div>
                            <div class="detail-value">
                                @if($lowongan->perusahaan->lokasi)
                                <div>{{ $lowongan->perusahaan->lokasi }}</div>
                                @else
                                <span class="text-muted fst-italic">Tidak ada</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="bi bi-geo-alt me-1"></i> Posisi
                            </div>
                            <div class="detail-value">{{ $lowongan->posisi }}</div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="bi bi-geo-alt me-1"></i> Min IPK
                            </div>
                            <div class="detail-value">{{ $lowongan->ipk_min }}</div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="bi bi-geo-alt me-1"></i> Periode
                            </div>
                            <div class="detail-value">{{ $lowongan->periode }} Bulan</div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="bi bi-geo-alt me-1"></i> Insentif
                            </div>
                            <div class="detail-value">{{ $lowongan->insentif }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="bi bi-geo-alt me-1"></i> Tools
                            </div>
                            <div class="detail-value">{{ $lowongan->tools }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="bi bi-geo-alt me-1"></i> Skills
                            </div>
                            <div class="detail-value">{{ $lowongan->skill }}</div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="bi bi-geo-alt me-1"></i> Deskripsi
                            </div>
                            <div class="detail-value">{{ $lowongan->deskripsi }}</div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>

<style>
    .modal-perusahaan {
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

    .bg-info-soft {
        background: #e1f5fe;
    }

    .show-header-card {
        background: linear-gradient(135deg, #f8fffe, #e8f5e9);
        border: 1.5px solid #c8e6c9;
        border-radius: 12px;
        padding: 1.2rem 1.4rem;
    }

    .show-logo-img {
        width: 60px;
        height: 60px;
        object-fit: contain;
        border-radius: 12px;
        border: 1.5px solid #e0e0e0;
        background: #fff;
    }

    .show-logo-placeholder {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.1rem;
        color: #2e7d32;
        border: 1.5px solid #c8e6c9;
    }

    .badge-jenis {
        display: inline-block;
        background: #e8f5e9;
        color: #2e7d32;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.78rem;
        font-weight: 600;
        border: 1px solid #a5d6a7;
    }

    .detail-item {
        background: #fafafa;
        border-radius: 10px;
        padding: 0.85rem 1rem;
        border: 1px solid #f0f0f0;
        height: 100%;
    }

    .detail-label {
        font-size: 0.72rem;
        font-weight: 700;
        color: #888;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.35rem;
    }

    .detail-value {
        font-size: 0.92rem;
        color: #1a1a1a;
        font-weight: 500;
    }

    .detail-profil {
        font-weight: 400;
        line-height: 1.65;
        color: #444;
        max-height: 120px;
        overflow-y: auto;
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
</style>