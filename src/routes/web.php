<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Importar controlador para citas
use App\Http\Controllers\CitaController;
// Controlador puente para visualizar los coches
use App\Http\Controllers\CocheGestionController;

// Importar el middleware
use App\Http\Middleware\CheckRole;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Todas las rutas que requieren de una sesión en Breeze
Route::middleware('auth')->group(function () {

    /* ====== PERFIL DE BREEZE ====== */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /* ====== CLIENTES ====== */
    Route::middleware([CheckRole::class .':cliente'])
        ->prefix('cliente')
        ->as('cliente.') // Nombres: cliente.citas.index
        ->group(function(){

        // Listado de citas para el cliente autenticado
        Route::get('/citas', [CitaController::class, 'index'])->name('citas.index');

        // Formulario para la creación de una nueva cita por parte del cliente
        Route::get('/create', [CitaController::class, 'create'])->name('citas.create');

        // Guardar cita en la base de datos
        Route::post('/store', [CitaController::class, 'store'])->name('citas.store');
    });

    /* ====== TALLER ====== */
    Route::middleware([CheckRole::class .':taller'])
        ->prefix('taller')
        ->as('taller.') // Nombres: taller.citas.index
        ->group(function(){

        // Muestra todas las citas
        Route::get('/citas', [CitaController::class, 'indexTaller'])->name('citas.index');

        // Muestra citas pendientes
        Route::get('/citas/pendientes', [CitaController::class, 'indexPendientes'])->name('citas.pendientes');

        // Muestra un formulario para editar una cita concreta
        Route::get('/citas/{cita}/edit', [CitaController::class, 'edit'])->name('citas.edit');

        // Actualiza una cita en la base de datos
        Route::put('/citas/{cita}', [CitaController::class, 'update'])->name('citas.update');

        //Elimina una cita
        Route::delete('/citas/{cita}', [CitaController::class, 'destroy'])->name('citas.destroy');
    });

    /* ====== RUTAS COMUNES (CITAS + TALLER) ====== */
    Route::get('/citas/{cita}', [CitaController::class, 'show'])->name('citas.show');

    /* ====== RUTAS PARA COCHES ====== */

    /**
     * Panel para gestionar los coches propios
     */
    Route::get('/coches', [CocheGestionController::class, 'index'])
        ->name('coches.gestion');
});

require __DIR__.'/auth.php';