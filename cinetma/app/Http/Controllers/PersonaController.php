<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;

class PersonaController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Compruebo si existen todos los campos necesarios.
    	if (!$request->input('nombre'))
    	{
    		return response()->json([
    			'errors' => array([
    				'code' => 422,
    				'message' => 'Faltan campos para poder completar el proceso de alta.'
    			])
    		], 422);
    	}

    	$datos = $request->all();

    	foreach ($datos as $dato) {
    		$dato = e($dato);
    	}

    	$persona = Persona::create($datos);

    	return response()->json([
    		'data' => $persona
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
        // Comprueba si existe la persona
        // En caso de que no exista manda un error
    	if (!$persona = Persona::find($id)) {
    		return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra una persona con ese código.'])],404);
    	}
    	else
    	{
    		$persona->delete();
    		return response()->json(['code'=>204,'message'=>'Se ha eliminado correctamente la persona.'],204);
    	}
    }

    public function getPersona($id)
    {
        // Comprueba si existe la persona
        // Si existe, redirige a la vista de esa persona.
        if($persona = Persona::find($id))
        {
            return view('main.persona')->with(compact('persona'));
        }
        else return redirect()->route('index');
    }
}