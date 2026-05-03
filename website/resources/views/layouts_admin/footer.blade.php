<footer>
    <div class="container-fluid py-3">
        <!-- ROW 1 -->
        <div class="d-flex align-items-center justify-content-between flex-wrap mb-2">
            <!-- DIV 1: LOGO -->
            <div class="d-flex align-items-center">
                <img src="{{ asset('images/logoJTIntern.png') }}" width="70" class="me-2">
            </div>

            <!-- DIV 2,3,4: MENU -->
            <div class="d-flex align-items-center gap-4">
                <a href="#" class="text-dark text-decoration-none">Kebijakan Privasi</a>
                <a href="#" class="text-dark text-decoration-none">Syarat & Ketentuan</a>
                <a href="#" class="text-dark text-decoration-none">Bantuan</a>
            </div>

            <!-- DIV 5 & 6: ICON -->
            <div class="d-flex align-items-center gap-3">
                <i class="bi bi-globe"></i>
                <i class="bi bi-envelope"></i>
            </div>

        </div>

        <!-- ROW 2 -->
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <!-- DIV 7 -->
            <small class="text-muted">
                © {{ date('Y') }} Politeknik Negeri Malang. All rights reserved.
            </small>

            <!-- DIV 8 -->
            <small class="text-muted">
                Platform Rekomendasi Magang
            </small>
        </div>
    </div>
</footer>
