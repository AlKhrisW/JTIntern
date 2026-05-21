@extends('layouts_guest.template')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/rekomendasi.css') }}">
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 my-4">
                <h1>Lengkapi Profil Mahasiswa</h1>
                <p>Lengkapi data akademik dan preferensimu untuk mendapatkan rekomendasi tempat magang yang paling sesuai
                    dengan profilmu.</p>
            </div>
            <div class="col-md-12">
                <div class="card shadow p-4">
                    <div class="card-body">
                        <form action="{{ route('rekomendasi.store') }}" method="post">
                            @csrf

                            <div class="row my-4">
                                <div class="col-md">
                                    <div class="card-title d-flex flex-row align-items-center mb-0">
                                        <i class="bi bi-person-vcard"></i>
                                        <h4 class="mb-0">Biodata Mahasiswa</h4>
                                    </div>
                                    <p>teks</p>
                                </div>
                                <div class="col-md">
                                    <div class="row mb-5">
                                        <div class="form-area">
                                            <input type="text" class="form-input" name="nama" required>
                                            <label class="form-label">Nama Lengkap</label>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="form-area">
                                            <input type="email" class="form-input" name="email" required>
                                            <label class="form-label">Email address</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row my-4">
                                <div class="col-md">
                                    <div class="card-title d-flex flex-row align-items-center mb-0">
                                        <i class="bi bi-person-vcard"></i>
                                        <h4 class="mb-0">Biodata Mahasiswa</h4>
                                    </div>
                                    <p>teks</p>
                                </div>
                                <div class="col-md">
                                    <div class="row mb-5">
                                        <div class="form-area">
                                            <input type="text" class="form-input" name="ipk" required>
                                            <label class="form-label">Indeks Prestasi Kumulatif (IPK)</label>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="form-area">
                                            <select name="jenis_perusahaan" id="jenis_perusahaan" class="form-input"
                                                required>
                                                <option value="Nasional">BUMN & Pemerintahan</option>
                                                <option value="Multinasional/Internasional">Tech Startup / Unicorn</option>
                                                <option value="Wirausaha">Agensi Kreatif</option>
                                            </select>
                                            <label class="form-label">Jenis Perusahaan</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row my-4">
                                <div class="col-md">
                                    <div class="card-title d-flex flex-row align-items-center mb-0">
                                        <i class="bi bi-mortarboard"></i>
                                        <h4 class="mb-0">Keahlian Mahasiswa</h4>
                                    </div>
                                    <p>teks</p>
                                </div>
                                <div class="col-md">
                                    <div class="multiselect-wrapper ">
                                        <div class="multiselect-box mb-2">
                                            <input type="text" class="multiselect-input" placeholder="Cari skill...">
                                        </div>

                                        <div class="pills-area mb-2"></div>

                                        <div class="multiselect-dropdown">
                                            <ul class="dropdown-list">
                                                @foreach ($skills as $namaskill)
                                                    <li class="dropdown-item-custom" data-value="{{ $namaskill }}">
                                                        <span class="item-checkbox"></span>
                                                        <span>
                                                            {{ $namaskill }}
                                                        </span>
                                                    </li>
                                                @endforeach
                                            </ul>

                                            <div class="dropdown-empty" style="display:none;">
                                                Skill tidak ditemukan
                                            </div>
                                        </div>

                                        <input type="hidden" name="skills" class="multiselect-value">
                                    </div>
                                    @error('skills')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row my-4">
                                <div class="col-md">
                                    <div class="card-title d-flex flex-row align-items-center mb-0">
                                        <i class="bi bi-mortarboard"></i>
                                        <h4 class="mb-0">Tools</h4>
                                    </div>
                                    <p>teks</p>
                                </div>
                                <div class="col-md">
                                    <div class="multiselect-wrapper ">
                                        <div class="multiselect-box mb-2">
                                            <input type="text" class="multiselect-input" placeholder="Cari tool...">
                                        </div>

                                        <div class="pills-area mb-2"></div>

                                        <div class="multiselect-dropdown">
                                            <ul class="dropdown-list">
                                                @foreach ($tools as $namatool)
                                                    <li class="dropdown-item-custom" data-value="{{ $namatool }}">
                                                        <span class="item-checkbox"></span>
                                                        <span>
                                                            {{ $namatool }}
                                                        </span>
                                                    </li>
                                                @endforeach
                                            </ul>

                                            <div class="dropdown-empty" style="display:none;">
                                                Tool tidak ditemukan
                                            </div>
                                        </div>

                                        <input type="hidden" name="tools" class="multiselect-value">
                                    </div>
                                    @error('tools')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row my-4">
                                <div class="col-md">
                                    <div class="card-title d-flex flex-row align-items-center mb-0">
                                        <i class="bi bi-mortarboard"></i>
                                        <h4 class="mb-0">Minat Bidang</h4>
                                    </div>
                                    <p>teks</p>
                                </div>
                                <div class="col-md">
                                    <div class="multiselect-wrapper ">
                                        <div class="multiselect-box mb-2">
                                            <input type="text" class="multiselect-input"
                                                placeholder="Cari minat bidang...">
                                        </div>

                                        <div class="pills-area mb-2"></div>

                                        <div class="multiselect-dropdown">
                                            <ul class="dropdown-list">
                                                @foreach ($minat as $namaminat)
                                                    <li class="dropdown-item-custom" data-value="{{ $namaminat }}">
                                                        <span class="item-checkbox"></span>
                                                        <span>
                                                            {{ $namaminat }}
                                                        </span>
                                                    </li>
                                                @endforeach
                                            </ul>

                                            <div class="dropdown-empty" style="display:none;">
                                                Minat bidang tidak ditemukan
                                            </div>
                                        </div>

                                        <input type="hidden" name="minat_bidang" class="multiselect-value">
                                    </div>
                                    @error('minat_bidang')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="button-submit">Proses Rekomendasi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        const SAVED_SKILLS = @json($savedSkills ?? []);
    </script>
    <script src="{{ asset('js/rekomendasi.js') }}"></script>
@endpush
