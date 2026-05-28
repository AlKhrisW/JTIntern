<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStudiModel extends Model
{
    use HasFactory;

    protected $table = 'program_studi_models';
    protected $primaryKey = 'prodi_id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'prodi_id',
        'nama_prodi',
    ];
}
