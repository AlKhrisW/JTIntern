@extends('layouts_guest.template')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
@endpush

@section('content')
    
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
                    <a href="#" class="my-btn-primary">   {{-- Diubah: tidak mengarah ke #rekomendasi --}}
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
                            <img src="/images/16.png" 
                                alt="Isi Data Diri" 
                                class="step-icon-image rounded-circle">
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
                            <img src="/images/17.png" 
                                alt="Sistem Mencocokkan" 
                                class="step-icon-image rounded-circle">
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
                            <img src="/images/18.png" 
                                alt="Lihat Rekomendasi" 
                                class="step-icon-image rounded-circle">
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
                        <img src="/images/19.jpg" 
                                alt="Rekomendasi Personal" 
                                class="feature-icon-image">
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
                        <img src="/images/20.jpg" 
                                alt="Mitra Terpercaya" 
                                class="feature-icon-image">
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
@endsection