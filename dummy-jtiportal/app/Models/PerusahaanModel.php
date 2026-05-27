<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerusahaanModel extends Model
{
    use HasFactory;

    protected $table      = 'perusahaan_models';
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
            $last = self::where('perusahaan_id', 'like', 'P%')
                ->orderBy('perusahaan_id', 'desc')
                ->first();
            if (!$last) {
                $newId = 'P001';
            } else {
                $lastNumber = (int) substr($last->perusahaan_id, 2);
                $newId = 'P' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            }
            $model->perusahaan_id = $newId;
        });
    }
}
