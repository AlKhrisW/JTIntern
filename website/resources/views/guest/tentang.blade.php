<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tentang Kami - JTIntern</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Landing CSS (shared) -->
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">

    <!-- Tentang CSS (page-specific) -->
    <link rel="stylesheet" href="{{ asset('css/tentang.css') }}">
</head>
<body>

    <!-- ===== NAVBAR ===== -->
    <nav class="navbar">
        <div class="navbar-brand">
            <img src="{{ asset('images/logoJTIntern.png') }}" alt="JTIntern Logo" class="navbar-logo">
        </div>

        <ul class="navbar-nav">
            <li><a href="{{ route('home') }}">Beranda</a></li>
            <li><a href="{{ route('home') }}#rekomendasi">Rekomendasi</a></li>
            <li><a href="{{ route('tentang') }}" class="active">Tentang Kami</a></li>
        </ul>

        @if (Route::has('login'))
            @auth
                <a href="{{ url('/home') }}" class="btn-admin">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn-admin">Masuk sebagai Admin</a>
            @endauth
        @endif
    </nav>

    <!-- ===== SECTION 1: MENGENAL JTINTERN ===== -->
    <section class="tentang-intro section">
        <div class="container">
            <div class="intro-grid">
                <!-- Left: Text -->
                <div class="intro-content">
                    <h2 class="intro-title">Mengenal JTIntern</h2>
                    <p class="intro-desc">
                        Platform penghubung mahasiswa JTI Polinema dengan industri
                        teknologi. Kami hadir untuk menyelaraskan kurikulum akademik
                        dengan kebutuhan nyata dunia kerja.
                    </p>

                    <div class="intro-badges">
                        <div class="intro-badge">
                            <div class="intro-badge-title">Eksklusif</div>
                            <div class="intro-badge-desc">Terintegrasi khusus dengan JTI Polinema.</div>
                        </div>
                        <div class="intro-badge">
                            <div class="intro-badge-title">Terstandar</div>
                            <div class="intro-badge-desc">Sesuai standar kurikulum TI nasional.</div>
                        </div>
                    </div>
                </div>

                <!-- Right: Image -->
                <div class="intro-img-wrap">
                    <img src="https://i.pinimg.com/1200x/17/4e/32/174e32c7690dc7259a873d5b2f4b3292.jpg"
                         alt="Tim JTIntern berdiskusi">
                </div>
            </div>

            <!-- Stats Row -->
            <div class="stats-row">
                <div class="stat-item">
                    <div class="stat-number">100+</div>
                    <div class="stat-label">Mitra Perusahaan</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">2500+</div>
                    <div class="stat-label">Mahasiswa Aktif</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">98%</div>
                    <div class="stat-label">Kurikulum Relevan</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">AI</div>
                    <div class="stat-label">Matching System</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== SECTION 2: MISI ===== -->
    <section class="misi-section section">
        <div class="container">
            <div class="misi-grid">
                <!-- Left: Text -->
                <div class="misi-content">
                    <h2 class="misi-title">Misi Kami: Menyelaraskan<br>Akademik dengan Industri</h2>

                    <div class="misi-list">
                        <div class="misi-item">
                            <div class="misi-icon" style="background: #e8f5e0;">
                                <i class="fas fa-bolt" style="color: var(--green-primary);"></i>
                            </div>
                            <div>
                                <div class="misi-item-title">Sinkronisasi Skill</div>
                                <p class="misi-item-desc">
                                    Menjamin setiap posisi magang yang ditawarkan memiliki
                                    relevansi langsung dengan Capaian Pembelajaran Lulusan (CPL)
                                    program studi.
                                </p>
                            </div>
                        </div>

                        <div class="misi-item">
                            <div class="misi-icon" style="background: #fef9e7;">
                                <i class="fas fa-chart-line" style="color: var(--yellow-accent);"></i>
                            </div>
                            <div>
                                <div class="misi-item-title">Monitoring Transparan</div>
                                <p class="misi-item-desc">
                                    Memfasilitasi dosen pembimbing dalam memantau
                                    perkembangan mahasiswa secara real-time di industri.
                                </p>
                            </div>
                        </div>

                        <div class="misi-item">
                            <div class="misi-icon" style="background: #e8f5e0;">
                                <i class="fas fa-rocket" style="color: var(--green-light);"></i>
                            </div>
                            <div>
                                <div class="misi-item-title">Akselerasi Karir</div>
                                <p class="misi-item-desc">
                                    Memfasilitasi kesiapan kerja mahasiswa melalui pengalaman
                                    profesional yang terkurasi dan berkualitas tinggi.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Image Mosaic -->
                <div class="misi-mosaic">
                    <div class="mosaic-top">
                        <img src="https://i.pinimg.com/1200x/b2/bc/92/b2bc92a31054fa6117dd8e9a2885e71a.jpg"
                             alt="Profesional" class="mosaic-img-main">
                        <div class="mosaic-icon-box mosaic-icon-top">
                            <i class="fas fa-handshake"></i>
                        </div>
                    </div>
                    <div class="mosaic-bottom">
                        <div class="mosaic-icon-box mosaic-icon-bottom">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <img src="https://i.pinimg.com/1200x/66/35/b8/6635b80a9421a25601c6f820bc07524c.jpg"
                             alt="Tim diskusi" class="mosaic-img-small">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== SECTION 3: TIM PENGEMBANG ===== -->
    <section class="tim-section section">
        <div class="container">
            <h2 class="section-title" style="text-align:center;">Otak di Balik JTIntern</h2>
            <p class="section-desc" style="text-align:center; margin: 0 auto 3rem;">
                Tim pengembang berdedikasi dari JTI Polinema yang berkomitmen
                membangun ekosistem digital untuk kemajuan bersama.
            </p>

            <div class="tim-grid">
                <!-- Member 1 -->
                <div class="tim-card">
                    <div class="tim-avatar">
                        <img src="https://i.pinimg.com/736x/b8/42/58/b842583b2176aace3eab9547d28d1239.jpg" alt="Aldo"
                             onerror="this.style.display='none'">
                    </div>
                    <div class="tim-name">Aldo</div>
                    <div class="tim-role">PENGEMBANG</div>
                </div>

                <!-- Member 2 -->
                <div class="tim-card">
                    <div class="tim-avatar">
                        <img src="https://i.pinimg.com/736x/be/cd/ee/becdee9c1639bcc0bbd97f61baa67a08.jpg" alt="Aqila"
                             onerror="this.style.display='none'">
                    </div>
                    <div class="tim-name">Aqila</div>
                    <div class="tim-role">PENGEMBANG</div>
                </div>

                <!-- Member 3 -->
                <div class="tim-card">
                    <div class="tim-avatar">
                        <img src="https://i.pinimg.com/736x/1f/2f/da/1f2fda9613986902f83d21e86cac5771.jpg" alt="Anastasya"
                             onerror="this.style.display='none'">
                    </div>
                    <div class="tim-name">Anastasya</div>
                    <div class="tim-role">PENGEMBANG</div>
                </div>

                <!-- Member 4 -->
                <div class="tim-card">
                    <div class="tim-avatar">
                        <img src="https://i.pinimg.com/736x/22/60/e0/2260e0c9328c0b57fc409980df8148f2.jpg" alt="Meisy"
                             onerror="this.style.display='none'">
                    </div>
                    <div class="tim-name">Meisy</div>
                    <div class="tim-role">PENGEMBANG</div>
                </div>

                <!-- Member 5 -->
                <div class="tim-card">
                    <div class="tim-avatar">
                        <img src="https://i.pinimg.com/736x/77/b3/e7/77b3e798936e420947797124fe2a5c87.jpg" alt="Qodri"
                             onerror="this.style.display='none'">
                    </div>
                    <div class="tim-name">Qodri</div>
                    <div class="tim-role">PENGEMBANG</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== FOOTER ===== -->
    <footer class="footer">
        <div class="footer-inner">
            <div class="footer-logo">
                <img src="{{ asset('images/logoJTIntern.png') }}" alt="JTIntern Logo">
            </div>

            <nav class="footer-nav">
                <a href="#">Kebijakan Privasi</a>
                <a href="#">Syarat &amp; Ketentuan</a>
                <a href="#">Bantuan</a>
            </nav>

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