<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JTIntern - Sistem Rekomendasi Tempat Magang</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Landing CSS -->
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>
<body>

    <!-- ===== NAVBAR ===== -->
    <nav class="navbar">
        <div class="navbar-brand">
            <img src="{{ asset('images/logoJTIntern.png') }}" alt="JTIntern Logo" class="navbar-logo">
        </div>

        <ul class="navbar-nav">
            <li><a href="#" class="active">Beranda</a></li>
            <li><a href="#rekomendasi">Rekomendasi</a></li>
            <li><a href="{{ route('tentang') }}">Tentang Kami</a></li>
        </ul>

        @if (Route::has('login'))
            @auth
                <a href="{{ url('/home') }}" class="btn-admin">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn-admin">Masuk sebagai Admin</a>
            @endauth
        @endif
    </nav>

    <!-- ===== HERO SECTION ===== -->
    <section class="hero" id="beranda">
        <div class="hero-bg">
            <img src="{{ asset('images/background.jpg') }}" alt="Background Foto">
                 alt="Tim profesional di kantor">
        </div>

        <div class="hero-container">
            <!-- Left: Text -->
            <div class="hero-content">
                <div class="hero-badge">POLITEKNIK NEGERI MALANG</div>
                <h1 class="hero-title">
                    Sistem<br>
                    Rekomendasi<br>
                    Tempat Magang
                </h1>
                <p class="hero-subtitle">
                    Temukan magang yang sesuai dengan profil, skill, dan
                    minatmu dalam hitungan detik menggunakan
                    <strong>teknologi pencocokan cerdas kami.</strong>
                </p>
                <div class="hero-actions">
                    <a href="#" class="btn-primary">   {{-- Diubah: tidak mengarah ke #rekomendasi --}}
                        <i class="fas fa-search"></i>
                        Cari Rekomendasi Magang
                    </a>
                    <a href="#panduan" class="btn-secondary">
                        Lihat Panduan
                    </a>
                </div>
            </div>

            <!-- Right: Company Card -->
            <div class="company-card-wrap">
                <div class="card-stack">
                    <div class="card-bg card-bg-2"></div>
                    <div class="card-bg card-bg-1"></div>
                    <div class="company-card">
                        <div class="company-name">PT Gojek Indonesia</div>
                        <div class="company-location">
                            <i class="fas fa-map-marker-alt"></i>
                            Jakarta Selatan Teknologi
                        </div>
                        <div class="badge-top">Paling Cocok Ke #1</div>
                        <div class="match-row">
                            <span class="match-label">Tingkat Kecocokan</span>
                            <span class="match-percent">98%</span>
                        </div>
                        <div class="match-bar">
                            <div class="match-bar-fill"></div>
                        </div>
                        <div class="company-tags">
                            <span class="tag">Backend Dev</span>
                            <span class="tag">Java Script</span>
                            <span class="tag">Paid Internship</span>
                            <span class="tag">6 Bulan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== HOW IT WORKS ===== -->
    <section class="section how-section" id="panduan">
        <div class="container">
            <h2 class="section-title" style="text-align:center;">Bagaimana JTIntern Membantumu?</h2>
            <p class="section-desc" style="text-align:center;">
                Kami menyederhanakan proses pencarian tempat magang dengan tiga langkah mudah
                untuk masa depan cemerlangmu.
            </p>

            <div class="steps-grid">
                <!-- Step 1 -->
                <div class="step-card">
                    <div class="step-icon-wrap">
                        <span class="step-number">01</span>
                        <div class="step-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                    </div>
                    <h3 class="step-title">Isi Data Diri</h3>
                    <p class="step-desc">
                        Lengkapi profil, keahlian, dan minat kariermu untuk
                        membantu algoritma kami mengenalimu.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="step-card">
                    <div class="step-icon-wrap">
                        <span class="step-number">02</span>
                        <div class="step-icon">
                            <i class="fas fa-brain"></i>
                        </div>
                    </div>
                    <h3 class="step-title">Sistem Mencocokkan</h3>
                    <p class="step-desc">
                        AI kami memproses data perusahaan yang tersedia
                        untuk menemukan kecocokan yang paling akurat.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="step-card">
                    <div class="step-icon-wrap">
                        <span class="step-number">03</span>
                        <div class="step-icon">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                    </div>
                    <h3 class="step-title">Lihat Rekomendasi</h3>
                    <p class="step-desc">
                        Dapatkan daftar lowongan magang terbaik dan segera
                        kirimkan lamaranmu langsung dari platform.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== KEUNGGULAN ===== -->
    <section class="section features-section" id="tentang">
        <div class="container">
            <p class="section-label">KEUNGGULAN KAMI</p>
            <h2 class="section-title">
                Solusi Cerdas untuk Langkah Awal<br>
                Kariemu
            </h2>

            <div class="features-grid">
                <!-- Feature Left -->
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="feature-title">Rekomendasi Personal</h3>
                    <p class="feature-desc">
                        Sistem kami menganalisis lebih dari 10 parameter
                        untuk memastikan setiap rekomendasi selaras
                        dengan bakat unikmu.
                    </p>
                    <div class="feature-tags">
                        <span class="tag">Berdasarkan Minat</span>
                        <span class="tag">Berdasarkan Skill</span>
                    </div>
                </div>

                <!-- Feature Center: Image -->
                <div class="feature-img-wrap">
                    <img src="{{ asset('images/keunggulan.jpg') }}" alt="Keunggulan Foto">
                         alt="Tim berdiskusi bersama">
                </div>

                <!-- Feature Right -->
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-download"></i>
                    </div>
                    <h3 class="feature-title">Mitra Terpercaya</h3>
                    <p class="feature-desc">
                        Bekerjasama dengan perusahaan mulai dari
                        startup hingga korporasi multinasional yang
                        kredibel.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== TESTIMONI ===== -->
    <section class="section testimonials-section" id="rekomendasi">
        <div class="container">
            <p class="section-label">TESTIMONI ALUMNI</p>
            <h2 class="section-title">
                Apa Kata Mahasiswa<br>
                Polinema?
            </h2>

            <div class="testimonials-grid">
                <!-- Testimonial 1 -->
                <div class="testimonial-card">
                    <div class="stars">★★★★★</div>
                    <p class="testimonial-text">
                        "Berkat sistem rekomendasi ini, saya berhasil magang
                        di Gojek sebagai UI Designer. Penilaian kecocokan
                        skill-nya sangat akurat dengan apa yang dibutuhkan
                        industri."
                    </p>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <img src="https://randomuser.me/api/portraits/women/44.jpg"
                                 alt="Siti Aminah"
                                 onerror="this.style.display='none'; this.parentElement.innerHTML='<i class=\'fas fa-user\'></i>'">
                        </div>
                        <div>
                            <div class="author-name">Siti Aminah</div>
                            <div class="author-info">TI POLINEMA '20</div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="testimonial-card">
                    <div class="stars">★★★★★</div>
                    <p class="testimonial-text">
                        "Proses pendaftarannya sangat cepat. Saya tidak perlu
                        lagi bingung memilih ratusan lowongan karena sistem
                        sudah memfilter yang terbaik untuk profil saya."
                    </p>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg"
                                 alt="Budi Santoso"
                                 onerror="this.style.display='none'; this.parentElement.innerHTML='<i class=\'fas fa-user\'></i>'">
                        </div>
                        <div>
                            <div class="author-name">Budi Santoso</div>
                            <div class="author-info">TI POLINEMA '23</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== FOOTER ===== -->
    <footer class="footer">
        <div class="footer-inner">
            <!-- Logo -->
            <div class="footer-logo">
                <img src="{{ asset('images/logoJTIntern.png') }}" alt="JTIntern Logo">
            </div>

            <!-- Nav Links -->
            <nav class="footer-nav">
                <a href="#">Kebijakan Privasi</a>
                <a href="#">Syarat &amp; Ketentuan</a>
                <a href="#">Bantuan</a>
            </nav>

            <!-- Icons -->
            <div class="footer-icons">
                <a href="#" aria-label="Website"><i class="fas fa-globe"></i></a>
                <a href="#" aria-label="Email"><i class="fas fa-envelope"></i></a>
            </div>
        </div>

        <div class="footer-bottom">
            <p class="footer-copy">
                &copy; 2026 JTI-Politeknik Negeri Malang. All Rights Reserved.
            </p>
            <p class="footer-platform">Platform Rekomendasi Magang</p>
        </div>
    </footer>

</body>
</html>