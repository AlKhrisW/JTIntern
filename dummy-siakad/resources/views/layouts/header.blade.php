<header class="navbar navbar-expand-lg navbar-light border-bottom fixed-top">
    <div class="container-fluid align-items-center">

        {{-- Search Bar --}}
        <div class="flex-grow-1 me-3">
            <div class="input-group">
                <span class="input-group-text bg-light border-0">
                    <i class="bi bi-search"></i>
                </span>
                <input
                    type="text"
                    id="searchGlobal"
                    class="form-control border-0 bg-light"
                    placeholder="Cari data...">
            </div>
        </div>

        {{-- Right Side --}}
        <div class="d-flex align-items-center gap-3">

            {{-- Notification --}}
            <i class="bi bi-bell fs-5"></i>

            {{-- Profile Dropdown
            @php
                $adminHeader = Auth::guard('admin')->user() ?? \App\Models\AdminModel::first();
            @endphp

            <div class="dropdown">
                <a
                    href="#"
                    class="d-flex align-items-center gap-2 text-decoration-none dropdown-toggle"
                    id="dropdownAdmin"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">

                    <img
                        src="{{ $adminHeader?->photo_url ?? asset('assets/img/default-admin.png') }}"
                        class="rounded-circle border shadow-sm"
                        width="35"
                        height="35"
                        style="object-fit: cover;"
                        alt="Foto Admin"
                        onerror="this.src='{{ asset('assets/img/default-admin.png') }}'">

                    <span class="d-none d-md-inline fw-semibold text-dark" style="font-size: 0.875rem;">
                        {{ $adminHeader?->nama_lengkap ?? 'Admin JTIntern' }}
                    </span>

                </a>

                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" aria-labelledby="dropdownAdmin">
                    <li>
                        <div class="dropdown-header d-flex align-items-center gap-2 py-2">
                            <img
                                src="{{ $adminHeader?->photo_url ?? asset('assets/img/default-admin.png') }}"
                                class="rounded-circle border"
                                width="40"
                                height="40"
                                style="object-fit: cover;"
                                alt="Foto Admin"
                                onerror="this.src='{{ asset('assets/img/default-admin.png') }}'">
                            <div>
                                <div class="fw-semibold text-dark" style="font-size: 0.85rem;">
                                    {{ $adminHeader?->nama_lengkap ?? 'Admin JTIntern' }}
                                </div>
                                <div class="text-muted" style="font-size: 0.75rem;">
                                    {{ $adminHeader?->email ?? '' }}
                                </div>
                            </div>
                        </div>
                    </li>
                    <li><hr class="dropdown-divider my-1"></li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('admin.profil.index') }}">
                            <i class="bi bi-person-circle text-success"></i> Profil Saya
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
                            @csrf
                            <button type="submit" class="dropdown-item d-flex align-items-center gap-2 text-danger">
                                <i class="bi bi-box-arrow-right"></i> Keluar
                            </button>
                        </form>
                    </li>
                </ul>
            </div> --}}

        </div>
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('searchGlobal');
    if (!searchInput) return;

    // Restore nilai search dari URL
    const params      = new URLSearchParams(window.location.search);
    const searchValue = params.get('search');
    if (searchValue) searchInput.value = searchValue;

    // Reset saat input dikosongkan
    searchInput.addEventListener('input', function () {
        if (this.value.trim() === '') {
            const url = new URL(window.location.href);
            url.searchParams.delete('search');
            url.searchParams.delete('page');
            window.location.href = url.toString();
        }
    });

    // Search saat tekan Enter
    searchInput.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            const url     = new URL(window.location.href);
            const keyword = this.value.trim();
            if (keyword !== '') {
                url.searchParams.set('search', keyword);
            } else {
                url.searchParams.delete('search');
            }
            url.searchParams.delete('page');
            window.location.href = url.toString();
        }
    });

});
</script>