<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UsuarioPeliculaController extends Controller
{
	public function listarPeliculasUsuario()
	{
		$peliculasPorPagina = 10;

		$peliculas = DB::table('peliculas as p')
		->where('user_id','=',Auth::id())
		->orderBy('id', 'desc')
		->paginate($peliculasPorPagina);

		return $peliculas;
	}
}