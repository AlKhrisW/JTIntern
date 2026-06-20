<nav class="navbar navbar-expand-lg fixed-top shadow">
    <div class="container-fluid align-items-center">

        <div class="d-flex" style="flex: 1;">
            <a class="navbar-brand me-0" href="#">
                <img src="{{ asset('images/JTIntern_resize.png') }}" alt="JTIntern Logo" class="navbar-logo">
            </a>
        </div>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-center w-100">
                    <li class="nav-item">
                        <a class="nav-link mx-lg-2 {{ $activeMenu == 'home' ? 'active' : '' }}" aria-current="page"
                            href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-lg-2 {{ $activeMenu == 'rekomendasi' ? 'active' : '' }}"
                            href="{{ route('rekomendasi.reset') }}">Rekomendasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-lg-2 {{ $activeMenu == 'tentang' ? 'active' : '' }}"
                            href="{{ route('tentang') }}">Tentang kami</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="d-flex justify-content-end" style="flex: 1;">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

    </div>
</nav>
