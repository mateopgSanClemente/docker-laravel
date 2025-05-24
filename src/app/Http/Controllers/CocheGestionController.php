<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CocheGestionController extends Controller
{
    public function index()
    {
        // El listado se obtiene vía fetch, no hace falta pasar datos aquí
        return view('coches.gestion');
    }
}