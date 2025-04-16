<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    // Agregar los campos permitidos para la asignación masiva
    protected $fillable = [
        'titulo',
        'descripcion',
    ];
}

