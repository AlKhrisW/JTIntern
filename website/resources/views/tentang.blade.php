@extends('layouts_guest.template')

@push('css')
    <!-- Landing CSS (shared) -->
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">

    <!-- Tentang CSS (page-specific) -->
    <link rel="stylesheet" href="{{ asset('css/tentang.css') }}">
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
                        dengan kebutuhan nyata dunia kerja, sehingga setiap mahasiswa
                        siap menghadapi tantangan industri sejak dini.
                    </p>


                </div>

                <!-- Right: Image -->
                <div class="intro-img-wrap" data-reveal="right">
                    <img src="{{ asset('images/24.jpg') }}" alt="Tim JTIntern berdiskusi">
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

                        <!-- Misi 1 -->
                        <div class="misi-item" data-reveal data-reveal-delay="1">
                            <div class="misi-icon--photo">
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

                        <!-- Misi 2 -->
                        <div class="misi-item" data-reveal data-reveal-delay="2">
                            <div class="misi-icon--photo">
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

                        <!-- Misi 3 -->
                        <div class="misi-item" data-reveal data-reveal-delay="3">
                            <div class="misi-icon--photo">
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

                <!-- Right: Visual Decorative -->
                <div class="misi-visual" data-reveal="right">
                    <div class="misi-visual-stat">
                        <span class="misi-visual-num">100+</span>
                        <span class="misi-visual-lbl">Mitra Perusahaan</span>
                    </div>
                    <div class="misi-visual-divider"></div>
                    <div class="misi-visual-stat">
                        <span class="misi-visual-num">2500+</span>
                        <span class="misi-visual-lbl">Mahasiswa Terhubung</span>
                    </div>
                    <div class="misi-visual-divider"></div>
                    <div class="misi-visual-stat">
                        <span class="misi-visual-num">AI</span>
                        <span class="misi-visual-lbl">Matching System</span>
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
                        <img src="{{ asset('images/aldo.jpg') }}" alt="Aldo">
                    </div>
                    <div class="tim-name">Aldo</div>
                </div>

                <div class="tim-card" data-reveal data-reveal-delay="2">
                    <div class="tim-avatar">
                        <img src="{{ asset('images/aqila.jpg') }}" alt="Aqila">
                    </div>
                    <div class="tim-name">Aqila</div>
                </div>

                <div class="tim-card" data-reveal data-reveal-delay="3">
                    <div class="tim-avatar">
                        <img src="{{ asset('images/Anastasya.jpg') }}" alt="Anastasya">
                    </div>
                    <div class="tim-name">Anastasya</div>
                </div>

                <div class="tim-card" data-reveal data-reveal-delay="4">
                    <div class="tim-avatar">
                        <img src="{{ asset('images/Meisy.jpg') }}" alt="Meisy">
                    </div>
                    <div class="tim-name">Meisy</div>
                </div>

                <div class="tim-card" data-reveal data-reveal-delay="5">
                    <div class="tim-avatar">
                        <img src="{{ asset('images/Qodri.jpg') }}" alt="Qodri">
                    </div>
                    <div class="tim-name">Qodri</div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
<script>
    // ── Scroll Reveal Observer ──────────────────────────────────────────────
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