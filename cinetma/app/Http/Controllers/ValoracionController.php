<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Valoracion;

class ValoracionController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validación del formulario
        $validation = $request->validate([
            'nota' => 'required|integer',
            'pelicula_id' => 'required|integer'
        ]);

        $datos = $validation;

        foreach ($datos as $dato) {
            $dato = e($dato);
        }
        $datos['user_id'] = Auth::id();

        $valoracion = Valoracion::create($datos);

        return response()->json([
            'data' => $valoracion
        ], 200)->header('Content-Type', 'application/json');
    }

    public function buscarValoracion(Request $request)
    {
        if (!$request->input('pelicula_id'))
        {
            return response()->json([
                'errors' => array([
                    'code' => 404,
                    'message' => 'Faltan parámetros para poder realizar la búsqueda.'
                ])
            ], 404);
        }
        $valoracion = Valoracion::where([
            ['pelicula_id', '=', $request->input('pelicula_id')],
            ['user_id', '=', Auth::id()],
        ])->get();

        if(sizeof($valoracion) == 0)
        {
            return response()->json([
                'errors' => array([
                    'code' => 404,
                    'message' => 'No ha sido encontrada una valoracion con ese ID.'
                ])
            ], 404);
        }
        else {
            return response()->json([
                'data' => $valoracion
            ], 200)->header('Content-Type', 'application/json');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // Comprueba si existe la valoración
        if (!$request->input('pelicula_id') || !$request->input('user_id'))
        {
            return response()->json(['errors'=>array(['code'=>404,'message'=>'Faltan parámetros para poder realizar la búsqueda.'])],404);
        }
        $valoracion = Valoracion::where([
            ['pelicula_id', '=', $request->input('pelicula_id')],
            ['user_id', '=', $request->input('user_id')],
        ])->get();

            // En caso de que no exista manda un error
        if (sizeof($valoracion) == 0) {
            return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra una valoracion con ese código.'])],404);
        }
        else
        {
            $valoracion = Valoracion::find($valoracion[0]->id);
            $valoracion->delete();
            return response()->json(['code'=>204,'message'=>'Se ha eliminado correctamente la valoración.'],204);
        }
    }
}
