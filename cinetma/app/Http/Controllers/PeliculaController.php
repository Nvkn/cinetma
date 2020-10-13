<?php

namespace App\Http\Controllers;

use App\Pelicula;
use App\Valoracion;
use App\User;
use App\Persona;
use App\Categoria;
use App\Notifications\PeliculaFinalizada;
use App\Jobs\EnviarNotificacionPeliculaFinalizada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;


class PeliculaController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listarPeliculas(Request $request, $tipo)
    {
        $peliculasPorPagina = 16;
        $peliculas = null;

        // Devuelve las películas en formato JSON.
        // Primer filtro: tipo de película que se desea listar.
        // Después, hace una consulta distinta según los parámetros que se le pasen.


        // PELICULAS FINALIZADAS

        // Orden:
        // 0 -> Últimas películas
        // 1 -> Mejor valoradas
        $datos = limpiarDatos($request->all());
        if ($tipo == "finalizada") {

            // Orden 0 - Últimas películas
            if($datos['orden'] == 0) {
                // Sin categoría
                if ($datos['categoria'] == null) {
                    $peliculas = DB::table('peliculas as p')
                    ->select('p.id', 'p.titulo', 'p.portada')
                    ->where('finalizada','=','1')
                    ->orderBy('id','desc')
                    ->paginate($peliculasPorPagina);
                }
                // Filtrando categoría
                else {
                    $peliculas = DB::table('peliculas as p')
                    ->join('categoria_pelicula as cp','p.id','=','cp.pelicula_id')
                    ->join('categorias as c','c.id','=','cp.categoria_id')
                    ->groupBy('p.id')
                    ->select('p.id', 'p.titulo', 'p.portada')
                    ->where([
                        ['finalizada','=','1'],
                        ['categoria','=',$datos['categoria']]
                    ])
                    ->orderBy('id','desc')
                    ->paginate($peliculasPorPagina);
                }
            }

            // Orden 1 - Mejor valoradas
            if($datos['orden'] == 1) {
                // Sin categoría
                if ($datos['categoria'] == null) {
                    $peliculas = DB::table('peliculas as p')
                    ->join('valoraciones as v','p.id','=','v.pelicula_id')
                    ->groupBy('p.id')
                    ->select('p.id', 'p.titulo', 'p.portada', DB::raw('AVG(nota) as nota'))
                    ->orderBy('nota','desc')
                    ->where('finalizada','=','1')
                    ->paginate($peliculasPorPagina);
                }

                // Filtrando categoría
                else {
                    $peliculas = DB::table('peliculas as p')
                    ->join('valoraciones as v','p.id','=','v.pelicula_id')
                    ->join('categoria_pelicula as cp','p.id','=','cp.pelicula_id')
                    ->join('categorias as c','c.id','=','cp.categoria_id')
                    ->groupBy('p.id')
                    ->select('p.id', 'p.titulo', 'p.portada', DB::raw('AVG(nota) as nota'))
                    ->orderBy('nota','desc')
                    ->where([
                        ['finalizada','=','1'],
                        ['categoria','=',$datos['categoria']]
                    ])
                    ->paginate($peliculasPorPagina);
                }
            }
        }
        // Películas en producción
        else if($tipo == 'produccion')
        {
            $peliculas = DB::table('peliculas as p')
            ->select('p.id', 'p.titulo', 'p.portada')
            ->where('finalizada','=','0')
            ->orderBy('id','desc')
            ->paginate($peliculasPorPagina);
        }

        return $peliculas;
    }

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
            'titulo' => 'required|string|max:100',
            'finalizada' => 'required|boolean',
            'descripcion' => 'required|string|max:255',
            'sinopsis' => 'required|string',
            'portada' => 'image|nullable',
            'donacion' => 'url|nullable',
            'trailer' => 'url|nullable',
            'categoria.*' => 'required|string|max:255',
            'imagenes.*' => 'image|nullable',
            'reparto.nombre.*' => 'string|max:255',
            'reparto.papel.*' => 'string|nullable|max:255',
            'staff.nombre.*' => 'string|max:255',
            'staff.rol.*' => 'string|max:255',
            'duracion' => [
                'integer',
                'nullable',
                Rule::requiredIf($request->input('finalizada') == 1)
            ],
            'fechaLanzamiento' => [
                'date',
                'nullable',
                Rule::requiredIf($request->input('finalizada') == 1)
            ]
        ]);

        $datos = limpiarDatos($validation);

        // Imágenes
        if ($request->file('imagenes')) {
            for ($i = 0; $i < sizeof($request->file('imagenes')); $i++)
            {
                $imagen = $request->file('imagenes')[$i];
                $extension = $imagen->getClientOriginalExtension();
                $nombre = md5(time() . e($imagen->getClientOriginalName())) . '.' . $extension;
                $imagenGuardada = Storage::disk('imagenes')->put($nombre, file_get_contents($imagen));
                $datos['imagenes'][$i] = $nombre;
            }
            $datos['imagenes'] = json_encode($datos['imagenes']);
        }

        // Valor default para la portada.
        if (!$request->file('portada'))
        {
            $datos['portada'] = 'portada.png';
        }
        else
        {
            $portada = $request->file('portada');
            $extension = $portada->getClientOriginalExtension();
            $nombre = md5(time() . e($portada->getClientOriginalName())) . '.' . $extension;
            $portadaGuardada = Storage::disk('portadas')->put($nombre, file_get_contents($portada));
            $datos['portada'] = $nombre;
        }
        $datos['user_id'] = Auth::id();

        // En caso de que todo sea correcto, se crea una nueva película.
        $pelicula = Pelicula::create($datos);

        foreach ($datos['categoria'] as $nombreCategoria) {
            $categoria = Categoria::where('categoria', $nombreCategoria)->get();
            $pelicula->categorias()->attach($categoria);
        }

        if(isset($datos['reparto']))
        {
            $reparto = $datos['reparto'];
            for($i = 0; $i < sizeof($reparto['nombre']); $i++)
            {
                // Se comprueba si ya existe esa persona
                if($persona = Persona::where('nombre', $reparto['nombre'][$i])->get()->first()) {
                    // Si existe, se le asigna la actuación.
                    $pelicula = Pelicula::find($pelicula->id);
                    $persona->actuaciones()->attach($pelicula, array ('papel' => $reparto['papel'][$i]));
                }
                else {
                    // Si no existe, se crea la persona y se le asigna la actuación.
                    $datosPersona['nombre'] = $reparto['nombre'][$i];
                    $persona = Persona::create($datosPersona);
                    $pelicula = Pelicula::find($pelicula->id);
                    $persona->actuaciones()->attach($pelicula, array ('papel' => $reparto['papel'][$i]));
                }
            }
        }

        if(isset($datos['staff']))
        {
            $staff = $datos['staff'];

            for($i = 0; $i < sizeof($staff['nombre']); $i++)
            {
                // Se comprueba si ya existe esa persona
                if($persona = Persona::where('nombre', $staff['nombre'][$i])->get()->first()) {
                    // Si existe, se le asigna su rol en la producción.
                    $pelicula = Pelicula::find($pelicula->id);
                    $persona->producciones()->attach($pelicula, array ('rol' => $staff['rol'][$i]));
                }
                else {
                    // Si no existe, se crea la persona y se le asigna su rol en la produccion.
                    $datosPersona['nombre'] = $staff['nombre'][$i];
                    $persona = Persona::create($datosPersona);
                    $pelicula = Pelicula::find($pelicula->id);
                    $persona->producciones()->attach($pelicula, array ('rol' => $staff['rol'][$i]));
                }
            }
        }


        // En caso de que la película se encuentre finalizada, se notifica a los usuarios.
        if ($datos['finalizada'] == 1) {
            EnviarNotificacionPeliculaFinalizada::dispatch($pelicula);
        }

        return redirect()->route('pelicula', ['id' => $pelicula->id]);
    }

    public function updatePost(Request $request, $id)
    {
        $pelicula = Pelicula::find($id);

        // En caso de que no exista, devuelve un error.
        if(!$pelicula)
        {
            return response()->json([
                'errors' => array([
                    'code' => 404,
                    'message' => 'No ha sido encontrada una película con ese ID.'
                ])
            ], 404);
        }

        // Validación del formulario
        $validation = $request->validate([
            'titulo' => 'required|string|max:100',
            'finalizada' => 'required|boolean',
            'descripcion' => 'required|string|max:255',
            'sinopsis' => 'required|string',
            'portada' => 'image|nullable',
            'donacion' => 'url|nullable',
            'trailer' => 'url|nullable',
            'categoria.*' => 'required|string|max:255',
            'imagenes.*' => 'image|nullable',
            'reparto.nombre.*' => 'string|max:255',
            'reparto.papel.*' => 'string|nullable|max:255',
            'staff.nombre.*' => 'string|max:255',
            'staff.rol.*' => 'string|max:255',
            'staffEliminado.*' => 'integer',
            'repartoEliminado.*' => 'integer',
            'duracion' => [
                'integer',
                'nullable',
                Rule::requiredIf($request->input('finalizada') == 1)
            ],
            'fechaLanzamiento' => [
                'date',
                'nullable',
                Rule::requiredIf($request->input('finalizada') == 1)
            ]
        ]);

        $datos = limpiarDatos($validation);

        if (isset($datos['repartoEliminado'])) {
            for($i = 0; $i < sizeof($datos['repartoEliminado']); $i++ )
            {
                if ($persona = Persona::find($datos['repartoEliminado'][$i])) {
                    $pelicula->actuaciones()->detach($persona);
                }
            }
        }

        if (isset($datos['staffEliminado'])) {
            for($i = 0; $i < sizeof($datos['staffEliminado']); $i++ )
            {
                if ($persona = Persona::find($datos['staffEliminado'][$i])) {
                    $pelicula->producciones()->detach($persona);
                }
            }
        }

        if(isset($datos['reparto']))
        {
            $reparto = $datos['reparto'];
            for($i = 0; $i < sizeof($reparto['nombre']); $i++)
            {
                // Se comprueba si ya existe esa persona
                if($persona = Persona::where('nombre', $reparto['nombre'][$i])->get()->first()) {
                    // Si existe, se le asigna la actuación.
                    $pelicula = Pelicula::find($pelicula->id);
                    $persona->actuaciones()->attach($pelicula, array ('papel' => $reparto['papel'][$i]));
                }
                else {
                    // Si no existe, se crea la persona y se le asigna la actuación.
                    $datosPersona['nombre'] = $reparto['nombre'][$i];
                    $persona = Persona::create($datosPersona);
                    $pelicula = Pelicula::find($pelicula->id);
                    $persona->actuaciones()->attach($pelicula, array ('papel' => $reparto['papel'][$i]));
                }
            }
        }
        if(isset($datos['staff']))
        {
            $staff = $datos['staff'];

            for($i = 0; $i < sizeof($staff['nombre']); $i++)
            {
                // Se comprueba si ya existe esa persona
                if($persona = Persona::where('nombre', $staff['nombre'][$i])->get()->first()) {
                    // Si existe, se le asigna su rol en la producción.
                    $pelicula = Pelicula::find($pelicula->id);
                    $persona->producciones()->attach($pelicula, array ('rol' => $staff['rol'][$i]));
                }
                else {
                    // Si no existe, se crea la persona y se le asigna su rol en la produccion.
                    $datosPersona['nombre'] = $staff['nombre'][$i];
                    $persona = Persona::create($datosPersona);
                    $pelicula = Pelicula::find($pelicula->id);
                    $persona->producciones()->attach($pelicula, array ('rol' => $staff['rol'][$i]));
                }
            }
        }

        $datos = limpiarDatos($request->all());

        $pelicula->titulo = $datos['titulo'];

        // Portada
        if ($request->file('portada'))
        {
            // Elimina la portada de la película
            if ($pelicula->portada != 'portada.png') {
                Storage::disk('portadas')->delete($pelicula->portada);
            }
            $portada = $request->file('portada');
            $extension = $portada->getClientOriginalExtension();
            $nombre = md5(time() . e($portada->getClientOriginalName())) . '.' . $extension;
            $portadaGuardada = Storage::disk('portadas')->put($nombre, file_get_contents($portada));
            $pelicula->portada = $nombre;
        }


        // Compruebo si la película se acaba de declarar como finalizada.
        $notificar = false;
        if ($pelicula->finalizada == 0 && $datos['finalizada'] == 1) {
            $notificar = true;
        }

        $pelicula->finalizada = $datos['finalizada'];
        $pelicula->fechaLanzamiento = $datos['fechaLanzamiento'];
        $pelicula->descripcion = $datos['descripcion'];
        $pelicula->sinopsis = $datos['sinopsis'];
        $pelicula->trailer = $datos['trailer'];

        if (isset($datos['duracion'])) {
            $pelicula->duracion = $datos['duracion'];
        }
        if (isset($datos['donacion'])) {
            $pelicula->donacion = $datos['donacion'];
        }

        // Imágenes
        $imagenes = array();
        if ($pelicula->imagenes != null)
        {
            if (sizeof(json_decode($pelicula->imagenes)) != 0) {
                $imagenes = json_decode($pelicula->imagenes);
            }
        }
        if ($request->file('imagenes')) {
            for ($i = 0; $i < sizeof($request->file('imagenes')); $i++)
            {
                $imagen = $request->file('imagenes')[$i];
                $extension = $imagen->getClientOriginalExtension();
                $nombre = md5(time() . e($imagen->getClientOriginalName())) . '.' . $extension;
                $imagenGuardada = Storage::disk('imagenes')->put($nombre, file_get_contents($imagen));
                array_push($imagenes, $nombre);
            }
        }
        $pelicula->imagenes = $imagenes;

        // Categorías
        $categoriasNuevas = $datos['categoria'];
        $categoriasAntiguas = $pelicula->categorias()->get();

        // Si una categoría ya no se encuentra entre las nuevas, la elimina.
        foreach($categoriasAntiguas as $categoriaAntigua)
        {
            if(in_array($categoriaAntigua->categoria, $categoriasNuevas)) {
                $index = array_search($categoriaAntigua->categoria, $categoriasNuevas);
                unset($categoriasNuevas[$index]);
            }
            else {
                $pelicula->categorias()->detach($categoriaAntigua);
            }
        }
        // Añade las categorías nuevas.
        foreach ($categoriasNuevas as $nombreCategoria) {
            if ($nombreCategoria != null) {
                $categoria = Categoria::where('categoria', $nombreCategoria)->get();
                $pelicula->categorias()->attach($categoria);
            }
        }

        // En caso de que todo sea correcto, se actualiza la película.
        $pelicula->save();

        // En caso de que la película se encuentre finalizada, se notifica a los usuarios.
        if ($notificar) {
            EnviarNotificacionPeliculaFinalizada::dispatch($pelicula);
        }

        return redirect()->route('pelicula', ['id' => $pelicula->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Comprueba si existe la película
        $pelicula = Pelicula::find($id);

        // En caso de que no exista manda un error
        if (!$pelicula) {
            return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra una pelicula con ese código.'])],404);
        }
        else
        {
            $imagenes = json_decode($pelicula->imagenes);

            // Elimina las imágenes relacionadas con la película
            if ($imagenes != null)
            {
                foreach ($imagenes as $imagen) {
                    Storage::disk('imagenes')->delete($imagen);
                }
            }

            // Elimina la portada de la película
            if ($pelicula->portada != 'portada.png') {
                Storage::disk('portadas')->delete($pelicula->portada);
            }

            // El reparto y staff se elimina automáticamente
            // onDelete->('cascade')
            $pelicula->delete();
            return response()->json(['code'=>204,'message'=>'Se ha eliminado correctamente la película.'],204);
        }
    }

    public function eliminarImagen(Request $request, $id)
    {

        $pelicula = Pelicula::find($id);
        $imagenes = json_decode($pelicula->imagenes);
        $nuevasImagenes = array();

        foreach ($imagenes as $imagen) {
            if ($imagen != $request->all()['idImagen']) {
                array_push($nuevasImagenes, $imagen);
            }
        }

        $pelicula->imagenes = $nuevasImagenes;
        $pelicula->save();
        if(Storage::disk('imagenes')->delete($request->all()['idImagen']))
            return response()->json(['code'=>204,'message'=>'Se ha eliminado correctamente la imagen.'],204);
        else
            return response()->json(['code'=>404,'message'=>'No se ha encontrado la imagen.'],404);
    }

    public function getIndex()
    {
        $ultimas =  Pelicula::where('finalizada','1')
        ->orderBy('id','desc')
        ->limit(4)
        ->get();

        $mejorValoradas = DB::table('peliculas as p')
        ->join('valoraciones as v','p.id','=','v.pelicula_id')
        ->groupBy('p.id')
        ->select('p.id', 'p.titulo', 'p.portada', DB::raw('AVG(nota) as nota'))
        ->orderBy('nota','desc')
        ->where('finalizada','=','1')
        ->limit(4)
        ->get();

        return view('main.index')->with(compact('ultimas', 'mejorValoradas'));
    }

    public function getPelicula($idPelicula)
    {
        $pelicula = Pelicula::find($idPelicula);
        return view('main.pelicula')->with(compact('pelicula'));
    }

    public function getEditarPelicula($idPelicula)
    {
        $pelicula = Pelicula::find($idPelicula);
        return view('main.editarpelicula')->with(compact('pelicula'));
    }

    public function getBusqueda(Request $request)
    {
        $validation = $request->validate([
            'busqueda' => 'required|string'
        ]);

        $peliculas = DB::table('peliculas as p')
        ->select('p.id', 'p.titulo', 'p.portada')
        ->where('p.titulo','LIKE','%'.$validation['busqueda'].'%')
        ->orderBy('titulo')
        ->get();

        $personas = DB::table('personas as p')
        ->select('p.id', 'p.nombre')
        ->where('p.nombre','LIKE','%'.$validation['busqueda'].'%')
        ->orderBy('nombre')
        ->get();

        return view('main.busqueda')->with(compact('peliculas','personas'));
    }



    // Métodos API

    public function getPeliculaTitulo(Request $request)
    {
        // Puede darse el caso de que existan varias películas con el mismo nombre.
        // Por ejemplo, se puede hacer un remake de una película antigua.
        // Dado que por lo general esto no sucede, y se suele querer obtener
        // la más reciente, devuelve la última en ser subida.

        $validation = $request->validate([
            'titulo' => 'required|string'
        ]);

        $pelicula = Pelicula::select('*')
        ->where([
            ['finalizada','1'],
            ['titulo', $validation['titulo']]
        ])
        ->orderBy('id','desc')
        ->limit(1)
        ->get()[0];

        $categoria = $pelicula->stringCategorias;
        $nota = $pelicula->media;

        return compact('pelicula','categoria','nota');
    }

    public function getUltimasPeliculas()
    {
        $peliculas = DB::table('peliculas as p')
        ->select('p.*')
        ->where('finalizada','=','1')
        ->orderBy('id','desc')
        ->limit(5)
        ->get();

        return $peliculas;
    }

    public function getMejorValoradas()
    {
        $peliculas = DB::table('peliculas as p')
        ->join('valoraciones as v','p.id','=','v.pelicula_id')
        ->groupBy('p.id')
        ->select('p.*', DB::raw('AVG(nota) as nota'))
        ->orderBy('nota','desc')
        ->where('finalizada','=','1')
        ->limit(5)
        ->get();

        return $peliculas;
    }

    public function getPeliculaAleatoria()
    {
        $pelicula = Pelicula::select('*')
        ->where('finalizada','1')
        ->inRandomOrder()
        ->limit(1)
        ->get()[0];

        $categoria = $pelicula->stringCategorias;
        $nota = $pelicula->media;

        return compact('pelicula','categoria','nota');
    }
}


function limpiarDatos($datos) {
    foreach ($datos as $dato) {
        if (!is_array($dato)) {
            $dato = e($dato);
        }
    }
    return $datos;
}