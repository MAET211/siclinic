<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profesional;
use App\Models\Especialidad;

class ProfesionalEspecialidadController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');

        $profesionales = Profesional::where('nombre', 'like', "%$search%")->pluck('nombre');
        $especialidades = Especialidad::where('nombre', 'like', "%$search%")->pluck('nombre');

        return response()->json([
            'profesionales' => $profesionales,
            'especialidades' => $especialidades
        ]);
    }
}
