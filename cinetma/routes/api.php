<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('listarpeliculas/{tipo?}', 'PeliculaController@listarPeliculas')
->name('listarpeliculas');

Route::post('/editarusuario', 'UserController@editarusuario')
->name('editarusuario');

Route::post('/peliculaTitulo', 'PeliculaController@getPeliculaTitulo')
->name('peliculaTitulo');

Route::post('/ultimasPeliculas', 'PeliculaController@getUltimasPeliculas')
->name('ultimaspeliculas');

Route::post('/mejorValoradas', 'PeliculaController@getmejorValoradas')
->name('mejorvaloradas');

Route::post('/peliculaAleatoria', 'PeliculaController@getpeliculaAleatoria')
->name('peliculaaleatoria');