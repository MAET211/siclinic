<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horario;
use App\Models\Profesional;

class HorarioProfesionalController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');

        $horarios = Horario::where('hora_inicio', 'like', "%$search%")->pluck('hora_inicio');
        $profesionales = Profesional::where('nombre', 'like', "%$search%")->pluck('nombre');

        return response()->json([
            'horarios' => $horarios,
            'profesionales' => $profesionales
        ]);
    }
}
