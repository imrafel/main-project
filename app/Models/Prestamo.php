<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'fecha_solicitud',
        'fecha_practica',
        'nombreCompleto',
        'carne',
        'jornada',
        'carrera',
        'grado',
        'programa',
        'seccion',
        'gerencia',
        'bodega',
        'compra'
    ];


    public function user(){
       return $this->hasOne(User::class, 'id', 'user_id');
    }
}
