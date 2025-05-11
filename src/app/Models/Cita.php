<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $fillable = [
        'user_id', 'marca', 'modelo', 'matricula', 'fecha', 'hora', 'duracion_estimada',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
