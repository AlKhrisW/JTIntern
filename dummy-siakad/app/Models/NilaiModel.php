<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiModel extends Model
{
    use HasFactory;

    protected $table      = 'nilai_models';  // nama tabel di database
    protected $primaryKey = 'id_nilai';      // PK string, bukan 'id'
    public    $incrementing = false;         // PK bukan auto-increment integer
    protected $keyType    = 'string';        // PK bertipe string (NL0001 dst)
    public    $timestamps = true;            // tabel punya created_at & updated_at

    protected $fillable = [
        'id_nilai',
        'id_mahasiswa',
        'id_matkul',
        'nilai_angka',
        'nilai_huruf',
    ];

    /* ── Relasi ─────────────────────────────────── */
    public function mahasiswa()
    {
        return $this->belongsTo(MahasiswaModel::class, 'id_mahasiswa', 'nim');
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliahModel::class, 'id_matkul', 'id_matkul');
    }
}