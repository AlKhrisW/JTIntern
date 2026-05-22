<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class AdminModel extends Authenticatable
{
    use Notifiable;

    protected $table      = 'admin';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_lengkap',
        'username',
        'email',
        'password',
        'photo_profile',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    protected $appends = ['photo_url'];

    /**
     * Accessor: URL foto profil
     * Menggunakan Storage::url agar konsisten dengan symlink storage:link
     */
    public function getPhotoUrlAttribute(): string
    {
        if ($this->photo_profile) {
            if (Storage::disk('public')->exists($this->photo_profile)) {
                return Storage::url($this->photo_profile);
            }
            // Fallback jika storage:link belum dijalankan
            return asset('storage/' . $this->photo_profile);
        }

        return asset('assets/img/default-admin.png');
    }
}