<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        // tambahkan kolom lainnya nanti
    ];

    /**
     * Relasi ke PerusahaanModel
     */
    public function perusahaan()
    {
        return $this->belongsTo(PerusahaanModel::class, 'perusahaan_id', 'perusahaan_id');
    }
}