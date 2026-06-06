<?php

use Livewire\Component;
use Illuminate\Support\Facades\Http;

new class extends Component {
    public $step = 1;

    // Step 1
    public $nim = '';
    public $mahasiswa = null;
    public $errorMessage = '';

    // Step 3 - Preferences
    public $jenis_magang = '';
    public $minat_bidang = [];
    public $jenis_instansi = '';
    public $lokasi = [];

    public $isLoading = false;

    public $daftarJenisMagang = [
        'paid' => 'Berbayar (Paid)',
        'unpaid' => 'Tidak Berbayar (Unpaid)',
        'semua' => 'Semua Jenis Magang',
    ];

    public $daftarJenisInstansi = [
        'swasta nasional' => 'Swasta Nasional',
        'swasta' => 'Swasta Asing',
        'BUMN' => 'BUMN',
        'instansi pendidikan' => 'Instansi Pendidikan',
        'semua' => 'Semua Jenis Instansi',
    ];

    public $daftarMinatBidang = ['Web Development', 'Mobile Development', 'Data Science', 'UI/UX Design', 'Machine Learning', 'Cyber Security', 'DevOps', 'Business Intelligence', 'Digital Marketing', 'Network Engineering'];

    public $daftarProvinsi = ['Jawa Timur', 'Jawa Barat', 'DKI Jakarta', 'Jawa Tengah', 'DI Yogyakarta', 'Bali', 'Sumatera Utara', 'Sumatera Selatan', 'Sulawesi Selatan', 'Kalimantan Selatan', 'Riau', 'Lampung'];

    protected $rules = [
        'nim' => 'required|digits_between:6,10',
        'jenis_magang' => 'required|string',
        'minat_bidang' => 'required|array|min:1',
        'jenis_instansi' => 'required|string',
        'lokasi' => 'required|array|min:1',
    ];

    public function cariMahasiswa()
    {
        $this->validateOnly('nim');
        $this->isLoading = true;
        $this->errorMessage = '';

        try {
            $response = Http::timeout(15)->get('http://127.0.0.1:8001/api/mahasiswa/' . $this->nim);
            if ($response->successful() && ($data = $response->json())) {
                $this->mahasiswa = $data['data'] ?? $data;
                $this->step = 2;
            } else {
                $this->errorMessage = 'Data mahasiswa tidak ditemukan.';
            }
        } catch (\Exception $e) {
            $this->errorMessage = 'Gagal terhubung ke server Siakad.';
        }

        $this->isLoading = false;
    }

    public function konfirmasi()
    {
        $this->step = 3;
    }

    public function kembaliKePencarian()
    {
        $this->reset(['nim', 'mahasiswa', 'errorMessage', 'jenis_magang', 'minat_bidang', 'jenis_instansi', 'lokasi']);
        $this->step = 1;
    }

    public function submitPreferensi()
    {
        $this->validate();
        $this->isLoading = true;

        try {
            $payload = [
                'mahasiswa' => $this->mahasiswa,
                'preferensi' => [
                    'jenis_magang' => $this->jenis_magang,
                    'minat_bidang' => $this->minat_bidang,
                    'jenis_instansi' => $this->jenis_instansi,
                    'lokasi' => $this->lokasi,
                ],
                'timestamp' => now()->toIso8601String(),
            ];

            $response = Http::timeout(60)->post('http://127.0.0.1:5000/api/hitung-rekomendasi', $payload);

            if ($response->successful()) {
                $result = $response->json();

                // Simpan ke session flash (sekali pakai — terhapus setelah redirect pertama)
                session()->flash('hasil_rekomendasi', [
                    'mahasiswa' => $result['mahasiswa'],
                    'rekomendasi' => $result['rekomendasi'],
                    'generated_at' => now()->toDateTimeString(),
                ]);

                return redirect()->route('rekomendasi.hasil');
            }

            $errorBody = $response->json('detail') ?? 'Gagal memproses rekomendasi dari server Python.';
            session()->flash('error', $errorBody);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            session()->flash('error', 'Tidak dapat terhubung ke engine rekomendasi. Pastikan server Python aktif.');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        $this->isLoading = false;
    }

    public function render()
    {
        return view('components.rekomendasi-magang');
    }
};
?>

<div class="form">

    @if ($step == 1)
        <h5>Cari Mahasiswa</h5>

        <div class="form-area">
            <input type="text" class="form-input" wire:model.live="nim" required>
            <label class="form-label">NIM</label>
        </div>

        @if ($errorMessage)
            <small class="text-danger">{{ $errorMessage }}</small>
        @endif

        <button class="btn-cari" wire:click="cariMahasiswa" wire:loading.attr="disabled">
            <span wire:loading.remove wire:target="cariMahasiswa">Cari</span>
            <span wire:loading wire:target="cariMahasiswa">Mencari data...</span>
        </button>
    @endif

    @if ($step == 2 && $mahasiswa)
        <h5>Konfirmasi Data Mahasiswa</h5>
        <div class="data-konfirmasi">
            <p><strong>Nama:</strong> {{ $mahasiswa['nama'] ?? '-' }}</p>
            <p><strong>NIM:</strong> {{ $mahasiswa['nim'] ?? '-' }}</p>
            <p><strong>Prodi:</strong> {{ $mahasiswa['program_studi'] ?? '-' }}</p>
        </div>

        <button class="btn-konfirmasi" wire:click="konfirmasi">Konfirmasi</button>
        <button class="btn-kembali" wire:click="kembaliKePencarian">Bukan Milik Saya</button>
    @endif

    @if ($step == 3)
        <h5>Lengkapi Preferensi Magang</h5>

        <form wire:submit.prevent="submitPreferensi">
            <div class="form-group">
                <label>Minat Bidang <span class="text-danger">*</span></label>

                <div class="multiselect-wrapper" x-data="{ open: false, search: '' }" @click.outside="open = false">

                    <div class="multiselect-box" :class="{ active: open }"
                        @click="open = true; $nextTick(() => $refs.searchMinat.focus())">

                        <input type="text" class="multiselect-input" placeholder="Cari bidang..." x-ref="searchMinat"
                            x-model="search" @click.stop="open = true" autocomplete="off">
                    </div>

                    <div class="pills-area mt-2">
                        @foreach ($minat_bidang as $item)
                            <span class="pill">
                                {{ $item }}
                                <button type="button" class="pill-remove"
                                    @click.stop="$wire.set('minat_bidang',
                                            $wire.minat_bidang.filter(v => v !== '{{ $item }}'))">
                                    ×
                                </button>
                            </span>
                        @endforeach
                    </div>

                    <div class="multiselect-dropdown" :class="{ open: open }">
                        <ul class="dropdown-list">
                            @foreach ($daftarMinatBidang as $item)
                                <li class="dropdown-item-custom {{ in_array($item, $minat_bidang) ? 'selected' : '' }}"
                                    x-show="'{{ strtolower($item) }}'.includes(search.toLowerCase())"
                                    @click.stop="
                                        @if (in_array($item, $minat_bidang)) $wire.set('minat_bidang', $wire.minat_bidang.filter(v => v !== '{{ $item }}'))
                                        @else
                                            $wire.set('minat_bidang', [...$wire.minat_bidang, '{{ $item }}']) @endif
                                    ">
                                    <span class="item-checkbox">{{ in_array($item, $minat_bidang) ? '✓' : '' }}</span>
                                    <span>{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <div class="dropdown-empty"
                            x-show="!@js($daftarMinatBidang).some(v => v.toLowerCase().includes(search.toLowerCase()))">
                            Tidak ada hasil.
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Lokasi (Provinsi) <span class="text-danger">*</span></label>

                <div class="multiselect-wrapper" x-data="{ open: false, search: '' }" @click.outside="open = false">

                    <div class="multiselect-box" :class="{ active: open }"
                        @click="open = true; $nextTick(() => $refs.searchLokasi.focus())">

                        <input type="text" class="multiselect-input" placeholder="Cari provinsi..."
                            x-ref="searchLokasi" x-model="search" @click.stop="open = true" autocomplete="off">
                    </div>

                    <div class="pills-area mt-2">
                        @foreach ($lokasi as $prov)
                            <span class="pill">
                                {{ $prov }}
                                <button type="button" class="pill-remove"
                                    @click.stop="$wire.set('lokasi',
                                            $wire.lokasi.filter(v => v !== '{{ $prov }}'))">
                                    ×
                                </button>
                            </span>
                        @endforeach
                    </div>

                    <div class="multiselect-dropdown" :class="{ open: open }">
                        <ul class="dropdown-list">
                            @foreach ($daftarProvinsi as $prov)
                                <li class="dropdown-item-custom {{ in_array($prov, $lokasi) ? 'selected' : '' }}"
                                    x-show="'{{ strtolower($prov) }}'.includes(search.toLowerCase())"
                                    @click.stop="
                                        @if (in_array($prov, $lokasi)) $wire.set('lokasi', $wire.lokasi.filter(v => v !== '{{ $prov }}'))
                                        @else
                                            $wire.set('lokasi', [...$wire.lokasi, '{{ $prov }}']) @endif
                                    ">
                                    <span class="item-checkbox">{{ in_array($prov, $lokasi) ? '✓' : '' }}</span>
                                    <span>{{ $prov }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <div class="dropdown-empty"
                            x-show="!@js($daftarProvinsi).some(v => v.toLowerCase().includes(search.toLowerCase()))">
                            Tidak ada hasil.
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Jenis Magang <span class="text-danger">*</span></label>

                <div class="multiselect-wrapper" x-data="{ open: false, search: '' }" @click.outside="open = false">

                    <div class="multiselect-box single-select-box" :class="{ active: open }" @click="open = !open">
                        <span class="single-select-label">
                            {{ $jenis_magang ? $daftarJenisMagang[$jenis_magang] : 'Pilih Jenis Magang' }}
                        </span>
                    </div>

                    <div class="multiselect-dropdown" :class="{ open: open }">
                        <ul class="dropdown-list">
                            @foreach ($daftarJenisMagang as $value => $label)
                                <li class="dropdown-item-custom {{ $jenis_magang === $value ? 'selected' : '' }}"
                                    @click.stop="$wire.set('jenis_magang', '{{ $value }}'); open = false; search = ''">
                                    <span class="item-checkbox">{{ $jenis_magang === $value ? '✓' : '' }}</span>
                                    <span>{{ $label }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Jenis Instansi <span class="text-danger">*</span></label>

                <div class="multiselect-wrapper" x-data="{ open: false, search: '' }" @click.outside="open = false">

                    <div class="multiselect-box single-select-box" :class="{ active: open }" @click="open = !open">
                        <span class="single-select-label">
                            {{ $jenis_instansi ? $daftarJenisInstansi[$jenis_instansi] : 'Pilih Jenis Instansi' }}
                        </span>
                    </div>

                    <div class="multiselect-dropdown" :class="{ open: open }">
                        <ul class="dropdown-list">
                            @foreach ($daftarJenisInstansi as $value => $label)
                                <li class="dropdown-item-custom {{ $jenis_instansi === $value ? 'selected' : '' }}"
                                    @click.stop="$wire.set('jenis_instansi', '{{ $value }}'); open = false">
                                    <span class="item-checkbox">{{ $jenis_instansi === $value ? '✓' : '' }}</span>
                                    <span>{{ $label }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-submit" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="submitPreferensi">Cari Rekomendasi</span>
                <span wire:loading wire:target="submitPreferensi">Memproses...</span>
            </button>

        </form>
    @endif

</div>
