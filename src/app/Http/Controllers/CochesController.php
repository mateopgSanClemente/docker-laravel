<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

// Clase Auth
use Illuminate\Support\Facades\Auth;
// Modelo para coches
use App\Models\Coche;

class CochesController extends Controller
{
    /**
     * Devuelve todos los coches de la base de datos
     */
    public function index()
    {
        $coches = Auth::user()
                      ->coches()      // relación hasMany definida en el modelo Users
                      ->latest()
                      ->get();

        return response()->json($coches, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datos = $request->validate(Coche::rules());

        $coche = Auth::user()->coches()->create($datos);

        return response()->json($coche, 201); // 201 Created
    }

    /**
     * Display the specified resource.
     */
    public function show(Coche $coche)
    {
        $this->abortIfNotOwner($coche);

        return response()->json($coche, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coche $coche)
    {
        $this->abortIfNotOwner($coche);

        // Ignora su propia matrícula al validar unicidad
        $datos = $request->validate(Coche::rules($coche->id));

        $coche->update($datos);

        return response()->json($coche, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coche $coche)
    {
        $this->abortIfNotOwner($coche);

        $coche->delete();

        return response()->json(null, 204); // 204 No Content
    }

    /**
     * Helper de autorización por dueño. Si el id del usuario no se corresponde con el user_id del coche se bloquea el acceso.
     */
    protected function abortIfNotOwner(Coche $coche): void
    {
        abort_unless(Auth::id() === $coche->user_id, 403, 'Acceso denegado');
    }
}
