@extends('layouts_admin.template')

@section('content')
    <div class="lowongan-page">

        {{-- Header --}}
        <div class="page-header d-flex align-items-center justify-content-between mb-4">
            <h4 class="page-title mb-0">Manajemen Lowongan</h4>

            <button class="btn btn-tambah" id="btnTambah">
                <i class="bi bi-plus-lg me-1"></i> Tambah Lowongan
            </button>
        </div>

        {{-- Alert --}}
        <div id="alertContainer"></div>

        {{-- Filter --}}
        <div class="filter-stats-bar d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
            <div class="d-flex align-items-center gap-2">
                <label class="text-muted small fw-medium mb-0"> Filter: </label>

                <select id="filterPerusahaan" class="form-select form-select-sm filter-select">
                    <option value="">Semua Perusahaan</option>

                    @foreach ($perusahaans as $perusahaan)
                        <option value="{{ $perusahaan->perusahaan_id }}"
                            {{ request('perusahaan') == $perusahaan->perusahaan_id ? 'selected' : '' }}>
                            {{ $perusahaan->nama_perusahaan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="stats-group d-flex gap-4">
                <div class="stat-item text-end">
                    <div class="stat-label">LOWONGAN AKTIF</div>
                    <div class="stat-value text-success fw-bold">{{ $totalLowongan ?? 0 }}</div>
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="table-card">
            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>PERUSAHAAN</th>
                            <th>POSISI PEKERJAAN</th>
                            <th>DESKRIPSI</th>
                            <th>LOKASI</th>
                            <th>PERIODE</th>
                            <th class="text-end">AKSI</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($lowongans as $l)
                            <tr>
                                {{-- PERUSAHAAN --}}
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="company-logo">
                                            @if ($l->perusahaan && $l->perusahaan->logo)
                                                <img src="{{ asset('storage/' . $l->perusahaan->logo) }}"
                                                    alt="{{ $l->perusahaan->nama_perusahaan }}" class="logo-img">
                                            @else
                                                <div class="logo-placeholder">
                                                    {{ strtoupper(substr($l->perusahaan->nama_perusahaan ?? 'PR', 0, 2)) }}
                                                </div>
                                            @endif
                                        </div>

                                        <div>
                                            <div class="company-name fw-semibold">
                                                {{ $l->perusahaan->nama_perusahaan ?? '-' }}
                                            </div>

                                            <div class="company-sub text-muted small">
                                                {{ $l->jenis_pekerjaan ?? 'Lowongan Magang' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                {{-- POSISI PEKERJAAN --}}
                                <td>
                                    <div class="text-muted text-secondary">
                                        {{ $l->posisi }}
                                    </div>
                                </td>

                                {{-- DESKRIPSI --}}
                                <td>
                                    <div class="text-muted small">
                                        {{ Str::limit($l->deskripsi, 80) }}
                                    </div>
                                </td>

                                {{-- LOKASI --}}
                                <td>
                                    <div class="text-muted small">
                                        {{ $l->lokasi ?? ($l->perusahaan->lokasi ?? '-') }}
                                    </div>
                                </td>

                                {{-- PERIODE --}}
                                <td>
                                    <div class="text-muted small">
                                        {{ $l->periode }} Bulan
                                    </div>
                                </td>

                                {{-- AKSI --}}
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <button class="btn-icon btn-show" data-id="{{ $l->lowongan_id }}" title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </button>

                                        <button class="btn-icon btn-edit" data-id="{{ $l->lowongan_id }}" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>

                                        <button class="btn-icon btn-delete" data-id="{{ $l->lowongan_id }}"
                                            data-nama="{{ $l->posisi_pekerjaan }}" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="bi bi-briefcase fs-1 d-block mb-2 opacity-25"></i>
                                    Belum ada data lowongan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if (isset($lowongans) && method_exists($lowongans, 'links'))
                <div class="d-flex align-items-center justify-content-between px-3 py-3 border-top">
                    <span class="text-muted small">
                        Menampilkan {{ $lowongans->firstItem() ?? 0 }}–{{ $lowongans->lastItem() ?? 0 }}
                        dari {{ $lowongans->total() }} Lowongan
                    </span>

                    <div class="pagination-custom">
                        {{ $lowongans->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div id="modalContainer"></div>

    {{-- ===================== STYLES ===================== --}}
    <style>
        .lowongan-page {
            padding: 0;
        }

        .page-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #1a1a2e;
        }

        .btn-tambah {
            background: #4CAF50;
            color: #fff;
            border: none;
            padding: 0.5rem 1.2rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: background 0.2s;
        }

        .btn-tambah:hover {
            background: #388e3c;
            color: #fff;
        }

        .filter-select {
            border: 1.5px solid #e0e0e0;
            border-radius: 20px;
            padding: 0.35rem 1.1rem;
            font-size: 0.88rem;
            font-weight: 500;
            color: #555;
            min-width: 180px;
            cursor: pointer;
            transition: border-color 0.2s;
            background-color: #fff;
        }

        .filter-select:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.12);
            outline: none;
        }

        .stat-label {
            font-size: 0.7rem;
            color: #888;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            font-weight: 600;
        }

        .stat-value {
            font-size: 1.6rem;
            line-height: 1.1;
        }

        .table-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 1px 8px rgba(0, 0, 0, 0.07);
            overflow: hidden;
        }

        .table thead th {
            background: #fafafa;
            font-size: 0.72rem;
            font-weight: 700;
            color: #888;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            border-bottom: 1.5px solid #f0f0f0;
            padding: 0.85rem 1rem;
            white-space: nowrap;
        }

        .table tbody td {
            padding: 1rem 1rem;
            border-bottom: 1px solid #f5f5f5;
            vertical-align: middle;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        .table-hover tbody tr:hover {
            background: #f9fffe;
        }

        .logo-img {
            width: 42px;
            height: 42px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid #eee;
        }

        .logo-placeholder {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.85rem;
            color: #2e7d32;
            border: 1px solid #c8e6c9;
        }

        .company-name {
            font-size: 0.95rem;
            color: #1a1a1a;
        }

        .company-sub {
            font-size: 0.78rem;
        }

        .btn-icon {
            width: 34px;
            height: 34px;
            border: none;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.15s;
            background: transparent;
        }

        .btn-show {
            color: #0288d1;
            background: #e1f5fe;
        }

        .btn-show:hover {
            background: #b3e5fc;
            color: #01579b;
        }

        .btn-edit {
            color: #546e7a;
            background: #f0f4f8;
        }

        .btn-edit:hover {
            background: #cfd8dc;
            color: #263238;
        }

        .btn-delete {
            color: #e53935;
            background: #ffebee;
        }

        .btn-delete:hover {
            background: #ffcdd2;
            color: #b71c1c;
        }

        /* ===== Pagination ===== */
        .pagination-custom .pagination {
            margin: 0;
            gap: 4px;
        }

        .pagination-custom .page-link {
            border-radius: 8px !important;
            border: 1.5px solid #e8e8e8;
            color: #555;
            font-size: 0.85rem;
            padding: 0.3rem 0.65rem;
            min-width: 34px;
            text-align: center;
        }

        .pagination-custom .page-item.active .page-link {
            background: #4CAF50;
            border-color: #4CAF50;
            color: #fff;
        }

        .pagination-custom .page-link:hover {
            background: #e8f5e9;
            border-color: #a5d6a7;
            color: #2e7d32;
        }

        /* ===== Sembunyikan teks "Showing X to Y of Z results" bawaan Bootstrap pagination ===== */
        .pagination-custom p,
        .pagination-custom [role="status"],
        nav[aria-label="Pagination Navigation"] p,
        nav[aria-label="Pagination Navigation"] [role="status"] {
            display: none !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // --- Filter ---
            document.getElementById('filterPerusahaan').addEventListener('change', function() {
                const url = new URL(window.location.href);
                if (this.value) {
                    url.searchParams.set('perusahaan', this.value);
                } else {
                    url.searchParams.delete('perusahaan');
                }
                url.searchParams.delete('page');
                window.location.href = url.toString();
            });

            // --- Fungsi tampil alert ---
            function showAlert(type, message) {
                const container = document.getElementById('alertContainer');
                container.innerHTML = `
                <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                    <i class="bi bi-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>`;
                setTimeout(() => {
                    container.innerHTML = '';
                }, 4000);
            }

            // --- Load Modal ---
            function loadModal(url) {
                fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(res => res.text())
                    .then(html => {
                        document.getElementById('modalContainer').innerHTML = html;
                        const modalEl = document.querySelector('#modalContainer .modal');
                        if (modalEl) {
                            new bootstrap.Modal(modalEl).show();
                        }
                    })
                    .catch(() => {
                        showAlert('danger', 'Gagal memuat form.');
                    });
            }

            // --- Tombol Tambah ---
            document.getElementById('btnTambah')
                .addEventListener('click', function() {
                    loadModal(`{{ route('admin.lowongan.create_ajax') }}`);
                });

            // --- Tombol Show ---
            document.querySelectorAll('.btn-show').forEach(btn => {
                btn.addEventListener('click', function() {
                    loadModal(`{{ url('admin/lowongan/show_ajax') }}/` + this.dataset.id);
                });
            });

            // --- Tombol Edit ---
            document.querySelectorAll('.btn-edit').forEach(btn => {
                btn.addEventListener('click', function() {
                    loadModal(`{{ url('admin/lowongan/edit_ajax') }}/` + this.dataset.id);
                });
            });

            // --- Tombol Delete ---
            document.querySelectorAll('.btn-delete').forEach(btn => {
                btn.addEventListener('click', function() {
                    loadModal(`{{ url('admin/lowongan/delete_ajax') }}/` + this.dataset.id);
                });
            });

            // --- Handle submit semua modal AJAX ---
            document.getElementById('modalContainer').addEventListener('submit', function(e) {
                e.preventDefault();

                const form = e.target;
                const submitBtn = form.querySelector('[type="submit"]');

                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML =
                        '<span class="spinner-border spinner-border-sm me-1"></span> Menyimpan...';
                }

                fetch(form.action, {
                        method: 'POST',
                        body: new FormData(form),
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {

                        if (data.status) {
                            // Tutup modal
                            const modalEl = document.querySelector('#modalContainer .modal');
                            if (modalEl) {
                                bootstrap.Modal.getInstance(modalEl)?.hide();
                            }

                            // Alert success
                            showAlert('success', data.message ?? 'Berhasil.');

                            // Reload halaman
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        } else {
                            // Tampilkan error validasi
                            if (data.msgField) {
                                Object.entries(data.msgField).forEach(([field, messages]) => {

                                    const input = form.querySelector(`[name="${field}"]`);
                                    const errEl =
                                        form.querySelector(`#err_${field}`) ??
                                        form.querySelector(`#err_edit_${field}`);

                                    if (input) {
                                        input.classList.add('is-invalid');
                                    }

                                    if (errEl) {
                                        errEl.textContent = messages[0];
                                    }
                                });
                            }

                            // Alert gagal
                            showAlert('danger', data.message ?? 'Terjadi kesalahan.');
                        }
                    })
                    .catch(() => {
                        showAlert('danger', 'Terjadi kesalahan pada server.');
                    })
                    .finally(() => {
                        if (submitBtn) {
                            submitBtn.disabled = false;
                            submitBtn.innerHTML =
                                '<i class="bi bi-check-lg me-1"></i> Simpan';
                        }
                    });
            });
        });
    </script>
@endsection
