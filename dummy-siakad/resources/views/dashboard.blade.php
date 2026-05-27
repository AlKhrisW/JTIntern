@extends('layouts.template')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin_dashboard.css') }}">
@endpush

@section('content')
    <div class="dashboard-page">

        <section class="dashboard-grid">
            <article class="chart-panel">
                <div class="section-heading">
                    <div>
                        <h3>Grafik Pendaftar Magang</h3>
                        <p>Statistik pendaftaran 7 hari terakhir</p>
                    </div>
                    <div class="segmented">
                        <button type="button">Mingguan</button>
                        <button type="button" class="active">Bulanan</button>
                    </div>
                </div>

                <div class="chart-shell">
                    <div class="chart-line"></div>
                    <div class="chart-labels">
                        <span>Sen</span>
                        <span>Sel</span>
                        <span>Rab</span>
                        <span>Kam</span>
                        <span>Jum</span>
                        <span>Sab</span>
                        <span>Min</span>
                    </div>
                </div>
            </article>

            <article class="activity-panel">
                <h3>Aktivitas Terbaru</h3>
                <ul>
                    <li>
                        <span class="activity-dot activity-dot--blue"></span>
                        <strong>AI</strong>
                        <p>Artikel menyetujui lowongan baru dari PT Teknologi Maju.</p>
                        <small>2 menit yang lalu</small>
                    </li>
                    <li>
                        <span class="activity-dot activity-dot--orange"></span>
                        <strong>Update Profil Perusahaan</strong>
                        <p>CV Sukses Mandiri mengubah data kontak HR.</p>
                        <small>15 menit yang lalu</small>
                    </li>
                    <li>
                        <span class="activity-dot activity-dot--green"></span>
                        <strong>Rekomendasi Berhasil</strong>
                        <p>Sistem memproses 45 mahasiswa untuk lowongan UI/UX.</p>
                        <small>1 jam yang lalu</small>
                    </li>
                    <li>
                        <span class="activity-dot activity-dot--gray"></span>
                        <strong>Login Sistem</strong>
                        <p>Super Admin login melalui IP 192.168.1.1.</p>
                        <small>4 jam yang lalu</small>
                    </li>
                </ul>
                <button type="button">Lihat Semua Log</button>
            </article>
        </section>

        <section class="table-panel">
            <div class="table-panel__header">
                <h3>Status Pendaftaran Terakhir</h3>
                <div>
                    <select aria-label="Filter status">
                        <option>Semua Status</option>
                        <option>Terverifikasi</option>
                        <option>Proses</option>
                    </select>
                    <button type="button" aria-label="Filter">
                        <i class="bi bi-funnel"></i>
                    </button>
                </div>
            </div>

        </section>
    </div>
@endsection
