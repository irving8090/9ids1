<?php

namespace App\Http\Controllers;

use App\Models\Clases;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClasesController extends Controller
{
    // Actualizar clase
    public function actualizarClase(Request $request, $id)
    {
        $clase = Clases::findOrFail($id);

        $data = $request->validate([
            'nombre' => 'sometimes|required|string|max:100',
            'dia_semana' => 'sometimes|required|string|max:10',
            'hora_inicio' => 'sometimes|required',
            'hora_fin' => 'sometimes|required',
            'lugares_disponibles' => 'sometimes|required|integer|min:1',
            'id_profesor' => 'sometimes|required|exists:users,id',
        ]);

        if (isset($data['id_profesor'])) {
            $profesor = Cliente::findOrFail($data['id_profesor']);
            if ($profesor->rol !== 'profesor') {
                return response()->json(['error' => 'El usuario seleccionado no es un profesor'], 400);
            }
            $data['id_usuario'] = $profesor->id;
            unset($data['id_profesor']);
        }

        $clase->update($data);

        return response()->json($clase);
    }

    // Eliminar clase
    public function eliminarClase($id)
    {
        $clase = Clases::findOrFail($id);
        $clase->delete();

        return response()->json(['message' => 'Clase eliminada correctamente']);
    }
  public function clasesPorProfesor($profesorId)
{
    
    $clases = Clases::where('id_usuario', $profesorId)->get();
    return response()->json($clases);
}


}
