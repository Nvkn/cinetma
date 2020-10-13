<?php

namespace App\Http\Middleware;

use Closure;
use App\Pelicula;

class ComprobarPelicula
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($pelicula = Pelicula::find($request->route()->parameters()['id'])) {
            return $next($request);
        }
        return redirect()->route('index');
    }
}
