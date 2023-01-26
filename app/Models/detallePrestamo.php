<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detallePrestamo extends Model
{
    use HasFactory;


    protected $fillable = [
        'prestamo_id',
        'articulo_id',
        'cantidad',
        'herramienta',
        'descripcion'
    ];
}
