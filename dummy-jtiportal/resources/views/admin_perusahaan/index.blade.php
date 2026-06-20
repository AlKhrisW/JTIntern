@extends('layouts_template')

@section('content')
<div class="perusahaan-page">

    {{-- Header --}}
    <div class="page-header d-flex align-items-center justify-content-between mb-4">
        <h4 class="page-title mb-0">Manajemen Perusahaan</h4>
        <button class="btn btn-tambah" id="btnTambah">
            <i class="bi bi-plus-lg me-1"></i> Tambah Perusahaan
        </button>
    </div>

    {{-- Alert Container --}}
    <div id="alertContainer"></div>

    {{-- Stats + Filter Bar --}}
    <div class="filter-stats-bar d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
        {{-- Filter Dropdown --}}
        <div class="d-flex align-items-center gap-2">
            <label class="text-muted small fw-medium mb-0">Filter:</label>
            <select id="filterJenis" class="form-select form-select-sm filter-select">
                <option value="">Semua Jenis</option>
                <option value="swasta nasional" {{ request('jenis') == 'swasta nasional' ? 'selected' : '' }}>Swasta Nasional</option>
                <option value="swasta" {{ request('jenis') == 'swasta' ? 'selected' : '' }}>Swasta</option>
                <option value="instansi pendidikan" {{ request('jenis') == 'instansi pendidikan' ? 'selected' : '' }}>Instansi Pendidikan</option>
                <option value="BUMN" {{ request('jenis') == 'BUMN' ? 'selected' : '' }}>BUMN</option>
            </select>
        </div>

        {{-- Stats --}}
        <div class="stats-group d-flex gap-4">
            <div class="stat-item text-end">
                <div class="stat-label">TOTAL PERUSAHAAN</div>
                <div class="stat-value text-primary fw-bold">{{ $totalPerusahaan ?? 0 }}</div>
            </div>
            <div class="stat-item text-end">
                <div class="stat-label">TOTAL INSTANSI</div>
                <div class="stat-value text-danger fw-bold">{{ $totalInstansi ?? 0 }}</div>
            </div>
        </div>
    </div>

    {{-- Table Card --}}
    <div class="table-card">
        <div class="table-responsive">
            <table id="tablePerusahaan" class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>PERUSAHAAN</th>
                        <th>JENIS PERUSAHAAN</th>
                        <th>LOKASI</th>
                        <th class="text-end">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($perusahaans as $p)
                    <tr data-jenis="{{ $p->jenis_perusahaan }}">
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="company-logo">
                                    @if($p->logo)
                                        <img src="{{ asset('storage/' . $p->logo) }}" alt="{{ $p->nama_perusahaan }}" class="logo-img">
                                    @else
                                        <div class="logo-placeholder">
                                            {{ strtoupper(substr($p->nama_perusahaan, 0, 2)) }}
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="company-name fw-semibold">{{ $p->nama_perusahaan }}</div>
                                    <div class="company-sub text-muted small">{{ Str::limit($p->profil_perusahaan, 40) }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="text-secondary">{{ $p->jenis_perusahaan }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-1 text-secondary">
                                <i class="bi bi-geo-alt"></i>
                                <span>{{ $p->lokasi }}</span>
                            </div>
                        </td>
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <button class="btn-icon btn-show"
                                    data-id="{{ $p->perusahaan_id }}"
                                    title="Detail">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn-icon btn-edit"
                                    data-id="{{ $p->perusahaan_id }}"
                                    title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn-icon btn-delete"
                                    data-id="{{ $p->perusahaan_id }}"
                                    data-nama="{{ $p->nama_perusahaan }}"
                                    title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">
                            <i class="bi bi-building fs-1 d-block mb-2 opacity-25"></i>
                            Belum ada data perusahaan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if(isset($perusahaans) && method_exists($perusahaans, 'links'))
        <div class="d-flex align-items-center justify-content-between px-3 py-3 border-top">
            <span class="text-muted small">
                Menampilkan {{ $perusahaans->firstItem() ?? 0 }}–{{ $perusahaans->lastItem() ?? 0 }} dari {{ $perusahaans->total() }} Perusahaan
            </span>
            <div class="pagination-custom">
                {{ $perusahaans->links('pagination::bootstrap-5') }}
            </div>
        </div>
        @endif
    </div>
</div>

{{-- Modal Container --}}
<div id="modalContainer"></div>

{{-- ===================== STYLES ===================== --}}
<style>
.perusahaan-page { padding: 0; }

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
.btn-tambah:hover { background: #388e3c; color: #fff; }

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
    box-shadow: 0 0 0 3px rgba(76,175,80,0.12);
    outline: none;
}

.stat-label {
    font-size: 0.7rem;
    color: #888;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    font-weight: 600;
}
.stat-value { font-size: 1.6rem; line-height: 1.1; }

.table-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 1px 8px rgba(0,0,0,0.07);
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
.table tbody tr:last-child td { border-bottom: none; }
.table-hover tbody tr:hover { background: #f9fffe; }

.logo-img {
    width: 42px; height: 42px;
    object-fit: cover;
    border-radius: 10px;
    border: 1px solid #eee;
}
.logo-placeholder {
    width: 42px; height: 42px;
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

.company-name { font-size: 0.95rem; color: #1a1a1a; }
.company-sub  { font-size: 0.78rem; }

.btn-icon {
    width: 34px; height: 34px;
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
.btn-show         { color: #0288d1; background: #e1f5fe; }
.btn-show:hover   { background: #b3e5fc; color: #01579b; }
.btn-edit         { color: #546e7a; background: #f0f4f8; }
.btn-edit:hover   { background: #cfd8dc; color: #263238; }
.btn-delete       { color: #e53935; background: #ffebee; }
.btn-delete:hover { background: #ffcdd2; color: #b71c1c; }

/* ===== Pagination ===== */
.pagination-custom .pagination { margin: 0; gap: 4px; }
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

{{-- ===================== SCRIPTS ===================== --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    // --- Filter Dropdown ---
    document.getElementById('filterJenis').addEventListener('change', function () {
        const url = new URL(window.location.href);
        if (this.value) {
            url.searchParams.set('jenis', this.value);
        } else {
            url.searchParams.delete('jenis');
        }
        url.searchParams.delete('page');
        window.location.href = url.toString();
    });

    // --- Fungsi tampil alert ---
    function showAlert(type, message) {
        const container = document.getElementById('alertContainer');
        container.innerHTML = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                <i class="bi bi-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>`;
        setTimeout(() => container.innerHTML = '', 4000);
    }

    // --- Fungsi load modal ---
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

    // --- Tombol Tambah ---
    document.getElementById('btnTambah').addEventListener('click', function () {
        loadModal('{{ route('perusahaan.create_ajax') }}');
    });

    // --- Tombol Detail / Show ---
    document.querySelectorAll('.btn-show').forEach(btn => {
        btn.addEventListener('click', function () {
            loadModal('{{ url('admin/perusahaan/show_ajax') }}/' + this.dataset.id);
        });
    });

    // --- Tombol Edit ---
    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', function () {
            loadModal('{{ url('admin/perusahaan/edit_ajax') }}/' + this.dataset.id);
        });
    });

    // --- Tombol Hapus ---
    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', function () {
            loadModal('{{ url('admin/perusahaan/delete_ajax') }}/' + this.dataset.id);
        });
    });

    // --- Validasi client-side khusus form tambah ---
    function validateFormTambah(form) {
        let valid = true;

        // Bersihkan semua error dulu
        form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        form.querySelectorAll('[id^="err_"]').forEach(el => el.textContent = '');

        function showErr(name, msg) {
            const el    = form.querySelector(`[name="${name}"]`);
            const errEl = form.querySelector(`#err_${name}`);
            if (el)    el.classList.add('is-invalid');
            if (errEl) errEl.textContent = msg;
            valid = false;
        }

        const nama = form.querySelector('[name="nama_perusahaan"]');
        if (!nama?.value.trim())
            showErr('nama_perusahaan', 'Nama perusahaan wajib diisi.');

        const jenis = form.querySelector('[name="jenis_perusahaan"]');
        if (!jenis?.value)
            showErr('jenis_perusahaan', 'Jenis perusahaan wajib dipilih.');

        const lokasi = form.querySelector('[name="lokasi"]');
        if (!lokasi?.value.trim())
            showErr('lokasi', 'Lokasi wajib diisi.');

        const profil = form.querySelector('[name="profil_perusahaan"]');
        if (!profil?.value.trim())
            showErr('profil_perusahaan', 'Profil perusahaan wajib diisi.');

        // web_career opsional — kalau diisi, harus URL valid
        const web = form.querySelector('[name="web_career"]');
        if (web?.value.trim()) {
            try { new URL(web.value.trim()); }
            catch (_) { showErr('web_career', 'Format URL tidak valid. Contoh: https://...'); }
        }

        // logo opsional — kalau diisi, cek tipe & ukuran
        const logoInput = form.querySelector('[name="logo"]');
        if (logoInput?.files?.[0]) {
            const file    = logoInput.files[0];
            const allowed = ['image/jpeg', 'image/png', 'image/svg+xml', 'image/webp'];
            if (!allowed.includes(file.type)) {
                showErr('logo', 'File harus berupa gambar (JPG, PNG, SVG, WebP).');
            } else if (file.size > 2 * 1024 * 1024) {
                showErr('logo', 'Ukuran logo maksimal 2MB.');
            }
        }

        return valid;
    }

    // --- Handle submit modal (create, edit, delete) ---
    document.getElementById('modalContainer').addEventListener('submit', function (e) {
        e.preventDefault();
        const form = e.target;

        // Khusus form tambah: validasi client-side dulu
        if (form.id === 'formTambah') {
            if (!validateFormTambah(form)) {
                // Ada error → scroll ke field pertama, modal tetap terbuka, STOP
                const firstInvalid = form.querySelector('.is-invalid');
                if (firstInvalid) {
                    firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstInvalid.focus();
                }
                return;
            }
        }

        // Semua lolos → kirim AJAX
        const submitBtn = form.querySelector('[type="submit"]');
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Menyimpan...';
        }

        fetch(form.action, {
            method:  'POST',
            body:    new FormData(form),
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.json())
        .then(data => {
            if (data.status) {
                // Sukses → BARU tutup modal, lalu reload
                const modalEl = document.querySelector('#modalContainer .modal');
                if (modalEl) bootstrap.Modal.getInstance(modalEl)?.hide();
                showAlert('success', data.message ?? 'Berhasil.');
                setTimeout(() => location.reload(), 1000);
            } else {
                // Gagal → modal TETAP terbuka, tampilkan error per field
                if (data.msgField) {
                    Object.entries(data.msgField).forEach(([field, messages]) => {
                        const input = form.querySelector(`[name="${field}"]`);
                        const errEl = form.querySelector(`#err_${field}`)
                                   ?? form.querySelector(`#err_edit_${field}`);
                        if (input)  input.classList.add('is-invalid');
                        if (errEl)  errEl.textContent = messages[0];
                    });
                    const firstInvalid = form.querySelector('.is-invalid');
                    if (firstInvalid) firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
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
@endsection