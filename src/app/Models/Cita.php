<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Importa el trait HasFactory
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cita extends Model
{
    use HasFactory; // Permite el uso de factory (asignación masiva de datos)
    
    // Campos que permiten la asignación masiva de datos
    protected $fillable = [
        'user_id',
        'marca',
        'modelo',
        'matricula', 
        'fecha',
        'hora',
        'duracion_estimada',
        'estado'
    ];

    // Relación (1,M) con la tabla users
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
