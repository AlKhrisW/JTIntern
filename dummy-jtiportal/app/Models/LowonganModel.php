<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LowonganModel extends Model
{
    use HasFactory;

    protected $table      = 'lowongan_models';
    protected $primaryKey = 'lowongan_id';
    public    $incrementing = false;
    protected $keyType    = 'string';

    protected $fillable = [
        'lowongan_id',
        'perusahaan_id',
        'posisi',
        'deskripsi',
        'tools',
        'skill',
        'ipk_min',
        'periode',
        'insentif',
        'status'        
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
            $last = self::where('lowongan_id', 'like', 'LW%')
                ->orderBy('lowongan_id', 'desc')
                ->first();
            if (!$last) {
                $newId = 'LW001';
            } else {
                $lastNumber = (int) substr($last->lowongan_id, 2);
                $newId = 'LW' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            }
            $model->lowongan_id = $newId;
        });
    }
}
