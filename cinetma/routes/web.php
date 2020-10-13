<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Inicio
Route::get('/', 'PeliculaController@getIndex')
->name('index');


// Películas
Route::get('peliculas', function() {
	return view('main.peliculas');
})
->name('peliculas');


Route::get('produccion', function() {
    return view('main.produccion');
})->name('produccion');


Route::get('pelicula/{id}', 'PeliculaController@getPelicula')
->name('pelicula')
->middleware('pelicula');


Route::post('/nuevapelicula', 'PeliculaController@store')
->name('nuevapelicula')
->middleware('roles');


Route::get('editarpelicula/{id}', 'PeliculaController@getEditarPelicula')
->name('editarpelicula')
->middleware('auth')
->middleware('pelicula')
->middleware('roles');


Route::post('/editarpelicula/{id}', 'PeliculaController@updatePost')
->name('editarpelicula')
->middleware('pelicula')
->middleware('roles');

Route::post('eliminarpelicula/{id}','PeliculaController@destroy')
->middleware('auth')
->middleware('pelicula')
->middleware('roles');

Route::post('/eliminarimagen/{id}', 'PeliculaController@eliminarImagen')
->name('eliminarimagen')
->middleware('auth')
->middleware('pelicula')
->middleware('roles')
;


// Valoraciones
Route::post('valoracion','ValoracionController@store')
->middleware('auth');

Route::post('buscarValoracion', 'ValoracionController@buscarValoracion')
->middleware('auth');

Route::post('eliminarValoracion','ValoracionController@destroy')
->middleware('auth');

// Búsqueda y Personas
Route::get('search', 'PeliculaController@getBusqueda')
->name('busqueda');

Route::get('persona/{id}', 'PersonaController@getPersona')
->name('persona');


// Perfil y derivados de roles
Route::get('perfil', function() {
	return view('main.perfil');
})->name('perfil')
->middleware('auth');


Route::get('nuevapelicula', function() {
	return view('main.nuevapelicula');
})->name('nuevapelicula')
->middleware('auth')
->middleware('roles');

Route::get('mispeliculas', function() {
	return view('main.mispeliculas');
});

Route::post('mispeliculas', 'UsuarioPeliculaController@listarPeliculasUsuario')
->name('mispeliculas')
->middleware('auth')
->middleware('roles');

Route::resource('usuario','UserController')
->only('destroy')
->middleware('auth');


// Seguridad
Auth::routes();


Route::get('forgotpassword', function() {
	return view('main.forgotpassword');
})->name('forgotpassword');