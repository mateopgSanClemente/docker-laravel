<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//Datos: marca, modelo, matrícula y relación con cliente (users). Todos son obligatorios.
// Importa el trait HasFactory
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coche extends Model
{
    use HasFactory;

    // Campos para la asignación masiva de datos
    protected $fillable = [
        'user_id'
        'marca',
        'modelo',
        'matricula',
    ];


    /* ====== REGLAS DE VALIDACIÓN ====== */

    /**
     * Devuelve las reglas de validación para crear / actualizar un coche.
     * Se llama, por ejemplo, en el controlador:
     * Para dar de alta:
     *   $request->validate(Coche::rules());
     * Para editar:
     *   $request->validate(Coche::rules($coche->id));
     */
    public static function rules(int|null $cocheId = null): array
    {
        return [
            'marca'     => ['required', 'string', 'max:50'],
            'modelo'    => ['required', 'string', 'max:50'],
            'matricula' => ['required', 'string', 'max:10',
            Rule::unique('coches', 'matricula')->ignore($cocheId),], // Única en la tabla, pero se excluye el ID actual si es edición
            'user_id'   => ['required', 'exists:users,id'],
        ];
    }

    /* ====== RELACIONES ====== */

    // Relación (1,M) con la tabla users
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
