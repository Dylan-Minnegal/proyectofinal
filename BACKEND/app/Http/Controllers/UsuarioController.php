<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Http\Requests\UsuarioRequest;
use Illuminate\Support\Facades\Hash;


class UsuarioController extends Controller
{
    public function store(UsuarioRequest $request)
{
    $data = $request->validated();

    $data['password'] = Hash::make($data['password']); 

    $data['rol'] = 'usuario';

    $usuario = Usuario::create($data);

    return response()->json($usuario, 201);
}

   
    public function update(UsuarioRequest $request, $id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado.'], 404);
        }

        $data = $request->validated();

        $usuario->update($data);

        return response()->json($usuario);
    }
    public function show($id)
    {
        $usuario = Usuario::findOrFail($id);
    
        if (!$usuario) {
            return response()->json([
                'message' => 'Usuario no encontrado'
           ], 404); 
    }

        return response()->json([
           'message' => 'Usuario encontrado con éxito',
           'nombre' => $usuario->nombre,
           'apellidos' => $usuario->apellidos, 
            'email' => $usuario->email,
            'id' => $usuario->id,
        ], 200);
    }

}
    