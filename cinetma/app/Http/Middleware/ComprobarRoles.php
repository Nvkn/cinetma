<?php

namespace App\Http\Middleware;

use Closure;
use App\Pelicula;
use App\User;
use Illuminate\Support\Facades\Auth;

class ComprobarRoles
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
        if (Auth::user()->mod) {
            return $next($request);
        }
        else if (Auth::user()->colab) {
            if (isset($request->route()->parameters()['id'])) {
                if ($pelicula = Pelicula::find($request->route()->parameters()['id'])) {
                    if ($pelicula->user_id == Auth::id()) {
                        return $next($request);
                    }
                    else
                        return redirect()->route('index');
                }
                else
                    return redirect()->route('index');
            }
            else
                return $next($request);
        }
        else
            return redirect()->route('index');
    }
}
