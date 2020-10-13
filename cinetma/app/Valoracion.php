<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Valoracion extends Model
{
    public $table = "valoraciones";

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['nota', 'pelicula_id', 'user_id'];

    public function pelicula()
    {
        return $this->belongsTo('App\Pelicula');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}