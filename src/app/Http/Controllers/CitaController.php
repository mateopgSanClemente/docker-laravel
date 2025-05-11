<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;

class CitaController extends Controller
{
    public function create()
    {
        return view('citas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'marca' => 'required|string',
            'modelo' => 'required|string',
            'matricula' => 'required|string',
        ]);

        Cita::create([
            'user_id' => auth()->id(),
            'marca' => $request->marca,
            'modelo' => $request->modelo,
            'matricula' => $request->matricula,
            // fecha, hora y duración se quedarán como null por defecto
        ]);

        return redirect()->route('dashboard')->with('success', 'Cita creada correctamente.');
    }

    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'taller') {
            // El taller puede ver todas las citas
            $citas = Cita::with('user')->latest()->get();
        } else {
            // El cliente solo ve sus propias citas
            $citas = Cita::where('user_id', $user->id)->latest()->get();
        }

        return view('citas.index', compact('citas'));
    }

    public function edit(Cita $cita)
    {
        $this->authorizeTaller();
        return view('taller.citas.edit', compact('cita'));
    }

    public function update(Request $request, Cita $cita)
    {
        $this->authorizeTaller();

        $request->validate([
            'fecha' => 'nullable|date',
            'hora' => 'nullable',
            'duracion_estimada' => 'nullable|integer|min:0',
        ]);

        $cita->update($request->only(['fecha', 'hora', 'duracion_estimada']));

        return redirect()->route('taller.citas.index')->with('success', 'Cita actualizada');
    }

    public function destroy(Cita $cita)
    {
        $this->authorizeTaller();
        $cita->delete();
        return redirect()->route('taller.citas.index')->with('success', 'Cita eliminada');
    }

    protected function authorizeTaller()
    {
        if (auth()->user()->role !== 'taller') {
            abort(403, 'No autorizado');
        }
    }
}