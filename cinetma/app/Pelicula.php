<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo', 'descripcion', 'sinopsis', 'fechaLanzamiento', 'portada', 'trailer', 'imagenes', 'duracion', 'finalizada', 'donacion', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function actuaciones()
    {
        return $this->belongsToMany('App\Persona', 'actuaciones')->withPivot('papel');
    }

    public function producciones()
    {
        return $this->belongsToMany('App\Persona', 'producciones')->withPivot('rol');
    }

    public function categorias()
    {
        return $this->belongsToMany('App\Categoria');
    }

    public function valoraciones()
    {
        return $this->hasMany('App\Valoracion');
    }

    public function getStringCategoriasAttribute()
    {
        $categorias = $this->categorias()->get();
        $stringCategorias = "";
        for ($i=0; $i < sizeof($categorias); $i++) {
            if ($i == sizeof($categorias)-1) {
                $stringCategorias = $stringCategorias.$categorias[$i]->categoria;
            }
            else {
                $stringCategorias = $stringCategorias.$categorias[$i]->categoria . ', ';
            }
        }
        return $stringCategorias;
    }

    public function getExistenPapelesAttribute()
    {
        $existenPapeles = false;
        foreach($this->actuaciones as $actor)
        {
            if($actor->pivot->papel)
                $existenPapeles = true;
        }
        return $existenPapeles;
    }

    public function getMediaAttribute()
    {
        $media = null;
        $valoraciones = $this->valoraciones()->get();
        if(sizeof($valoraciones) != 0) {
            $total = 0;
            for($i=0; $i<sizeof($valoraciones); $i++)
            {
                $total += $valoraciones[$i]->nota;
            }
            $media = round($total / sizeof($valoraciones),2);
        }
        return $media;
    }

    public function getArrayCategoriasAttribute()
    {
        $categorias = $this->categorias()->get();
        $arrayCategorias = [];
        foreach ($categorias as $categoria) {
            array_push($arrayCategorias, $categoria->categoria);
        }
        return $arrayCategorias;
    }

    public function getTrailerIdAttribute()
    {
        $url = $this->trailer;
        $urlLarga = preg_match('/watch/', $url, $matches);
        $trailerId = null;
        if ($urlLarga)
        {
            $parametrosUrl = explode('&', explode('v=', $url)[1]);
            $trailerId = $parametrosUrl[0];
        }
        else
        {
            $urlPartes = explode('/', $url);
            $trailerId = $urlPartes[sizeof($urlPartes) - 1];
        }
        return $trailerId;
    }

    public function getArrayImagenesAttribute()
    {
        if (json_decode($this->imagenes))
            $imagenes = json_decode($this->imagenes);
        else $imagenes = [];
        return $imagenes;
    }

}
