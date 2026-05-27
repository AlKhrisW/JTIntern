@extends('layouts.template')

@push('css')
    <style>
        .mata-kuliah-page {
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
        }

        .btn-tambah:hover {
            background: #388e3c;
        }

        .filter-select {
            border: 1.5px solid #e0e0e0;
            border-radius: 20px;
            padding: 0.35rem 1.1rem;
            font-size: 0.88rem;
            min-width: 260px;
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
        }

        .table tbody td {
            padding: 1rem 1rem;
            border-bottom: 1px solid #f5f5f5;
        }

        .table-hover tbody tr:hover {
            background: #f9fffe;
        }

        .badge-prodi {
            background: #e3f2fd;
            color: #1565c0;
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            font-size: 0.82rem;
            font-weight: 500;
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

        /* Pagination */
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
        }

        .pagination-custom .page-item.active .page-link {
            background: #4CAF50;
            border-color: #4CAF50;
            color: #fff;
        }
    </style>
@endpush

@section('content')
    <div class="mata-kuliah-page">

        {{-- Header --}}
        <div class="page-header d-flex align-items-center justify-content-between mb-4">
            <h4 class="page-title mb-0">Manajemen Mata Kuliah</h4>
            <button class="btn btn-tambah" id="btnTambah">
                <i class="bi bi-plus-lg me-1"></i> Tambah Mata Kuliah
            </button>
        </div>

        {{-- Alert Container --}}
        <div id="alertContainer"></div>

        {{-- Filter Bar --}}
        <div class="filter-stats-bar d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
            <div class="d-flex align-items-center gap-2">
                <label class="text-muted small fw-medium mb-0">Filter Program Studi:</label>
                <select id="filterProdi" class="form-select form-select-sm filter-select">
                    <option value="">Semua Program Studi</option>
                    @foreach ($programStudis as $prodi)
                        <option value="{{ $prodi->prodi_id }}"
                            {{ request('prodi_id') == $prodi->prodi_id ? 'selected' : '' }}>
                            {{ $prodi->nama_program_studi }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="stat-item text-end">
                <div class="stat-label">TOTAL MATA KULIAH</div>
                <div class="stat-value text-primary fw-bold">{{ $totalMataKuliah ?? 0 }}</div>
            </div>
        </div>

        {{-- Table Card --}}
        <div class="table-card">
            <div class="table-responsive">
                <table id="tableMataKuliah" class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>ID MATKUL</th>
                            <th>NAMA MATA KULIAH</th>
                            <th>PROGRAM STUDI</th>
                            <th class="text-end">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mataKuliahs as $mk)
                            <tr>
                                <td class="fw-medium text-muted">{{ $mk->id_matkul }}</td>
                                <td class="fw-semibold">{{ $mk->nama_matkul }}</td>
                                <td>
                                    <span
                                        class="badge badge-prodi">{{ $mk->programStudi->nama_program_studi ?? '-' }}</span>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <button class="btn-icon btn-show" data-id="{{ $mk->id_matkul }}" title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn-icon btn-edit" data-id="{{ $mk->id_matkul }}" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn-icon btn-delete" data-id="{{ $mk->id_matkul }}"
                                            data-nama="{{ $mk->nama_matkul }}" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="bi bi-book fs-1 d-block mb-2 opacity-25"></i>
                                    Belum ada data mata kuliah
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if (isset($mataKuliahs) && method_exists($mataKuliahs, 'links'))
                <div class="d-flex align-items-center justify-content-between px-3 py-3 border-top">
                    <span class="text-muted small">
                        Menampilkan {{ $mataKuliahs->firstItem() ?? 0 }}–{{ $mataKuliahs->lastItem() ?? 0 }}
                        dari {{ $mataKuliahs->total() }} Mata Kuliah
                    </span>
                    <div class="pagination-custom">
                        {{ $mataKuliahs->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- Modal Container --}}
    <div id="modalContainer"></div>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            function showAlert(type, message) {
                const container = document.getElementById('alertContainer');
                container.innerHTML = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                <i class="bi bi-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>`;
                setTimeout(() => container.innerHTML = '', 4000);
            }

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
                        if (modalEl) new bootstrap.Modal(modalEl).show();
                    })
                    .catch(() => showAlert('danger', 'Gagal memuat form.'));
            }

            // Filter
            document.getElementById('filterProdi').addEventListener('change', function() {
                const url = new URL(window.location.href);
                if (this.value) {
                    url.searchParams.set('prodi_id', this.value);
                } else {
                    url.searchParams.delete('prodi_id');
                }
                url.searchParams.delete('page');
                window.location.href = url.toString();
            });

            // Tombol Tambah
            document.getElementById('btnTambah').addEventListener('click', function() {
                loadModal('{{ route('admin.mata_kuliah.create_ajax') }}');
            });

            // Tombol Show
            document.querySelectorAll('.btn-show').forEach(btn => {
                btn.addEventListener('click', function() {
                    loadModal('{{ url('admin/mata_kuliah/show_ajax') }}/' + this.dataset.id);
                });
            });

            // Tombol Edit
            document.querySelectorAll('.btn-edit').forEach(btn => {
                btn.addEventListener('click', function() {
                    loadModal('{{ url('admin/mata_kuliah/edit_ajax') }}/' + this.dataset.id);
                });
            });

            // Tombol Delete
            document.querySelectorAll('.btn-delete').forEach(btn => {
                btn.addEventListener('click', function() {
                    loadModal('{{ url('admin/mata_kuliah/delete_ajax') }}/' + this.dataset.id);
                });
            });

            // Handle Submit
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
                            const modalEl = document.querySelector('#modalContainer .modal');
                            if (modalEl) bootstrap.Modal.getInstance(modalEl)?.hide();
                            showAlert('success', data.message ?? 'Berhasil.');
                            setTimeout(() => location.reload(), 1000);
                        } else {
                            if (data.msgField) {
                                Object.entries(data.msgField).forEach(([field, messages]) => {
                                    const input = form.querySelector(`[name="${field}"]`);
                                    const errEl = form.querySelector(`#err_${field}`) || form
                                        .querySelector(`#err_edit_${field}`);
                                    if (input) input.classList.add('is-invalid');
                                    if (errEl) errEl.textContent = messages[0];
                                });
                            }
                            showAlert('danger', data.message ?? 'Terjadi kesalahan.');
                        }
                    })
                    .catch(() => showAlert('danger', 'Terjadi kesalahan pada server.'))
                    .finally(() => {
                        if (submitBtn) {
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = '<i class="bi bi-check-lg me-1"></i> Simpan';
                        }
                    });
            });
        });
    </script>
@endpush
