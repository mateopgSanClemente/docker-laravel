<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CitaController;
use Illuminate\Support\Facades\Route;

// Utilizamos el middleware específico que creamos para validar que el usuario tiene el rol 'taller' o 'usuario'.
use App\Http\Middleware\RoleMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Protegemos las rutas mediante el middleware
Route::middleware('auth')->group(function(){
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/taller', function () {
        return view('taller.panel');
    })->middleware(RoleMiddleware::class)->name('taller');
});

Route::middleware(['auth'])->group(function () {
    // Ver sus propias citas
    Route::get('/citas', [CitaController::class, 'index'])->name('citas.index');

    // Crear nueva cita
    Route::get('/citas/crear', [CitaController::class, 'create'])->name('citas.create');
    Route::post('/citas', [CitaController::class, 'store'])->name('citas.store');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/taller/citas', [CitaController::class, 'index'])->name('taller.citas.index');
    Route::get('/taller/citas/{cita}/edit', [CitaController::class, 'edit'])->name('taller.citas.edit');
    Route::put('/taller/citas/{cita}', [CitaController::class, 'update'])->name('taller.citas.update');
    Route::delete('/taller/citas/{cita}', [CitaController::class, 'destroy'])->name('taller.citas.destroy');
});


require __DIR__.'/auth.php';
