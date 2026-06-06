@extends('layouts_guest.template')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/hasil.css') }}">
@endpush

@section('content')
    <div class="container">
        <a href="{{ route('rekomendasi.index') }}" class="btn-kembali">
            ← Kembali ke Form
        </a>

        <div class="hasil-heading">
            <h2>Hasil Rekomendasi</h2>
            @if (!empty($rekomendasi))
                <p>
                    Kami menemukan <strong>{{ count($rekomendasi) }} lowongan</strong>
                    yang selaras dengan profil akademik
                    <strong>{{ $mahasiswa['nama'] }}</strong>.
                </p>
            @endif
        </div>

        <div class="alert-session">
            ⚠ Halaman ini hanya dapat diakses sekali. Muat ulang halaman akan menghapus hasil.
        </div>

        @if (empty($rekomendasi))
            <div class="kosong-state">
                <div class="kosong-icon">🔍</div>
                <h5>Tidak Ada Lowongan yang Sesuai</h5>
                <p>Coba ubah preferensi lokasi, jenis instansi, atau minat bidang.</p>
                <a href="{{ route('rekomendasi.index') }}" class="btn-cari-ulang">Ubah Preferensi</a>
            </div>
        @else
            <p class="jumlah-label">Menampilkan {{ count($rekomendasi) }} Lowongan</p>

            
            <div class="kartu-grid">
                @foreach ($rekomendasi as $index => $item)
                    @php
                        $skor = (float) ($item['skor_edas'] ?? 0);
                        $persen = min(100, round($skor * 100));
                        $insentif = is_numeric($item['insentif'] ?? null) ? (float) $item['insentif'] : 0;
                        $paid = $insentif > 0;
                        $periode = $item['periode'] ?? null;
                        $lokasi = $item['lokasi_perusahaan'] ?? '-';

                        if ($persen >= 80) {
                            $badgeClass = 'badge-hijau';
                        } elseif ($persen >= 60) {
                            $badgeClass = 'badge-kuning';
                        } else {
                            $badgeClass = 'badge-abu';
                        }
                    @endphp

                    <div class="kartu {{ $index === 0 ? 'kartu-top' : '' }}">

                        {{-- Badge persentase cocok --}}
                        <div class="badge-cocok {{ $badgeClass }}">
                            🎯 {{ $persen }}% Cocok
                        </div>

                        {{-- Inisial perusahaan --}}
                        <div class="kartu-logo">
                            <span>{{ strtoupper(substr($item['nama_perusahaan'] ?? '?', 0, 2)) }}</span>
                        </div>

                        <p class="kartu-perusahaan">{{ strtoupper($item['nama_perusahaan'] ?? '-') }}</p>

                        <h5 class="kartu-posisi">{{ $item['posisi'] ?? '-' }}</h5>

                        @if (!empty($item['deskripsi']))
                            <p class="kartu-deskripsi">{{ Str::limit($item['deskripsi'], 90) }}</p>
                        @endif

                        {{-- Meta: lokasi · periode · paid --}}
                        <div class="kartu-meta">
                            <span class="meta-item">
                                <span class="meta-icon">📍</span> {{ $lokasi }}
                            </span>
                            @if ($periode)
                                <span class="meta-item">
                                    <span class="meta-icon">🕐</span> {{ $periode }} Bulan
                                </span>
                            @endif
                            <span class="meta-item">
                                <span class="meta-icon">💰</span> {{ $paid ? 'Paid' : 'Unpaid' }}
                            </span>
                        </div>

                        <a href="{{ route('lowongan.show', $item['lowongan_id'] ?? 0) }}" class="btn-detail">
                            Lihat Detail →
                        </a>

                    </div>
                @endforeach
            </div>
        @endif

    </div>
@endsection
