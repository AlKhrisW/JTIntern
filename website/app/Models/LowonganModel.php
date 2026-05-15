<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class LowonganModel extends Model
{
    use HasFactory;

    protected $table      = 'lowongan';
    protected $primaryKey = 'lowongan_id';
    public    $incrementing = false;
    protected $keyType    = 'string';

    protected $fillable = [
        'lowongan_id',
        'perusahaan_id',
        'judul_lowongan',
        'deskripsi_lowongan',
        'posisi',
        'tipe_pekerjaan',
        'lokasi',
        'salary',
        'deadline',
        'status',
    ];

    /**
     * Relasi ke perusahaan
     */
    public function perusahaan()
    {
        return $this->belongsTo(PerusahaanModel::class, 'perusahaan_id', 'perusahaan_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->lowongan_id)) {
                $model->lowongan_id = (string) Str::uuid();
            }
        });
    }
}
