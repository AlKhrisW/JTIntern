<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\AdminModel;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Ambil admin yang sedang login.
     * Fallback ke record pertama hanya untuk masa development.
     */
    private function getAdmin(): AdminModel
    {
        /** @var AdminModel|null $admin */
        $admin = Auth::guard('admin')->user();

        if (!$admin) {
            // TEMPORARY – hapus fallback ini setelah auth aktif
            $admin = AdminModel::first();
        }

        return $admin;
    }

    /**
     * Halaman Profil
     */
    public function index()
    {
        $admin = $this->getAdmin();

        if (!$admin) {
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        return view('admin_profil.index', [
            'admin'      => $admin,
            'activeMenu' => 'profil',
            'breadcrumb' => 'Profil Admin',
        ]);
    }

    /**
     * Update Informasi Profil (Nama, Email, Username)
     */
    public function profil_update(Request $request)
    {
        $admin = $this->getAdmin();

        if (!$admin) {
            return redirect()->route('login')
                ->with('error', 'Sesi telah berakhir, silakan login kembali.');
        }

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email'        => 'required|email|max:255|unique:admin,email,' . $admin->id,
            'username'     => 'required|string|max:100|unique:admin,username,' . $admin->id,
        ]);

        $admin->update([
            'nama_lengkap' => $request->nama_lengkap,
            'email'        => $request->email,
            'username'     => $request->username,
        ]);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Ubah Password
     */
    public function profil_changePassword(Request $request)
    {
        $admin = $this->getAdmin();

        if (!$admin) {
            return redirect()->route('login')
                ->with('error', 'Sesi telah berakhir, silakan login kembali.');
        }

        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ], [
            'password.min'      => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $admin->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Password berhasil diubah!');
    }

    /**
     * Upload / Ganti Foto Profil
     *
     * Disimpan ke  : storage/app/public/profil/filename.ext
     * DB simpan    : profil/filename.ext
     * Akses via    : /storage/profil/filename.ext
     *
     * Jalankan sekali: php artisan storage:link
     */
    public function profil_updatePicture(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'photo.image'    => 'File harus berupa gambar.',
            'photo.mimes'    => 'Format gambar harus JPG, PNG, atau WEBP.',
            'photo.max'      => 'Ukuran gambar maksimal 2MB.',
        ]);

        $admin = $this->getAdmin();

        if (!$admin) {
            return redirect()->route('login')
                ->with('error', 'Sesi telah berakhir, silakan login kembali.');
        }

        if (!$request->hasFile('photo')) {
            return back()->with('error', 'Tidak ada file yang diupload.');
        }

        // Hapus foto lama jika ada
        if ($admin->photo_profile) {
            $oldPath = storage_path('app/public/' . $admin->photo_profile);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        // Simpan foto baru dengan nama unik
        $file     = $request->file('photo');
        $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());

        $file->storeAs('profil', $filename, 'public');

        $admin->photo_profile = 'profil/' . $filename;
        $admin->save();

        return back()->with('success', 'Foto profil berhasil diperbarui!');
    }
}