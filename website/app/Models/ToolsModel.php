<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToolsModel extends Model
{
    use HasFactory;
    protected $table = 'tools';
    protected $primaryKey = 'tools_id';
}
