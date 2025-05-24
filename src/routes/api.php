<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CocheController;

/**
 * Las rutas se cargan automáticamente con el prefijo /api.
 * El middleware 'auth' garantiza que solo los usuarios
 * que ya han iniciado sesión a través de Breeze puedan acceder.
 * El middleware 'throttle' limita las conexiones a la API a 6 por minuto.
 */

Route::middleware(['auth', 'throttle:6,1'])->group(function () {

    /*
     |  GET    /api/coches           - index
     |  POST   /api/coches           - store
     |  GET    /api/coches/{id}      - show
     |  PUT    /api/coches/{id}      - update
     |  DELETE /api/coches/{id}      - destroy
     |
     |  Generado con Route::apiResource para evitar rutas de formulario
     |  (create/edit) que una API REST no necesita.
     */
    
    Route::apiResource('coches', CocheController::class)
         ->names('api.coches');
});