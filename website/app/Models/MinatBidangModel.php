<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinatBidangModel extends Model
{
    use HasFactory;

    protected $table = 'minat_bidang';
    protected $primaryKey = 'id_minat_bidang';
}
