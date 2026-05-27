<aside class="d-flex flex-column">
    <div class="header">
        <button id="toggle">
            <i class="bi bi-columns-gap"></i>
        </button>
        <a href="{{ route('dashboard') }}" class="logo">
            <span>
                <img src="{{ asset('images/JTIntern_resize.png') }}" alt="JTIntern Logo" style="height: 30px">
            </span>
        </a>
    </div>
    
    <ul class="mb-auto">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ ($activeMenu == 'dashboard')? 'active' : '' }} ">
                <span class="icon">
                    <i class="bi bi-speedometer2"></i>
                </span>
                <span class="description">
                    Dashboard
                </span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('prodi.index') }}" class="nav-link {{ ($activeMenu == 'programStudi')? 'active' : '' }} ">
                <span class="icon">
                    <i class="bi bi-briefcase"></i>
                </span>
                <span class="description">
                    Program Studi
                </span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('matkul.index') }}" class="nav-link {{ ($activeMenu == 'mataKuliah')? 'active' : '' }} ">
                <span class="icon">
                    <i class="bi bi-file-earmark-text"></i>
                </span>
                <span class="description">
                    Mata Kuliah
                </span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('mahasiswa.index') }}" class="nav-link {{ ($activeMenu == 'mahasiswa')? 'active' : '' }} ">
                <span class="icon">
                    <i class="bi bi-people"></i>
                </span>
                <span class="description">
                    Mahasiswa
                </span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('nilai.index') }}" class="nav-link {{ ($activeMenu == 'nilai')? 'active' : '' }} ">
                <span class="icon">
                    <i class="bi bi-people"></i>
                </span>
                <span class="description">
                    Nilai Mahasiswa
                </span>
            </a>
        </li>
    </ul>

    {{-- <ul>
        <li class="nav-item">
            <a href="{{ route('admin.profil.index') }}" class="nav-link {{ ($activeMenu == 'profil')? 'active' : '' }} ">
                <span class="icon">
                    <i class="bi bi-people"></i>
                </span>
                <span class="description">
                    Profil Admin
                </span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span class="icon">
                    <i class="bi bi-box-arrow-right"></i>
                </span>
                <span class="description">
                    Keluar
                </span>
            </a>
        </li>
    </ul> --}}
</aside>
