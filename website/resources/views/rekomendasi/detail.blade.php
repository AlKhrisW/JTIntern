@extends('layouts_guest.template')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endpush

@section('content')
    <div class="detail-page">
        <div class="detail-container">

            {{-- ── Tombol Kembali — TIDAK menghapus session ── --}}
            <a href="{{ route('rekomendasi.hasil') }}" class="nav-back">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 12H5M12 5l-7 7 7 7" />
                </svg>
                Kembali ke Hasil Rekomendasi
            </a>

            @php
                $lowongan = $lowongan ?? [];
                $perusahaan = $lowongan['perusahaan'] ?? [];
                $kualifikasi = $lowongan['kualifikasi'] ?? [];
                $detail = $lowongan['detail'] ?? [];

                $namaPerusahaan = $perusahaan['nama_perusahaan'] ?? '-';
                $jenisPerusahaan = $perusahaan['jenis_perusahaan'] ?? null;
                $profilPerusahaan = $perusahaan['profil_perusahaan'] ?? null;
                $lokasiPerusahaan = $perusahaan['lokasi'] ?? '-';
                $webCareer = $perusahaan['web_career'] ?? null;

                $posisi = $lowongan['posisi'] ?? '-';
                $deskripsi = $lowongan['deskripsi'] ?? '';

                $ipkMin = $kualifikasi['ipk_min'] ?? null;
                $tools = $kualifikasi['tools'] ?? null;
                $skill = $kualifikasi['skill'] ?? null;

                $periode = $detail['periode'] ?? null;
                $insentif = $detail['insentif'] ?? null;

                // Badge cocok
                $persen = $persen ?? 0;
                if ($persen >= 80) {
                    $badgeClass = 'hijau';
                } elseif ($persen >= 60) {
                    $badgeClass = 'kuning';
                } else {
                    $badgeClass = 'abu';
                }

                // Inisial logo
                $inisial = strtoupper(substr($namaPerusahaan, 0, 2));

                // Split deskripsi menjadi bullet jika ada newline/titik koma
                $deskripsiList = array_values(
                    array_filter(preg_split('/\n|;/', $deskripsi), fn($s) => trim($s) !== ''),
                );
            @endphp

            {{-- ── Hero Card ── --}}
            <div class="hero-card">
                @if ($persen > 0)
                    <div class="badge-match {{ $badgeClass }}">
                        🎯 {{ $persen }}% Cocok
                    </div>
                @endif

                <div class="hero-top">
                    <div class="hero-logo">{{ $inisial }}</div>

                    <div class="hero-info">
                        <span class="hero-tag">Magang Industri</span>
                        <h1 class="hero-posisi">{{ $posisi }}</h1>
                        <div class="hero-meta-row">
                            <span class="hero-perusahaan">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M3 21h18M5 21V7l8-4v18M19 21V11l-6-4" />
                                </svg>
                                {{ strtoupper($namaPerusahaan) }}
                            </span>
                            @if ($jenisPerusahaan)
                                <span class="hero-jenis">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                                    </svg>
                                    {{ $jenisPerusahaan }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Two-column body ── --}}
            <div class="detail-layout">

                {{-- Kolom kiri --}}
                <div class="left-col">

                    {{-- Profil Perusahaan — key: profil_perusahaan --}}
                    @if ($profilPerusahaan)
                        <div class="section-card">
                            <h2 class="section-title">
                                <span class="section-title-icon"></span>
                                Profil Perusahaan
                            </h2>
                            <div class="section-body">{{ $profilPerusahaan }}</div>
                        </div>
                    @endif

                    {{-- Deskripsi Pekerjaan --}}
                    <div class="section-card">
                        <h2 class="section-title">
                            <span class="section-title-icon"></span>
                            Deskripsi Pekerjaan
                        </h2>
                        <div class="section-body">
                            @if (count($deskripsiList) > 1)
                                <ul class="deskripsi-list">
                                    @foreach ($deskripsiList as $poin)
                                        <li>{{ trim($poin) }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <p style="margin:0">{{ $deskripsi ?: '-' }}</p>
                            @endif
                        </div>
                    </div>

                    {{-- Persyaratan — dari nested 'kualifikasi' --}}
                    <div class="section-card">
                        <h2 class="section-title">
                            <span class="section-title-icon"></span>
                            Persyaratan (Kualifikasi)
                        </h2>
                        <div class="kualifikasi-grid">

                            @if ($ipkMin)
                                <div class="kual-item">
                                    <div class="kual-label">IPK Minimal</div>
                                    {{-- ipk_min bukan ipk_minimal --}}
                                    <div class="kual-value">{{ $ipkMin }}</div>
                                </div>
                            @endif

                            @if ($skill)
                                <div class="kual-item">
                                    <div class="kual-label">Skill</div>
                                    {{-- skill bukan skills / technical_stack --}}
                                    <div class="kual-value">
                                        {{ is_array($skill) ? implode(', ', $skill) : $skill }}
                                    </div>
                                </div>
                            @endif

                            @if ($tools)
                                <div class="kual-item">
                                    <div class="kual-label">Tools</div>
                                    {{-- tools tetap sama --}}
                                    <div class="kual-value">
                                        {{ is_array($tools) ? implode(', ', $tools) : $tools }}
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>

                </div>

                {{-- Kolom kanan (sidebar) --}}
                <div class="right-col">
                    <div class="sidebar-card">
                        <div class="sidebar-title">Informasi Magang</div>

                        <ul class="info-list">

                            <li class="info-item">
                                <div class="info-icon">📍</div>
                                <div>
                                    <div class="info-text-label">Lokasi</div>
                                    {{-- lokasi dari perusahaan.lokasi bukan lowongan.lokasi_perusahaan --}}
                                    <div class="info-text-value">{{ $lokasiPerusahaan }}</div>
                                </div>
                            </li>

                            @if ($periode)
                                <li class="info-item">
                                    <div class="info-icon">🕐</div>
                                    <div>
                                        <div class="info-text-label">Periode Magang</div>
                                        {{-- periode dari detail.periode bukan lowongan.periode --}}
                                        <div class="info-text-value">{{ $periode }} Bulan</div>
                                    </div>
                                </li>
                            @endif

                            <li class="info-item">
                                <div class="info-icon">💰</div>
                                <div>
                                    <div class="info-text-label">Kompensasi</div>
                                    <div class="info-text-value {{ $insentif ? 'Paid' : 'Unpaid' }}">
                                        @if ($insentif === 'Paid')
                                            Berbayar 
                                        @else
                                            Tidak Berbayar
                                        @endif
                                    </div>
                                </div>
                            </li>

                        </ul>

                        <hr class="divider">

                        @if ($webCareer)
                            {{-- web_career dari perusahaan.web_career bukan lowongan.link_web --}}
                            <a href="{{ $webCareer }}" target="_blank" rel="noopener" class="btn-web-career">
                                🌐 Web Career
                            </a>
                            <p class="cta-note">Dengan menekan tombol diatas, Anda akan diarahkan ke portal eksternal
                                perusahaan.</p>
                        @endif
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
