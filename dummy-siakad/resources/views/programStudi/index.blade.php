@extends('layouts.template')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/crud.css') }}">
    <style>
        /* ===== Sembunyikan teks "Showing X to Y of Z results" bawaan Bootstrap pagination ===== */
        .pagination-custom p,
        .pagination-custom [role="status"],
        nav[aria-label="Pagination Navigation"] p,
        nav[aria-label="Pagination Navigation"] [role="status"] {
            display: none !important;
        }
    </style>
@endpush

@section('content')
    <div class="page-container">

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

@push('js')
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
                loadModal('{{ route('prodi.create') }}');
            });

            // Edit
            document.querySelectorAll('.btn-edit').forEach(btn => {
                btn.addEventListener('click', function() {
                    loadModal('{{ url('/program-studi/edit') }}/' + this.dataset.id);
                });
            });

            // Delete
            document.querySelectorAll('.btn-delete').forEach(btn => {
                btn.addEventListener('click', function() {
                    loadModal('{{ url('/program-studi/delete') }}/' + this.dataset.id);
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