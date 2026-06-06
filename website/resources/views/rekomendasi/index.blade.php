@extends('layouts_guest.template')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/rekomendasi.css') }}">
@endpush

@section('content')
    <div class="container shadow">
        <div class="form-box">
            @livewire('rekomendasi-magang')
        </div>
        <div class="petunjuk">
            <div class="panel">
                <h5>Petunjuk Penggunaan!</h5>
                <p>1. Masukkan NIM Anda untuk mencari data.</p>
                <p>2. Periksa kembali apakah data yang muncul sudah sesuai.</p>
                <p>3. Klik "Konfirmasi" jika benar, atau "Bukan Milik Saya" jika salah untuk mengulangi proses.</p>
                <p>4. Lengkapi data preferensi magang Anda.</p>
                <p>5. Klik "Kirim" untuk memproses hasil rekomendasi.</p>
                <p>6. Tunggu sebentar, Anda akan diarahkan otomatis ke halaman hasil rekomendasi.</p>
                <h6 class="text-center">Selamat mencoba!</h6>
            </div>
        </div>
    </div>
@endsection