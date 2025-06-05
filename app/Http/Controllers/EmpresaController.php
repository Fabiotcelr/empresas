<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class EmpresaController extends Controller
{
    public function index()
    {
        try {
            $empresas = Empresa::all();
            return response()->json($empresas, 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al obtener las empresas'], 500);
        }
    }

    public function show($nit)
    {
        try {
            $empresa = Empresa::where('nit', $nit)->firstOrFail();
            return response()->json($empresa, 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Empresa no encontrada'], 404);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nit' => 'required|string|unique:empresas,nit|max:20',
                'nombre' => 'required|string|max:255',
                'direccion' => 'required|string|max:255',
                'telefono' => 'required|string|max:20',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $empresa = Empresa::create([
                'nit' => $request->nit,
                'nombre' => $request->nombre,
                'direccion' => $request->direccion,
                'telefono' => $request->telefono,
                'estado' => 'Activo', // Estado por defecto
            ]);

            return response()->json($empresa, 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al crear la empresa'], 500);
        }
    }

    public function update(Request $request, $nit)
    {
        try {
            $empresa = Empresa::where('nit', $nit)->firstOrFail();

            $validator = Validator::make($request->all(), [
                'nombre' => 'sometimes|string|max:255',
                'direccion' => 'sometimes|string|max:255',
                'telefono' => 'sometimes|string|max:20',
                'estado' => 'sometimes|in:Activo,Inactivo',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $empresa->update($request->only(['nombre', 'direccion', 'telefono', 'estado']));
            return response()->json($empresa, 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al actualizar la empresa'], 500);
        }
    }

    public function destroyInactive()
    {
        try {
            $deleted = Empresa::where('estado', 'Inactivo')->delete();
            return response()->json(['message' => "$deleted empresas inactivas eliminadas"], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al eliminar empresas inactivas'], 500);
        }
    }
}