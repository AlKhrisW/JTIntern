<aside class="d-flex flex-column">
    <div class="mb-3 header">
        <button id="toggle">
            <i class="bi bi-columns-gap"></i>
        </button>
        <a href="{{ route('admin.dashboard') }}" class="logo">
            <span>
                <img src="{{ asset('images/JTIntern_resize.png') }}" alt="JTIntern Logo" style="height: 30px">
            </span>
        </a>
    </div>
    <ul class="mb-auto">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ ($activeMenu == 'dashboard')? 'active' : '' }} ">
                <span class="icon">
                    <i class="bi bi-speedometer2"></i>
                </span>
                <span class="description">
                    Dashboard
                </span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.perusahaan.index') }}" class="nav-link {{ ($activeMenu == 'perusahaan')? 'active' : '' }} ">
                <span class="icon">
                    <i class="bi bi-briefcase"></i>
                </span>
                <span class="description">
                    Data Perusahaan
                </span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.lowongan.index') }}" class="nav-link {{ ($activeMenu == 'lowongan')? 'active' : '' }} ">
                <span class="icon">
                    <i class="bi bi-file-earmark-text"></i>
                </span>
                <span class="description">
                    Data Lowongan
                </span>
            </a>
        </li>
    </ul>
    <ul>
        <li class="nav-item">
            <a href="#" class="nav-link {{ ($activeMenu == 'profil')? 'active' : '' }} ">
                <span class="icon">
                    <i class="bi bi-people"></i>
                </span>
                <span class="description">
                    Profil Admin
                </span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <span class="icon">
                    <i class="bi bi-box-arrow-right"></i>
                </span>
                <span class="description">
                    Keluar
                </span>
            </a>
        </li>
    </ul>
</aside>
