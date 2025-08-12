<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Eps;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::with('eps')->get();
        return view('pacientes.index', compact('pacientes'));
    }

    public function create()
    {
        $eps = Eps::all();
        return view('pacientes.create', compact('eps'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'documento' => 'required',
            'fecha_nacimiento' => 'required|date',
            'telefono' => 'required',
            'direccion' => 'required',
            'id_eps' => 'required|exists:eps,id_eps',
        ]);

        Paciente::create($request->all());

        return redirect()->route('pacientes.index')->with('success', 'Paciente registrado exitosamente.');
    }
}
