<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function editarUsuario(Request $request)
    {
        // En caso de que no exista, devuelve un error.
        if(!$user = User::find($request->input('user')))
        {
            return response()->json([
                'errors' => array([
                    'code' => 404,
                    'message' => 'No ha sido encontrada un usuario con ese ID.'
                ])
            ], 404);
        }

        // Validación del formulario
        $request->validate([
            'nombre' => 'string|max:255|nullable',
            'apellidos' => 'string|max:255|nullable',
            'notificaciones' => 'required|boolean',
            'nick' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users')->ignore($user)
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user)
            ]
        ]);

        // Limpieza de los datos
        $datos = $request->all();
        foreach ($request->all() as $dato) {
            $dato = e($dato);
        }

        $user->nombre = $datos['nombre'];
        $user->apellidos = $datos['apellidos'];
        $user->nick = $datos['nick'];
        $user->email = $datos['email'];
        $user->notificaciones = $datos['notificaciones'];
        $user->save();
        return redirect()->route('perfil');
    }

    public function destroy($id)
    {
        // Comprueba si existe el usuario
        $user = User::find($id);

        // En caso de que no exista manda un error
        if (!$user) {
            return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un usuario con ese ID.'])],404);
        }
        else
        {
            $user->delete();
            return response()->json(['code'=>204,'message'=>'Se ha eliminado correctamente el usuario.'],204);
        }
    }
}