<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;  

class PerusahaanModel extends Model
{
    use HasFactory;

    protected $table      = 'perusahaan';
    protected $primaryKey = 'perusahaan_id';
    public    $incrementing = false;
    protected $keyType    = 'string';

    protected $fillable = [
        'perusahaan_id',
        'nama_perusahaan',
        'jenis_perusahaan',
        'profil_perusahaan',
        'lokasi',
        'web_career',
        'logo',
        'status',
    ];

    /**
     * Relasi ke LowonganModel
     */
    public function lowongan()
    {
        return $this->hasMany(LowonganModel::class, 'perusahaan_id', 'perusahaan_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->perusahaan_id)) {
                $model->perusahaan_id = (string) Str::uuid();
            }
        });
    }
}