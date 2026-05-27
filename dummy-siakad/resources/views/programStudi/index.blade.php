@extends('layouts_template')

@push('css')
    <style>
        .program-studi-page {
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
            text-transform: uppercase;
            border-bottom: 1.5px solid #f0f0f0;
            padding: 0.85rem 1rem;
        }

        .table tbody td {
            padding: 1rem;
            border-bottom: 1px solid #f5f5f5;
        }

        .table-hover tbody tr:hover {
            background: #f9fffe;
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

        .pagination-custom .page-link:hover {
            background: #e8f5e9;
            border-color: #a5d6a7;
            color: #2e7d32;
        }

        .pagination-custom p,
        .pagination-custom [role="status"] {
            display: none !important;
        }
    </style>
@endpush

@section('content')
    <div class="program-studi-page">

        {{-- Header --}}
        <div class="page-header d-flex align-items-center justify-content-between mb-4">
            <h4 class="page-title mb-0">Manajemen Program Studi</h4>
            <button class="btn btn-tambah" id="btnTambah">
                <i class="bi bi-plus-lg me-1"></i> Tambah Program Studi
            </button>
        </div>

        {{-- Alert Container --}}
        <div id="alertContainer"></div>

        {{-- Table Card --}}
        <div class="table-card">
            <div class="table-responsive">
                <table id="tableProgramStudi" class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="80">ID</th>
                            <th>NAMA PROGRAM STUDI</th>
                            <th class="text-end">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($programStudis as $ps)
                            <tr>
                                <td class="fw-medium text-muted">{{ $ps->prodi_id }}</td>
                                <td>
                                    <div class="fw-semibold">{{ $ps->nama_prodi }}</div>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <button class="btn-icon btn-edit" data-id="{{ $ps->prodi_id }}"
                                            title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn-icon btn-delete" data-id="{{ $ps->prodi_id }}"
                                            data-nama="{{ $ps->nama_prodi }}" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-5 text-muted">
                                    <i class="bi bi-book fs-1 d-block mb-2 opacity-25"></i>
                                    Belum ada data program studi
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if (isset($programStudis) && method_exists($programStudis, 'links'))
                <div class="d-flex align-items-center justify-content-between px-3 py-3 border-top">
                    <span class="text-muted small">
                        Menampilkan {{ $programStudis->firstItem() ?? 0 }}–{{ $programStudis->lastItem() ?? 0 }}
                        dari {{ $programStudis->total() }} Program Studi
                    </span>
                    <div class="pagination-custom">
                        {{ $programStudis->links('pagination::bootstrap-5') }}
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

            const alertContainer = document.getElementById('alertContainer');

            function showAlert(type, message) {
                alertContainer.innerHTML = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                <i class="bi bi-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>`;
                setTimeout(() => alertContainer.innerHTML = '', 4000);
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

            // Tambah
            document.getElementById('btnTambah').addEventListener('click', () => {
                loadModal('{{ route('program_studi.create_ajax') }}');
            });

            // Edit
            document.querySelectorAll('.btn-edit').forEach(btn => {
                btn.addEventListener('click', function() {
                    loadModal('{{ url('program_studi/edit_ajax') }}/' + this.dataset.id);
                });
            });

            // Delete
            document.querySelectorAll('.btn-delete').forEach(btn => {
                btn.addEventListener('click', function() {
                    loadModal('{{ url('program_studi/delete_ajax') }}/' + this.dataset.id);
                });
            });

            // Handle Submit (Create + Update + Delete)
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
                            showAlert('success', data.message || 'Berhasil.');
                            setTimeout(() => location.reload(), 800);
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
                            showAlert('danger', data.message || 'Terjadi kesalahan.');
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
