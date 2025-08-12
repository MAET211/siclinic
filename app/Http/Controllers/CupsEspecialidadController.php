<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cups;
use App\Models\Especialidad;

class CupsEspecialidadController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');

        $cups = Cups::where('nombre', 'like', "%$search%")->pluck('nombre');
        $especialidades = Especialidad::where('nombre', 'like', "%$search%")->pluck('nombre');

        return response()->json([
            'cups' => $cups,
            'especialidades' => $especialidades
        ]);
    }
}
