<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalle_materialYEquipo extends Model
{
    use HasFactory;
 
    protected $fillable = [
        'material_id',
        'cantidad',
        'descripcion'
    ];

}
