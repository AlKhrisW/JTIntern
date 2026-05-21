<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilMahasiswaModel extends Model
{
    use HasFactory;

    protected $table = 'profil_mahasiswa';
    protected $primaryKey = 'mahasiswa_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nama',
        'email',
        'ipk',
        'jenis_perusahaan',
        'skill',
        'tools',
        'minat_bidang',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $last = self::where('mahasiswa_id', 'like', 'M%')
                ->orderBy('mahasiswa_id', 'desc')
                ->first();
            if (!$last) {
                $newId = 'M001';
            } else {
                $lastNumber = (int) substr($last->mahasiswa_id, 1);
                $newId = 'M' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            }
            $model->mahasiswa_id = $newId;
        });
    }
}
