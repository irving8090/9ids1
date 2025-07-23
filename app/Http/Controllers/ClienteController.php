<?php

namespace App\Http\Controllers;
use App\Models\Cliente; 
use App\Models\Clases; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class ClienteController extends Controller
{
    public function index()
    {
        
        return Cliente::whereIn('rol', ['cliente'])->get();
    }
     public function index1()
    {
        
        return Cliente::whereIn('rol', ['profesor'])->get();
    }
     public function index2()
    {
        
        return Cliente::whereIn('rol', ['administrador'])->get();
    }

    public function store(Request $request)
{
    try {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users', 
            'password' => 'required|string|min:6',
            'curp' => 'nullable|string|max:50',
            'fecha_nacimiento' => 'nullable|date',
            'genero' => 'nullable|in:M,F,O',
            'rol' => 'required|in:cliente,profesor,administrador',
        ]);

        $data['password'] = Hash::make($data['password']);
        

        $cliente = Cliente::create($data); 

        return response()->json($cliente, 201);
    } catch (\Throwable $e) {
        return response()->json([
            'message' => 'Error interno del servidor',
            'error' => $e->getMessage(),
        ], 500);
    }
}

    public function show($id)
    {
        return Cliente::findOrFail($id); 
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id); 

        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            
            'email' => ['sometimes', 'required', 'email', Rule::unique('users')->ignore($id)],
            'password' => 'nullable|string|min:6',
            'curp' => 'nullable|string|max:50',
            'fecha_nacimiento' => 'nullable|date',
            'genero' => 'nullable|in:M,F,O',
            'rol' => 'nullable|in:cliente,profesor,administrador',
        ]);

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $cliente->update($data); 

        return response()->json($cliente);
    }


    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id); 
        $cliente->delete();

        return response()->json(['message' => 'Usuario eliminado']);
    }

    // Crear clase (solo admins)
public function crearClase(Request $request, $admin_id)
{
    $admin = Cliente::findOrFail($admin_id);

    if ($admin->rol !== 'administrador') {
        return response()->json(['error' => 'No autorizado'], 403);
    }

    $data = $request->validate([
        'nombre' => 'required|string|max:100',
        'dia_semana' => 'required|string|max:10',
        'hora_inicio' => 'required',
        'hora_fin' => 'required',
        'lugares_disponibles' => 'required|integer|min:1',
        'id_profesor' => 'required|exists:users,id',
    ]);

    // Validar que el usuario seleccionado realmente sea profesor
    $profesor = Cliente::findOrFail($data['id_profesor']);
    if ($profesor->rol !== 'profesor') {
        return response()->json(['error' => 'El usuario seleccionado no es un profesor'], 400);
    }

    $clase = Clases::create([
        'nombre' => $data['nombre'],
        'dia_semana' => $data['dia_semana'],
        'hora_inicio' => $data['hora_inicio'],
        'hora_fin' => $data['hora_fin'],
        'lugares_disponibles' => $data['lugares_disponibles'],
        'lugares_ocupados' => 0,
        'id_usuario' => $profesor->id,
    ]);

    return response()->json($clase, 201);
}

    // Ver clases disponibles
    public function verClases()
    {
        return Clases::all();
    }

    // Inscribirse a clase y descontar membresía
    
public function asistirClase(Request $request, $cliente_id, $clase_id)
{
    $cliente = Cliente::findOrFail($cliente_id);
    $clase = Clases::findOrFail($clase_id);
    $membresia = $cliente->membresia;

    if ($cliente->rol !== 'cliente') {
        return response()->json(['error' => 'Solo los clientes pueden inscribirse'], 403);
    }

    if (!$membresia || $membresia->clases_incluidas < 1) {
        return response()->json(['error' => 'No tienes clases disponibles en tu membresía'], 400);
    }

    if ($clase->lugares_disponibles !== null && $clase->lugares_ocupados >= $clase->lugares_disponibles) {
        return response()->json(['error' => 'No hay cupos disponibles en esta clase'], 400);
    }

    // Descontar clase de la membresía
    $membresia->clases_incluidas -= 1;
    $membresia->save();

    // Aumentar lugar ocupado
    $clase->lugares_ocupados += 1;
    $clase->save();

    
    $cliente->clases()->attach($clase->id);

    return response()->json([
        'message' => 'Inscripción exitosa',
        'clases_restantes' => $membresia->clases_incluidas,
    ]);
}
public function verClasesInscritas($cliente_id)
{
    $cliente = Cliente::findOrFail($cliente_id);
    $clases = $cliente->clases()->with('profesor')->get(); 

    return response()->json($clases);
}




}
