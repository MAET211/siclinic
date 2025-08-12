<?php

namespace App\Http\Controllers;

use App\Imports\CupsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class CupsImportController extends Controller
{
    /**
     * Mostrar formulario de importación
     */
    public function showImportForm()
    {
        return view('cups.import');
    }

    /**
     * Procesar la importación
     */
    public function import(Request $request)
    {
        // Validar el archivo
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx,xls,csv|max:2048'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            // Procesar la importación
            $import = new CupsImport();
            Excel::import($import, $request->file('file'));

            // Verificar si hubo errores durante la importación
            $errors = $import->getErrors();
            
            if (!empty($errors)) {
                $errorMessages = [];
                foreach ($errors as $error) {
                    $errorMessages[] = "Fila {$error->row()}: " . implode(', ', $error->errors());
                }
                
                return back()->with('warning', 'Importación completada con errores:')
                           ->with('errors', $errorMessages);
            }

            return back()->with('success', 'Importación completada exitosamente.');

        } catch (\Exception $e) {
            return back()->with('error', 'Error durante la importación: ' . $e->getMessage());
        }
    }

    /**
     * Descargar plantilla de ejemplo
     */
    public function downloadTemplate()
    {
        $headers = [
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => 'attachment; filename="plantilla_cups.xlsx"'
        ];

        // Crear una plantilla básica
        $data = [
            ['codigo', 'descripcion', 'valor', 'categoria', 'activo'],
            ['001', 'Ejemplo de procedimiento', '50000', 'Consulta', '1'],
            ['002', 'Otro procedimiento', '75000', 'Procedimiento', '1'],
        ];

        return Excel::download(new class($data) implements \Maatwebsite\Excel\Concerns\FromArray {
            private $data;
            
            public function __construct($data) {
                $this->data = $data;
            }
            
            public function array(): array {
                return $this->data;
            }
        }, 'plantilla_cups.xlsx', \Maatwebsite\Excel\Excel::XLSX, $headers);
    }
}