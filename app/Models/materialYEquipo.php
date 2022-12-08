<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class materialYEquipo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nombreCompleto',
        'fecha_solicitud',
        'fecha_practica',
        'carrera',
        'programa',
        'grado',
        'jornada',
        'seccion',
        'practica',
        'tipo',
        'gerencia',
        'bodega',
        'compra'
    ];

    
    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
     }

}
