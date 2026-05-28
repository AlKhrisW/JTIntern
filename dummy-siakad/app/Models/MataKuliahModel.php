<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliahModel extends Model
{
    use HasFactory;

    protected $table = 'mata_kuliah_models';
    protected $primaryKey = 'id_matkul';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id_matkul',
        'nama_matkul',
        'prodi_id',
        'keahlian',
    ];

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudiModel::class, 'prodi_id', 'prodi_id');
    }
}
