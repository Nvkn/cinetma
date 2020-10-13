@extends('layouts.main')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/busqueda.css') }}">
@endsection


@section('content')

<!-- Búsqueda-->

<section id="tabs">
    <div class="container pt-5">

        <div class="row">
            <div class="col-12">
                <nav>
                    <div class="nav nav-tabs nav-fill row" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link text-dark col-6 active" id="peliculas-tab" data-toggle="tab" href="#peliculas" role="tab" aria-controls="nav-peliculas" aria-selected="true">Películas</a>
                        <a class="nav-item nav-link text-dark col-6" id="personas-tab" data-toggle="tab" href="#personas" role="tab" aria-controls="nav-personas" aria-selected="false">Personas</a>
                    </div>
                </nav>
                <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="peliculas" role="tabpanel" aria-labelledby="peliculas-tab">
                        <div class="row pt-3 d-flex align-items-center justify-content-center">
                            <div class="col-md-7">
                                <table class="table">
                                    <tbody class="text-center">
                                        @if(sizeof($peliculas) == 0)
                                        <tr>
                                            <td scope="row" class="align-middle">No existen películas que coincidan con la búsqueda.</td>
                                        </tr>
                                        @else
                                        @foreach($peliculas as $pelicula)
                                        <tr>
                                            <td scope="row"><a href="pelicula/{{$pelicula->id}}"><img src="{{asset('storage/portadas/'.$pelicula->portada)}}" alt="Portada" class="portada"></a></td>
                                            <td class="align-middle"><a href="pelicula/{{$pelicula->id}}" class="text-dark">{{$pelicula->titulo}}</a></td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="personas" role="tabpanel" aria-labelledby="personas-tab">
                        <div class="row pt-3 d-flex align-items-center justify-content-center">
                            <div class="col-md-7">
                                <table class="table">
                                    <tbody class="text-center">
                                        @if(sizeof($personas) == 0)
                                        <tr>
                                            <td scope="row" class="align-middle">No existen personas que coincidan con la búsqueda.</td>
                                        </tr>
                                        @else
                                        @foreach($personas as $persona)
                                        <tr>
                                            <td class="align-middle"><a href="persona/{{$persona->id}}" class="text-dark">{{$persona->nombre}}</a></td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection