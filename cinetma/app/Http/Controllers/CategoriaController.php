<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Pelicula;
use Illuminate\Http\Request;

class CategoriaController extends Controller
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
            'titulo' => 'required|string|max:255'
        ]);

        $datos = $request->all();
        foreach ($datos as $dato) {
            $dato = e($dato);
        }

        $categoria = Categoria::create($datos);

        return response()->json([
            'data' => $categoria
        ], 200)->header('Content-Type', 'application/json');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Comprueba si existe la categoria
        $categoria = Categoria::find($id);

        // En caso de que no exista manda un error
        if (!$categoria) {
            return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra una categoria con ese ID.'])],404);
        }
        else
        {
            $categoria->delete();
            return response()->json(['code'=>204,'message'=>'Se ha eliminado correctamente la categoría.'],204);
        }
    }
}
