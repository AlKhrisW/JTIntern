<div class="d-flex flex-column p-3 bg-white border-end" style="width: 250px; height: 88vh">
    <!-- Logo -->
    <img src="{{ asset('images/logoJTIntern.png') }}" class="img-fluid" style="max-height: 40px; object-fit: contain;">

    <br>

    <!-- Menu -->
    <ul class="nav nav-pills flex-column mb-auto">

        <li class="nav-item">
            <a href="{{ route('admin.dashboard_CobaLayout') }}"
                class="nav-link {{ request()->routeIs('admin.dashboard_CobaLayout') ? 'active-menu' : '' }}">

                <i class="bi bi-grid me-2"></i> Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.perusahaan_CobaLayout') }}"
                class="nav-link {{ request()->routeIs('admin.perusahaan_CobaLayout') ? 'active-menu' : '' }}">

                <i class="bi bi-building me-2"></i> Data Perusahaan
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.lowongan_CobaLayout') }}"
                class="nav-link {{ request()->routeIs('admin.lowongan_CobaLayout') ? 'active-menu' : '' }}">

                <i class="bi bi-briefcase me-2"></i> Data Lowongan
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.profil_CobaLayout') }}"
                class="nav-link {{ request()->routeIs('admin.profil_CobaLayout') ? 'active-menu' : '' }}">

                <i class="bi bi-person me-2"></i> Profil Admin
            </a>
        </li>

    </ul>

    <brr>

        <!-- Bottom -->

        <ul class="nav nav-pills flex-column mb-auto">

            <li class="nav-item">
                <a href="#" class="nav-link text-dark">
                    <i class="bi bi-gear me-2"></i> Settings
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link text-danger">
                    <i class="bi bi-box-arrow-right me-2 text-danger"></i> Logout
                </a>
            </li>
        </ul>

</div>
