<header class="navbar navbar-expand-lg navbar-light border-bottom fixed-top">
    <div class="container-fluid align-items-center">
        <div class="flex-grow-1 me-3">
            <div class="input-group">
                <span class="input-group-text bg-light border-0">
                    <i class="bi bi-search"></i>
                </span>
                <!-- 🔽 TAMBAH ID DI SINI -->
                <input type="text" id="searchGlobal" class="form-control border-0 bg-light" placeholder="Cari data...">
            </div>
        </div>

        <!-- Right Side -->
        <div class="d-flex align-items-center gap-3">

            <!-- Notification -->
            <i class="bi bi-bell fs-5"></i>

            <!-- Profile -->
            <img src="https://i.pravatar.cc/40" class="rounded-circle" width="35" height="35" alt="profile">
        </div>
    </div>
</header>

<!-- 🔽 TAMBAHAN SCRIPT -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('searchGlobal');
    if (!searchInput) return;

    // =========================
    // 🔥 RESTORE VALUE DARI URL
    // =========================
    const params = new URLSearchParams(window.location.search);
    const searchValue = params.get('search');

    if (searchValue) {
        searchInput.value = searchValue;
    }

    let url = new URL(window.location.href);

    // RESET kalau kosong
    searchInput.addEventListener('input', function () {

        if (this.value.trim() === '') {

            url = new URL(window.location.href);
            url.searchParams.delete('search');
            url.searchParams.delete('page');

            window.location.href = url.toString();
        }

    });

    // SEARCH saat ENTER
    searchInput.addEventListener('keydown', function (e) {

        if (e.key === 'Enter') {

            e.preventDefault();

            const keyword = this.value.trim();

            url = new URL(window.location.href);

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