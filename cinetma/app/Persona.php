<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
	protected $fillable = [
		'nombre'
	];

    public function actuaciones()
    {
        return $this->belongsToMany('App\Pelicula', 'actuaciones')->withPivot('papel');
    }

    public function producciones()
    {
        return $this->belongsToMany('App\Pelicula', 'producciones')->withPivot('rol');
    }
}
