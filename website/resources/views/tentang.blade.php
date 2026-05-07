@extends('layouts_guest.template')

@push('css')
    <!-- Landing CSS (shared) -->
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">

    <!-- Tentang CSS (page-specific) -->
    <link rel="stylesheet" href="{{ asset('css/tentang.css') }}">

    <style>
        /* ── Animasi Float (naik-turun halus) ── */
        @keyframes floatY {
            0%, 100% { transform: translateY(0px); }
            50%       { transform: translateY(-12px); }
        }

        /* ── Animasi Float sedikit miring ── */
        @keyframes floatTilt {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33%       { transform: translateY(-8px) rotate(1deg); }
            66%       { transform: translateY(-4px) rotate(-0.8deg); }
        }

        /* ── Animasi Drift horizontal halus ── */
        @keyframes driftX {
            0%, 100% { transform: translateX(0px) translateY(0px); }
            40%       { transform: translateX(6px) translateY(-6px); }
            80%       { transform: translateX(-4px) translateY(-3px); }
        }

        /* ── Animasi zoom-pulse halus ── */
        @keyframes zoomPulse {
            0%, 100% { transform: scale(1); }
            50%       { transform: scale(1.04); }
        }

        /* Intro section — gambar kanan: float naik-turun */
        .intro-img-wrap img {
            animation: floatY 5s ease-in-out infinite;
            will-change: transform;
        }

        /* Mosaic main image: float dengan sedikit tilt */
        .mosaic-img-main {
            animation: floatTilt 6s ease-in-out infinite;
            will-change: transform;
        }

        /* Mosaic small image: drift arah berbeda, delay agar tidak sinkron */
        .mosaic-img-small {
            animation: driftX 7s ease-in-out infinite 1.5s;
            will-change: transform;
        }

        /* Avatar tim: zoom-pulse saat hover saja (tidak ganggu layout) */
        .tim-avatar img {
            transition: transform 0.4s ease;
        }
        .tim-card:hover .tim-avatar img {
            animation: zoomPulse 1.2s ease-in-out infinite;
        }
    </style>
@endpush

@section('content')
    <!-- ===== SECTION 1: MENGENAL JTINTERN ===== -->
    <section class="tentang-intro section">
        <div class="container">
            <div class="intro-grid">
                <!-- Left: Text -->
                <div class="intro-content" data-reveal="left">
                    <h2 class="intro-title">Mengenal JTIntern</h2>
                    <p class="intro-desc">
                        Platform penghubung mahasiswa JTI Polinema dengan industri
                        teknologi. Kami hadir untuk menyelaraskan kurikulum akademik
                        dengan kebutuhan nyata dunia kerja.
                    </p>

                    <div class="intro-badges">
                        <div class="intro-badge" data-reveal data-reveal-delay="1">
                            <div class="intro-badge-title">Eksklusif</div>
                            <div class="intro-badge-desc">Terintegrasi khusus dengan JTI Polinema.</div>
                        </div>
                        <div class="intro-badge" data-reveal data-reveal-delay="2">
                            <div class="intro-badge-title">Terstandar</div>
                            <div class="intro-badge-desc">Sesuai standar kurikulum TI nasional.</div>
                        </div>
                    </div>
                </div>

                <!-- Right: Image -->
                <div class="intro-img-wrap" data-reveal="right">
                    <img src="https://i.pinimg.com/1200x/17/4e/32/174e32c7690dc7259a873d5b2f4b3292.jpg"
                        alt="Tim JTIntern berdiskusi">
                </div>
            </div>

            <!-- Stats Row -->
            <div class="stats-row">
                <div class="stat-item" data-reveal data-reveal-delay="1">
                    <div class="stat-number">100+</div>
                    <div class="stat-label">Mitra Perusahaan</div>
                </div>
                <div class="stat-item" data-reveal data-reveal-delay="2">
                    <div class="stat-number">2500+</div>
                    <div class="stat-label">Mahasiswa Aktif</div>
                </div>
                <div class="stat-item" data-reveal data-reveal-delay="3">
                    <div class="stat-number">98%</div>
                    <div class="stat-label">Kurikulum Relevan</div>
                </div>
                <div class="stat-item" data-reveal data-reveal-delay="4">
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
                <div class="misi-content" data-reveal="left">
                    <h2 class="misi-title">Misi Kami: Menyelaraskan<br>Akademik dengan Industri</h2>

                    <div class="misi-list">

                        <!-- Misi 1: Sinkronisasi Skill — foto 21.jpg -->
                        <div class="misi-item" data-reveal data-reveal-delay="1">
                            <div class="misi-icon misi-icon--photo">
                                <img src="{{ asset('images/22.jpg') }}" alt="Sinkronisasi Skill" class="misi-icon-img">
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

                        <!-- Misi 2: Kolaborasi Industri — foto 21.jpg -->
                        <div class="misi-item" data-reveal data-reveal-delay="2">
                            <div class="misi-icon misi-icon--photo">
                                <img src="{{ asset('images/21.jpg') }}" alt="Kolaborasi Industri" class="misi-icon-img">
                            </div>
                            <div>
                                <div class="misi-item-title">Kolaborasi Industri Strategis</div>
                                <p class="misi-item-desc">
                                    Membangun dan menjaga kemitraan dengan perusahaan teknologi terkemuka 
                                    untuk menyediakan posisi magang berkualitas tinggi dan relevan dengan 
                                    perkembangan industri TI.
                                </p>
                            </div>
                        </div>

                        <!-- Misi 3: Pengalaman Industri — foto 23.jpg -->
                        <div class="misi-item" data-reveal data-reveal-delay="3">
                            <div class="misi-icon misi-icon--photo">
                                <img src="{{ asset('images/23.jpg') }}" alt="Pengalaman Industri Nyata" class="misi-icon-img">
                            </div>
                            <div>
                                <div class="misi-item-title">Pengalaman Industri Nyata</div>
                                <p class="misi-item-desc">
                                    Memberikan kesempatan magang di perusahaan teknologi ternama 
                                    sehingga mahasiswa mendapatkan pengalaman langsung mengerjakan 
                                    proyek-proyek industri terkini.
                                </p>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Right: Image Mosaic (TANPA icon-box hijau) -->
                <div class="misi-mosaic" data-reveal="right">
                    <div class="mosaic-top">
                        <img src="https://i.pinimg.com/1200x/b2/bc/92/b2bc92a31054fa6117dd8e9a2885e71a.jpg"
                            alt="Profesional" class="mosaic-img-main">
                    </div>
                    <div class="mosaic-bottom">
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
            <h2 class="section-title" style="text-align:center;" data-reveal>Otak di Balik JTIntern</h2>
            <p class="section-desc" style="text-align:center; margin: 0 auto 3rem;" data-reveal data-reveal-delay="1">
                Tim pengembang berdedikasi dari JTI Polinema yang berkomitmen
                membangun ekosistem digital untuk kemajuan bersama.
            </p>

            <div class="tim-grid">
                <div class="tim-card" data-reveal data-reveal-delay="1">
                    <div class="tim-avatar">
                        <img src="https://i.pinimg.com/736x/b8/42/58/b842583b2176aace3eab9547d28d1239.jpg" alt="Aldo"
                            onerror="this.style.display='none'">
                    </div>
                    <div class="tim-name">Aldo</div>
                    <div class="tim-role">PENGEMBANG</div>
                </div>

                <div class="tim-card" data-reveal data-reveal-delay="2">
                    <div class="tim-avatar">
                        <img src="https://i.pinimg.com/736x/be/cd/ee/becdee9c1639bcc0bbd97f61baa67a08.jpg" alt="Aqila"
                            onerror="this.style.display='none'">
                    </div>
                    <div class="tim-name">Aqila</div>
                    <div class="tim-role">PENGEMBANG</div>
                </div>

                <div class="tim-card" data-reveal data-reveal-delay="3">
                    <div class="tim-avatar">
                        <img src="https://i.pinimg.com/736x/1f/2f/da/1f2fda9613986902f83d21e86cac5771.jpg" alt="Anastasya"
                            onerror="this.style.display='none'">
                    </div>
                    <div class="tim-name">Anastasya</div>
                    <div class="tim-role">PENGEMBANG</div>
                </div>

                <div class="tim-card" data-reveal data-reveal-delay="4">
                    <div class="tim-avatar">
                        <img src="https://i.pinimg.com/736x/22/60/e0/2260e0c9328c0b57fc409980df8148f2.jpg" alt="Meisy"
                            onerror="this.style.display='none'">
                    </div>
                    <div class="tim-name">Meisy</div>
                    <div class="tim-role">PENGEMBANG</div>
                </div>

                <div class="tim-card" data-reveal data-reveal-delay="5">
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
@endsection

@push('js')
<script>
    // ── Scroll Reveal Observer ────────────────────────────────────────────────
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12 });

    document.querySelectorAll('[data-reveal]').forEach(el => observer.observe(el));
</script>
@endpush