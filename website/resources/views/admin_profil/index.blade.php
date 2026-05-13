@extends('layouts_admin.template')

{{-- Sesuaikan nama section ini dengan @yield(...) di layouts_admin/template.blade.php --}}
{{-- Cek file template Anda, biasanya salah satu dari: 'content', 'content-wrapper', 'main-content', 'page-content' --}}
@section('content')

<div class="container-fluid py-3">

    <h4 class="fw-bold mb-3">Profil Admin</h4>

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-3">

        {{-- ========================= --}}
        {{-- KOLOM KIRI: FOTO PROFIL   --}}
        {{-- ========================= --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center d-flex flex-column align-items-center justify-content-center py-4">

                    <img
                        id="preview"
                        src="{{ $admin->photo_url }}"
                        alt="Foto Profil"
                        class="rounded-circle border mb-3 shadow-sm"
                        width="160"
                        height="160"
                        style="object-fit: cover;"
                        loading="lazy"
                        onerror="this.src='{{ asset('assets/img/default-admin.png') }}'">

                    <h5 class="fw-bold mb-1">
                        {{ $admin->nama_lengkap ?? 'Administrator' }}
                    </h5>

                    <p class="text-muted small mb-1">
                        <i class="bi bi-envelope me-1"></i>{{ $admin->email }}
                    </p>

                    {{-- Form Upload Foto --}}
                    <form
                        id="formUploadFoto"
                        action="{{ route('admin.profil.update_picture') }}"
                        method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <input
                            type="file"
                            name="photo"
                            id="photo"
                            class="d-none"
                            accept="image/jpeg,image/png,image/jpg,image/webp">

                        <button
                            type="button"
                            id="btnUpload"
                            class="btn btn-outline-success btn-sm">
                            <i class="bi bi-camera me-1"></i>Ganti Foto
                        </button>
                    </form>

                    <small class="text-muted mt-2">Maks. 2MB (JPG, PNG, WEBP)</small>

                </div>
            </div>
        </div>

        {{-- ========================= --}}
        {{-- KOLOM KANAN: FORM PROFIL  --}}
        {{-- ========================= --}}
        <div class="col-lg-8">

            {{-- Card: Info Profil --}}
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0 fw-semibold">
                        <i class="bi bi-person-circle me-2 text-success"></i>Informasi Profil
                    </h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.profil.update') }}" method="POST" id="formProfil">
                        @csrf

                        <div class="mb-3">
                            <label for="nama_lengkap" class="form-label fw-semibold">
                                Nama Lengkap <span class="text-danger">*</span>
                            </label>
                            <input
                                type="text"
                                id="nama_lengkap"
                                name="nama_lengkap"
                                class="form-control @error('nama_lengkap') is-invalid @enderror"
                                value="{{ old('nama_lengkap', $admin->nama_lengkap) }}"
                                required>
                            @error('nama_lengkap')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label fw-semibold">
                                    Email <span class="text-danger">*</span>
                                </label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $admin->email) }}"
                                    required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="username" class="form-label fw-semibold">
                                    Username <span class="text-danger">*</span>
                                </label>
                                <input
                                    type="text"
                                    id="username"
                                    name="username"
                                    class="form-control @error('username') is-invalid @enderror"
                                    value="{{ old('username', $admin->username) }}"
                                    required>
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-save me-1"></i>Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>

            {{-- Card: Ubah Password --}}
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0 fw-semibold">
                        <i class="bi bi-lock me-2 text-warning"></i>Ubah Password
                    </h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.profil.change_password') }}" method="POST" id="formPassword">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label fw-semibold">
                                    Password Baru
                                </label>
                                <div class="input-group">
                                    <input
                                        type="password"
                                        id="password"
                                        name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Min. 8 karakter">
                                    <button class="btn btn-outline-secondary btn-toggle-pw" type="button" data-target="password">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label fw-semibold">
                                    Konfirmasi Password
                                </label>
                                <div class="input-group">
                                    <input
                                        type="password"
                                        id="password_confirmation"
                                        name="password_confirmation"
                                        class="form-control"
                                        placeholder="Ulangi password baru">
                                    <button class="btn btn-outline-secondary btn-toggle-pw" type="button" data-target="password_confirmation">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-warning text-white">
                            <i class="bi bi-key me-1"></i>Ubah Password
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
(function () {
    // ── Upload Foto ──────────────────────────────────────────────
    const photoInput = document.getElementById('photo');
    const preview    = document.getElementById('preview');
    const btnUpload  = document.getElementById('btnUpload');
    const formUpload = document.getElementById('formUploadFoto');

    btnUpload.addEventListener('click', () => photoInput.click());

    photoInput.addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;

        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran gambar maksimal 2MB!');
            this.value = '';
            return;
        }

        // Preview sebelum upload
        preview.src = URL.createObjectURL(file);

        // Auto submit
        formUpload.submit();
    });

    // ── Toggle Password Visibility ───────────────────────────────
    document.querySelectorAll('.btn-toggle-pw').forEach(btn => {
        btn.addEventListener('click', function () {
            const targetId = this.dataset.target;
            const input    = document.getElementById(targetId);
            const icon     = this.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            }
        });
    });

    // ── Auto-dismiss Alert ───────────────────────────────────────
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(el => {
            const bsAlert = bootstrap.Alert.getOrCreateInstance(el);
            bsAlert.close();
        });
    }, 4000);
})();
</script>

@endsection