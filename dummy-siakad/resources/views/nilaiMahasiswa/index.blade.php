@extends('layouts.template')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/crud.css') }}">
    <style>
        /* ── Filter Bar ─────────────────────────── */
        .filter-stats-bar .filter-select {
            width: 180px;
            border-radius: 8px;
            border: 1.5px solid #e0e0e0;
            font-size: 0.85rem;
        }

        /* ── Grade badge (flat, no circle) ─────── */
        .badge-huruf {
            display: inline-block;
            padding: 0.25rem 0.65rem;
            border-radius: 6px;
            font-weight: 700;
            font-size: 0.85rem;
            letter-spacing: 0.03em;
        }
        .badge-huruf-a  { background: #e8f5e9; color: #2e7d32; }
        .badge-huruf-b-plus { background: #e3f2fd; color: #0d47a1; }
        .badge-huruf-b  { background: #e3f2fd; color: #1565c0; }
        .badge-huruf-c-plus { background: #fff8e1; color: #e65100; }
        .badge-huruf-c  { background: #fff8e1; color: #f57f17; }
        .badge-huruf-d  { background: #fce4ec; color: #c62828; }
        .badge-huruf-e  { background: #ffebee; color: #b71c1c; }

        /* ── Nilai angka (colored number only) ─── */
        .nilai-angka {
            font-size: 0.95rem;
            font-weight: 700;
        }
        .nilai-angka-tinggi  { color: #2e7d32; }
        .nilai-angka-sedang  { color: #e65100; }
        .nilai-angka-rendah  { color: #c62828; }

        /* ── Badge mata kuliah ──────────────────── */
        .badge-matkul {
            background: #e8eaf6;
            color: #3949ab;
            padding: 0.3rem 0.7rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        /* ── Action buttons ─────────────────────── */
        .btn-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            cursor: pointer;
            transition: opacity .15s;
        }
        .btn-icon:hover { opacity: .75; }
        .btn-show   { background: #e0f7fa; color: #00838f; }
        .btn-edit   { background: #e3f2fd; color: #1565c0; }
        .btn-delete { background: #ffebee; color: #c62828; }
    </style>
@endpush

@section('content')
    <div class="page-container">

        {{-- Header --}}
        <div class="page-header d-flex align-items-center justify-content-between mb-4">
            <h4 class="page-title mb-0">Manajemen Nilai Mahasiswa</h4>
            <button class="btn btn-tambah" id="btnTambah">
                <i class="bi bi-plus-lg me-1"></i> Tambah Nilai
            </button>
        </div>

        {{-- Alert Container --}}
        <div id="alertContainer"></div>

        {{-- Filter Bar --}}
        <div class="filter-stats-bar d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <span class="text-muted small fw-medium">Filter:</span>

                <select id="filterMahasiswa" class="form-select form-select-sm filter-select">
                    <option value="">Semua Mahasiswa</option>
                    @foreach ($mahasiswas as $mhs)
                        <option value="{{ $mhs->nim }}"
                            {{ request('id_mahasiswa') == $mhs->nim ? 'selected' : '' }}>
                            {{ $mhs->nama_mahasiswa }}
                        </option>
                    @endforeach
                </select>

                <select id="filterMatkul" class="form-select form-select-sm filter-select">
                    <option value="">Semua Mata Kuliah</option>
                    @foreach ($mataKuliahs as $mk)
                        <option value="{{ $mk->id_matkul }}"
                            {{ request('id_matkul') == $mk->id_matkul ? 'selected' : '' }}>
                            {{ $mk->nama_matkul }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="stat-item text-end">
                <div class="stat-label">TOTAL NILAI</div>
                <div class="stat-value text-primary fw-bold">{{ $totalNilai ?? 0 }}</div>
            </div>
        </div>

        {{-- Table Card --}}
        <div class="table-card">
            <div class="table-responsive">
                <table id="tableNilai" class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>ID NILAI</th>
                            <th>MAHASISWA</th>
                            <th>MATA KULIAH</th>
                            <th>NILAI ANGKA</th>
                            <th>NILAI HURUF</th>
                            <th class="text-end">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($nilais as $nilai)
                            <tr>
                                <td class="fw-medium text-muted">{{ $nilai->id_nilai }}</td>
                                <td>
                                    <div class="fw-semibold">{{ $nilai->mahasiswa->nama_mahasiswa ?? '-' }}</div>
                                    <small class="text-muted">{{ $nilai->mahasiswa->nim ?? '-' }}</small>
                                </td>
                                <td>
                                    <span class="badge badge-matkul">{{ $nilai->mataKuliah->nama_matkul ?? '-' }}</span>
                                </td>
                                <td>
                                    @php
                                        $na = $nilai->nilai_angka;
                                        $cls = $na >= 3.0 ? 'nilai-angka-tinggi' : ($na >= 2.0 ? 'nilai-angka-sedang' : 'nilai-angka-rendah');
                                    @endphp
                                    <span class="nilai-angka {{ $cls }}">{{ number_format($na, 2) }}</span>
                                </td>
                                <td>
                                    @php
                                        $h = strtolower(str_replace('+', '-plus', $nilai->nilai_huruf));
                                    @endphp
                                    <span class="badge badge-huruf badge-huruf-{{ $h }}">
                                        {{ $nilai->nilai_huruf }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-1">
                                        <button class="btn-icon btn-show" data-id="{{ $nilai->id_nilai }}" title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn-icon btn-edit" data-id="{{ $nilai->id_nilai }}" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn-icon btn-delete" data-id="{{ $nilai->id_nilai }}" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="bi bi-journal-x fs-1 d-block mb-2 opacity-25"></i>
                                    Belum ada data nilai mahasiswa
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if (isset($nilais) && method_exists($nilais, 'links'))
                <div class="d-flex align-items-center justify-content-between px-3 py-3 border-top">
                    <span class="text-muted small">
                        Menampilkan {{ $nilais->firstItem() ?? 0 }}–{{ $nilais->lastItem() ?? 0 }}
                        dari {{ $nilais->total() }} Nilai
                    </span>
                    <div class="pagination-custom">
                        {{ $nilais->links('pagination::bootstrap-5') }}
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
        document.addEventListener('DOMContentLoaded', function () {

            /* ── Alert ──────────────────────────────── */
            function showAlert(type, message) {
                const container = document.getElementById('alertContainer');
                container.innerHTML = `
                <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                    <i class="bi bi-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>`;
                setTimeout(() => container.innerHTML = '', 4000);
            }

            /* ── Load modal via AJAX ────────────────── */
            function loadModal(url) {
                fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                    .then(res => res.text())
                    .then(html => {
                        document.getElementById('modalContainer').innerHTML = html;
                        const modalEl = document.querySelector('#modalContainer .modal');
                        if (modalEl) new bootstrap.Modal(modalEl).show();
                    })
                    .catch(() => showAlert('danger', 'Gagal memuat form.'));
            }

            /* ── Filters ────────────────────────────── */
            document.getElementById('filterMahasiswa').addEventListener('change', function () {
                const url = new URL(window.location.href);
                this.value ? url.searchParams.set('id_mahasiswa', this.value)
                           : url.searchParams.delete('id_mahasiswa');
                url.searchParams.delete('page');
                window.location.href = url.toString();
            });

            document.getElementById('filterMatkul').addEventListener('change', function () {
                const url = new URL(window.location.href);
                this.value ? url.searchParams.set('id_matkul', this.value)
                           : url.searchParams.delete('id_matkul');
                url.searchParams.delete('page');
                window.location.href = url.toString();
            });

            /* ── Tombol aksi ────────────────────────── */
            document.getElementById('btnTambah').addEventListener('click', function () {
                loadModal('{{ route('nilai.create') }}');
            });

            document.querySelectorAll('.btn-show').forEach(btn => {
                btn.addEventListener('click', function () {
                    loadModal('{{ url('nilai-mahasiswa/show') }}/' + this.dataset.id);
                });
            });

            document.querySelectorAll('.btn-edit').forEach(btn => {
                btn.addEventListener('click', function () {
                    loadModal('{{ url('nilai-mahasiswa/edit') }}/' + this.dataset.id);
                });
            });

            document.querySelectorAll('.btn-delete').forEach(btn => {
                btn.addEventListener('click', function () {
                    loadModal('{{ url('nilai-mahasiswa/delete') }}/' + this.dataset.id);
                });
            });

            /* ── Submit handler (Create, Edit, Delete) ── */
            document.getElementById('modalContainer').addEventListener('submit', function (e) {
                e.preventDefault();
                const form = e.target;
                const isDelete = form.id === 'formDelete';

                // Bersihkan error hanya untuk form create/edit
                if (!isDelete) {
                    form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
                    form.querySelectorAll('[id^="err_"]').forEach(el => el.textContent = '');
                }

                const submitBtn = form.querySelector('[type="submit"]');
                const originalHTML = submitBtn ? submitBtn.innerHTML : '';
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = isDelete
                        ? '<span class="spinner-border spinner-border-sm me-1"></span> Menghapus...'
                        : '<span class="spinner-border spinner-border-sm me-1"></span> Menyimpan...';
                }

                fetch(form.action, {
                    method: 'POST',
                    body: new FormData(form),
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status) {
                        const modalEl = document.querySelector('#modalContainer .modal');
                        if (modalEl) bootstrap.Modal.getInstance(modalEl)?.hide();
                        showAlert('success', data.message ?? 'Berhasil.');
                        setTimeout(() => location.reload(), 1000);
                    } else {
                        if (!isDelete && data.msgField) {
                            Object.entries(data.msgField).forEach(([field, messages]) => {
                                const input = form.querySelector(`[name="${field}"]`);
                                const errEl = form.querySelector(`#err_${field}`) || form.querySelector(`#err_edit_${field}`);
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
                        submitBtn.innerHTML = originalHTML;
                    }
                });
            });
        });
    </script>
@endpush