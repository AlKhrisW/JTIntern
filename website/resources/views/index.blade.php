@extends('layouts_guest.template')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
@endpush

@section('content')
    
    <!-- ===== HERO SECTION ===== -->
    <section class="hero" id="beranda">
        <div class="hero-bg">
            <img src="{{ asset('images/background.jpg') }}" alt="Background Foto">
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
                    <a href="{{ route('rekomendasi') }}" class="my-btn-primary">
                        <i class="fas fa-search"></i>
                        Cari Rekomendasi Magang
                    </a>
                    <a href="#panduan" class="my-btn-secondary">
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

        <!-- ===== SCROLL INDICATOR (elegant line + chevron) ===== -->
        <a href="#panduan" class="scroll-indicator" aria-label="Scroll ke bawah">
            <span class="scroll-indicator-label">Gulir ke Bawah</span>
            <div class="scroll-line-wrap">
                <div class="scroll-line-track">
                    <div class="scroll-line-dot"></div>
                </div>
            </div>
            <div class="scroll-chevron">
                <svg width="20" height="12" viewBox="0 0 20 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1L10 10L19 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </a>
    </section>

    <!-- ===== HOW IT WORKS ===== -->
    <section class="section how-section" id="panduan">
        <div class="container">
            <h2 class="section-title" style="text-align:center;">Bagaimana JTIntern Membantumu?</h2>
            <p class="section-desc" style="text-align:center; margin: 0 auto 4rem;">
                Kami menyederhanakan proses pencarian tempat magang dengan tiga langkah mudah
                untuk masa depan cemerlangmu.
            </p>

            <!-- Steps: horizontal flow layout, no card -->
            <div class="steps-flow">
                <!-- Step 1 -->
                <div class="step-item">
                    <div class="step-icon-wrap">
                        <span class="step-number">01</span>
                        <div class="step-icon">
                            <img src="/images/16.png" alt="Isi Data Diri" class="step-icon-image rounded-circle">
                        </div>
                    </div>
                    <h3 class="step-title">Isi Data Diri</h3>
                    <p class="step-desc">
                        Lengkapi profil, keahlian, dan minat kariermu untuk
                        membantu algoritma kami mengenalimu.
                    </p>
                </div>

                <!-- Connector Arrow 1 -->
                <div class="step-connector">
                    <div class="connector-line"></div>
                    <svg class="connector-arrow" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="16" cy="16" r="15" stroke="currentColor" stroke-width="1.5" stroke-dasharray="4 3"/>
                        <path d="M12 16h8M17 13l3 3-3 3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>

                <!-- Step 2 -->
                <div class="step-item">
                    <div class="step-icon-wrap">
                        <span class="step-number">02</span>
                        <div class="step-icon">
                            <img src="/images/17.png" alt="Sistem Mencocokkan" class="step-icon-image rounded-circle">
                        </div>
                    </div>
                    <h3 class="step-title">Sistem Mencocokkan</h3>
                    <p class="step-desc">
                        AI kami memproses data perusahaan yang tersedia
                        untuk menemukan kecocokan yang paling akurat.
                    </p>
                </div>

                <!-- Connector Arrow 2 -->
                <div class="step-connector">
                    <div class="connector-line"></div>
                    <svg class="connector-arrow" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="16" cy="16" r="15" stroke="currentColor" stroke-width="1.5" stroke-dasharray="4 3"/>
                        <path d="M12 16h8M17 13l3 3-3 3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>

                <!-- Step 3 -->
                <div class="step-item">
                    <div class="step-icon-wrap">
                        <span class="step-number">03</span>
                        <div class="step-icon">
                            <img src="/images/18.png" alt="Lihat Rekomendasi" class="step-icon-image rounded-circle">
                        </div>
                    </div>
                    <h3 class="step-title">Lihat Rekomendasi</h3>
                    <p class="step-desc">
                        Temukan peluang magang terbaik yang
                        selaras dengan bidang studimu di JTI Polinema.
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

            <div class="features-layout">
                <!-- Left Feature Block -->
                <div class="feature-block">
                    <div class="feature-icon-small">
                        <img src="/images/19.jpg" alt="Rekomendasi Personal" class="feature-icon-image">
                    </div>
                    <div class="feature-block-content">
                        <h3 class="feature-title">Rekomendasi Personal</h3>
                        <p class="feature-desc">
                            Sistem kami menganalisis lebih dari 10 parameter
                            untuk memastikan setiap rekomendasi selaras
                            dengan bakat unikmu.
                        </p>
                        <ul class="feature-list">
                            <li><i class="fas fa-check-circle"></i><span>Berdasarkan Minat</span></li>
                            <li><i class="fas fa-check-circle"></i><span>Berdasarkan Skill</span></li>
                            <li><i class="fas fa-check-circle"></i><span>Berdasarkan Tools yang Dikuasai</span></li>
                            <li><i class="fas fa-check-circle"></i><span>Berdasarkan Preferensi Perusahaan</span></li>
                        </ul>
                    </div>
                </div>

                <!-- Divider -->
                <div class="features-divider"></div>

                <!-- Center: Image -->
                <div class="feature-img-wrap">
                    <img src="{{ asset('images/keunggulan.jpg') }}" alt="Keunggulan Foto">
                    <div class="feature-img-overlay"></div>
                </div>

                <!-- Divider -->
                <div class="features-divider"></div>

                <!-- Right Feature Block -->
                <div class="feature-block">
                    <div class="feature-icon-small">
                        <img src="/images/20.jpg" alt="Mitra Terpercaya" class="feature-icon-image">
                    </div>
                    <div class="feature-block-content">
                        <h3 class="feature-title">Mitra Terpercaya</h3>
                        <p class="feature-desc">
                            Bekerjasama dengan perusahaan mulai dari
                            startup hingga korporasi multinasional yang
                            kredibel.
                        </p>
                        <ul class="feature-list">
                            <li><i class="fas fa-check-circle"></i><span>Startup Teknologi</span></li>
                            <li><i class="fas fa-check-circle"></i><span>Perusahaan Multinasional</span></li>
                            <li><i class="fas fa-check-circle"></i><span>BUMN & Instansi Pemerintah</span></li>
                            <li><i class="fas fa-check-circle"></i><span>Mitra Terverifikasi Polinema</span></li>
                        </ul>
                    </div>
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

            <div class="testimonials-masonry">
                <!-- Testimonial 1 -->
                <div class="testi-item">
                    <div class="testi-quote-mark">"</div>
                    <p class="testi-text">
                        Berkat sistem rekomendasi ini, saya berhasil magang
                        di Gojek sebagai UI Designer. Penilaian kecocokan
                        skill-nya sangat akurat dengan apa yang dibutuhkan industri.
                    </p>
                    <div class="testi-footer">
                        <div class="stars">★★★★★</div>
                        <div class="testi-author">
                            <span class="testi-name">Siti Aminah</span>
                            <span class="testi-cohort">TI POLINEMA '20</span>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="testi-item testi-item--accent">
                    <div class="testi-quote-mark">"</div>
                    <p class="testi-text">
                        Proses pendaftarannya sangat cepat. Saya tidak perlu
                        lagi bingung memilih ratusan lowongan karena sistem
                        sudah memfilter yang terbaik untuk profil saya.
                    </p>
                    <div class="testi-footer">
                        <div class="stars">★★★★★</div>
                        <div class="testi-author">
                            <span class="testi-name">Budi Santoso</span>
                            <span class="testi-cohort">TI POLINEMA '23</span>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="testi-item">
                    <div class="testi-quote-mark">"</div>
                    <p class="testi-text">
                        Sangat membantu! Algoritma pencocokannya benar-benar memahami
                        latar belakang akademik dan keahlian saya. Hasilnya saya diterima
                        magang di Tokopedia divisi Data Engineering.
                    </p>
                    <div class="testi-footer">
                        <div class="stars">★★★★★</div>
                        <div class="testi-author">
                            <span class="testi-name">Reza Firmansyah</span>
                            <span class="testi-cohort">TI POLINEMA '22</span>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 4 -->
                <div class="testi-item testi-item--accent">
                    <div class="testi-quote-mark">"</div>
                    <p class="testi-text">
                        Fitur rekomendasi berdasarkan tools yang dikuasai sangat relevan.
                        Saya yang fokus di Flutter langsung diarahkan ke perusahaan yang
                        memang butuh mobile developer.
                    </p>
                    <div class="testi-footer">
                        <div class="stars">★★★★★</div>
                        <div class="testi-author">
                            <span class="testi-name">Dewi Rahayu</span>
                            <span class="testi-cohort">TI POLINEMA '21</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection