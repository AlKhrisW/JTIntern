<?php

use Livewire\Component;
use App\Models\Mahasiswa;

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

    // Data Opsi
    public $daftarMinatBidang = ['Web Development', 'Mobile Development', 'Data Science', 'UI/UX Design', 'Machine Learning', 'Cyber Security', 'DevOps', 'Business Intelligence', 'Digital Marketing', 'Network Engineering'];

    public $daftarProvinsi = ['Jawa Timur', 'Jawa Barat', 'DKI Jakarta', 'Jawa Tengah', 'DI Yogyakarta', 'Bali', 'Sumatera Utara', 'Sumatera Selatan', 'Sulawesi Selatan', 'Kalimantan Selatan', 'Riau', 'Lampung'];

    protected $rules = [
        'nim' => 'required|digits_between:8,15',
        'jenis_magang' => 'required|in:paid,unpaid',
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
            $response = Http::timeout(15)->get('https://siakad.kampus.ac.id/api/mahasiswa', [
                'nim' => $this->nim
            ]);

            if ($response->successful() && $data = $response->json()) {
                $this->mahasiswa = $data['data'] ?? $data;
                $this->step = 2;
            } else {
                $this->errorMessage = 'Data mahasiswa tidak ditemukan.';
            }
        } catch (\Exception $e) {
            $this->errorMessage = 'Gagal terhubung ke server Siakad.';
        }

        $this->isLoading = false;

        $this->step = 2;
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

            $response = Http::timeout(60)->post('https://fastapi-anda.com/rekomendasi', $payload);

            if ($response->successful()) {
                $result = $response->json();
                return redirect()
                    ->route('rekomendasi.hasil', [
                        'id' => $result['rekomendasi_id'] ?? null,
                    ])
                    ->with('success', 'Rekomendasi berhasil dibuat!');
            } else {
                session()->flash('error', 'Gagal memproses rekomendasi dari server.');
            }
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
            <input type="text" class="form-input" wire:model.live="nim">
            <label class="form-label">NIM</label>
        </div>

        @if ($errorMessage)
            <small class="text-danger">{{ $errorMessage }}</small>
        @endif

        <button class="btn-cari" wire:click="cariMahasiswa" wire:loading.attr="disabled">
            @if ($isLoading)
                Mencari data...
            @else
                Cari
            @endif
        </button>
    @endif

    @if ($step == 2 && $mahasiswa)
        <h5>Konfirmasi Data Mahasiswa</h5>
        <div class="data-konfirmasi">
            <p><strong>Nama:</strong> {{ $mahasiswa['nama'] ?? '-' }}</p>
            <p><strong>NIM:</strong> {{ $mahasiswa['nim'] ?? '-' }}</p>
            <p><strong>Prodi:</strong> {{ $mahasiswa['prodi'] ?? $mahasiswa['jurusan'] ?? '-' }}</p>
            <p><strong>Fakultas:</strong> {{ $mahasiswa['fakultas'] ?? '-' }}</p>
            <p><strong>IPK:</strong> {{ $mahasiswa['ipk'] ?? '-' }}</p>
        </div>

        <button class="btn-konfirmasi" wire:click="konfirmasi">Konfirmasi</button>
        <button class="btn-kembali" wire:click="kembaliKePencarian">Bukan Milik Saya</button>
    @endif

    @if ($step == 3)
        <h5>Lengkapi Preferensi Magang</h5>

        <form wire:submit="submitPreferensi">

            <!-- Jenis Magang -->
            <div class="form-group">
                <label>Jenis Magang <span class="text-danger">*</span></label>
                <select wire:model="jenis_magang" class="form-control" required>
                    <option value="">Pilih Jenis Magang</option>
                    <option value="paid">Berbayar (Paid)</option>
                    <option value="unpaid">Tidak Berbayar (Unpaid)</option>
                </select>
            </div>

            <!-- Minat Bidang -->
            <div class="form-group">
                <label>Minat Bidang <span class="text-danger">*</span></label>
                <div class="multiselect-wrapper" wire:ignore>
                    <div class="multiselect-box">
                        <div class="pills-area"></div>
                        <input type="text" class="multiselect-input" placeholder="Cari bidang...">
                    </div>
                    <div class="multiselect-dropdown">
                        @foreach ($daftarMinatBidang as $item)
                            <div class="dropdown-item-custom" data-value="{{ $item }}">
                                <span class="item-checkbox"></span> {{ $item }}
                            </div>
                        @endforeach
                    </div>
                    <input type="hidden" class="multiselect-value" wire:model="minat_bidang">
                </div>
            </div>

            <!-- Jenis Instansi -->
            <div class="form-group">
                <label>Jenis Instansi <span class="text-danger">*</span></label>
                <select wire:model="jenis_instansi" class="form-control" required>
                    <option value="">Pilih Jenis Instansi</option>
                    <option value="startup">Startup</option>
                    <option value="korporat">Korporat</option>
                    <option value="bumn">BUMN</option>
                    <option value="pemerintahan">Pemerintahan</option>
                    <option value="pendidikan">Pendidikan</option>
                </select>
            </div>

            <!-- Lokasi -->
            <div class="form-group">
                <label>Lokasi (Provinsi) <span class="text-danger">*</span></label>
                <div class="multiselect-wrapper" wire:ignore>
                    <div class="multiselect-box">
                        <div class="pills-area"></div>
                        <input type="text" class="multiselect-input" placeholder="Cari provinsi...">
                    </div>
                    <div class="multiselect-dropdown">
                        @foreach ($daftarProvinsi as $prov)
                            <div class="dropdown-item-custom" data-value="{{ $prov }}">
                                <span class="item-checkbox"></span> {{ $prov }}
                            </div>
                        @endforeach
                    </div>
                    <input type="hidden" class="multiselect-value" wire:model="lokasi">
                </div>
            </div>

            <button type="submit" class="btn-submit" wire:loading.attr="disabled">
                @if ($isLoading)
                    Memproses Rekomendasi...
                @else
                    Cari Rekomendasi
                @endif
            </button>
        </form>
    @endif
</div>
