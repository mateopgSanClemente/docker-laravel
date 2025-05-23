<?php

namespace App\Http\Controllers;

// Importar clasese de los modelos Citas y Users
use App\Models\Cita;
use App\Models\User;
use Illuminate\Http\Request;

// Importar middleware para mostrar páginas en función del role.
use App\Http\Middlewawre\CheckRole;

use Illuminate\Support\Facades\Auth;

class CitaController extends Controller
{

    // Aplicamos el middlware CheckRole a todo el controlador
    public function __construct()
    {
        $this->middleware('auth');
        
        // Sólo clientes
        $this->middleware(CheckRole::class . 'cliente')->only(['index', 'create', 'store']);

        // Sólo taller
        $this->middleware(CheckRole::class . 'taller')->(['indexTaller', 'indexPendientes', 'edit', 'update', 'destroy']);
    }

    /* ====== CLIENTE ====== */

    /**
     * Mostrar lista de citas para el usuario actual (cliente)
     */
    public function index()
    {
        $citas = Auth::user()->citas()->latest()->get(); // Obtiene las citas para el usuario autenticado ordenadas for fecha reciente.
        return view ('cliente.index', compact('citas'));
    }

    /**
     * Muestra el formulario para la creación de nuevas citas
     */
    public function create()
    {
        return view('cliente.create');
    }

    /**
     * Guarda una nueva cita en la base de datos
     */
    public function store(Request $request)
    {
        // Reglas de validación para las citas registradas
        $validated = $request->validate([
            'marca' => 'required|string|max:50',
            'modelo'    => 'required|string|max:50',
            'matricula' => 'required|string|max:10|unique:citas,matricula',
        ]);

        Auth::user()->citas()->create($validated + [
            'estado' => 'pendiente', // Por defecto
            'fecha' => null,
            'hora' => null,
            'duracion_estimada' => null,
        ]);
        
        return redirect()->route('citas.index')->with('success', 'Cita solicitada correctamente');
    }

    /* ====== VISTA COMÚN ====== */

    /**
     * Muestra detalles de una cita, disponible tanto para clientes como para taller.
     * Solo el taller puede ver aquellas citas que no se corresponden con su id
     */
    public function show(Cita $cita)
    {
        // Si el usuario que solicita ver los detalles de la cita tiene el rol 'cliente' y su 'id' no se correcponde con el 'user_id' de la cita, no se permite la visualización de la página.
        if(Auth::user()->role === 'cliente' && Auth::user()->id !== $cita->user_id) {
            abort(403);
        }

        return view('citas.show', compact('cita'));
    }

    /* ====== TALLER ====== */

    /**
     * Mostrar todas las citas
     */
    public function indexTaller()
    {
        // Carga todas las citas con sus usuarios asociados
        $citas = Cita::with('user')-latest()->get(); // Eager Loading, evita el problema 1+N
        return view('taller.index', compact('citas'));
    }

    /**
     * Muestra todas la citas con el estado 'pendiete'
     */
    public function indexPendiente()
    {
        // Carga todas las citas con el estado 'pediente'
        $citas = Cita::where('estado', 'pendiente')->with('user')->latest()->get();
        return view('taller.pendiente', compact('citas'));
    }

    /**
     * Actualiza una cita
     */
    public function update(Request $request, Cita $cita)
    {
        // Reglas de validación para la request
        $validated = $request->validate([
            'fecha' => 'required|date|after_or_equal:today', // La fecha no puede ser anterior a la actual
            'hora' => 'required|date_format:H:i', // El formato para la hora de la cita mostrará la hora y los minutos.
            'duracion_estimada' => 'required|integer|min:1', // La duración mínima de la cita será de 1 minuto.
            'estado' => 'required|in:pendiente,asignada', // El estado solo puede contener los valores 'pendiente' y 'asignada'
        ]);

        // Actualiza los datos de en la tabla 'citas'
        $cita->update($validated);

        // Redirigir a la página index que muestra las citas para el taller
        return redirect()->route('taller.citas')->with('success', 'Cita actualizada');
    }

    /**
     * Eliminar cita
     */
    public function destroy(Cita $cita)
    {
        // Elimina la cita de la base de datos
        $cite->delete();

        // Redirecciona a la página index del taller
        return redirect()->route('taller.citas')->with('success', 'Cita Eliminada');
    }
}
