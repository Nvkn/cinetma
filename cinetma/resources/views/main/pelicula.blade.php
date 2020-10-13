@extends('layouts.main')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/pelicula.css') }}">
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    token = "{{ csrf_token() }}";
    user = "{{Auth::id()}}";
    pelicula_id = "{{$pelicula->id}}";
</script>
<script src="{{ asset('js/pelicula.js') }}"></script>

@endsection


@section('content')

<!-- Película -->
<section id="pelicula" class="mt-5">
    <div class="container my-5" id="main">
        <div class="col-12 tituloPelicula text-center my-4">
            <h1>{{ $pelicula->titulo }}</h1>
        </div>
        <hr class="divider my-4" />
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="portadaPelicula text-center">
                    <img src="{{ asset('storage/portadas/'.$pelicula->portada)}}" alt="Imagen de portada" class="w-50 mw-100">
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="d-flex mt-4 mt-lg-0 text-center justify-content-center align-items-center h-100">
                    <div class="row">
                        <div class="col-12">
                            @if ($pelicula->stringCategorias)
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-center mt-sm-3">
                                        <h4>Categoría</h4>
                                        <p>{{$pelicula->stringCategorias}}</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if ($pelicula->duracion)
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-center mt-sm-3">
                                        <h4>Duración</h4>
                                        <p>{{$pelicula->duracion}} minutos</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if ($pelicula->fechaLanzamiento)
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-center mt-sm-3">
                                        <h4>Fecha de lanzamiento</h4>
                                        <p>{{$pelicula->fechaLanzamiento}}</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if ($pelicula->finalizada)
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-center mt-sm-3">
                                        @if($pelicula->media)
                                        <h3><i class="fas fa-star text-warning"></i>{{$pelicula->media}}</h3>
                                        @else
                                        <p>No existen valoraciones</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-center text-sm mt-sm-3">
                                        <button class="btn btn-secondary" id="añadirValoracion">Añadir reseña</button>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12">
                <h3 class="text-center">Sinopsis</h3>
                <hr class="divider my-4" />
                <div id="sinopsis" class="mx-auto mt-3 text-justify p-3 p-lg-0 w-md-75">
                    <p>{{ $pelicula->sinopsis }}</p>
                </div>
            </div>
        </div>
        <div class="row mt-lg-5">
            <div class="col-12 col-lg-6 mt-3 mt-lg-0 px-0">
                <h3 class="text-center">Trailer</h3>
                <hr class="divider my-4" />
                <div class="d-flex flex-column align-items-center">
                    <div class="w-75 mt-2">
                        <div class="text-center mt-4 video-container">
                            <iframe src="https://www.youtube.com/embed/{{ $pelicula->trailer_id }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 mt-5 mt-lg-0 px-0">
                <h3 class="text-center">Imágenes</h3>
                <hr class="divider my-4" />
                <div class="d-flex flex-column align-items-center">
                    <div class="w-75 mt-4" id="carousel">
                        @if (sizeof($pelicula->arrayImagenes) > 0)
                        <div id="carouselImagenes" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @for ($i = 0; $i < sizeof($pelicula->arrayImagenes); $i++)
                                @if ($i == 0)
                                <div class="carousel-item h-auto active">
                                    <img class="d-block w-100" src="{{ asset('storage/imagenes/'. e($pelicula->arrayImagenes[$i]) ) }}" alt="First slide">
                                </div>
                                @else
                                <div class="carousel-item h-auto">
                                    <img class="d-block w-100" src="{{ asset('storage/imagenes/'. e($pelicula->arrayImagenes[$i]) ) }}" alt="First slide">
                                </div>
                                @endif
                                @endfor
                            </div>

                            @if (sizeof($pelicula->arrayImagenes) != 1)
                            <a class="carousel-control-prev" href="#carouselImagenes" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselImagenes" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                            @endif
                        </div>
                        @else
                        <p class="text-center">No hay imágenes.</p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
        @if (sizeof($pelicula->actuaciones) > 0 || sizeof($pelicula->producciones) > 0)
        <div class="row mt-4 mt-lg-5">
            <div class="col-12">
                <div class="container">
                    <div class="row mt-lg-5">
                        @if (sizeof($pelicula->actuaciones) > 0)
                        <div class="col-12 col-lg-6 mt-5">
                            <h3 class="text-center">Reparto</h3>
                            <hr class="divider my-4" />
                            <table class="table table-md text-center w-auto mx-auto">
                                <thead>
                                    <tr>
                                        <th scope="col">Nombre</th>
                                        @if($pelicula->existenPapeles)<th scope="col">Papel</th>@endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pelicula->actuaciones as $actor)
                                    <tr>
                                        <td><a class="text-dark" target="_blank" href="https://cinetma.myftp.org/persona/{{$actor->id}}">{{$actor->nombre}}</a></td>
                                        @if($pelicula->existenPapeles)<td>{{$actor->pivot->papel}}</td>@endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                        @if (sizeof($pelicula->producciones) > 0)
                        <div class="col-12 col-lg-6 mt-5">
                            <h3 class="text-center">Equipo técnico</h3>
                            <hr class="divider my-4" />
                            <table class="table table-md text-center w-auto mx-auto">
                                <thead>
                                    <tr>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Rol</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pelicula->producciones as $miembroStaff)
                                    <tr>
                                        <td><a class="text-dark" target="_blank" href="https://cinetma.myftp.org/persona/{{$miembroStaff->id}}">{{$miembroStaff->nombre}}</a></td>
                                        <td>{{$miembroStaff->pivot->rol}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if(!$pelicula->finalizada)
        <div class="row mt-5">
            <div class="col-12 tituloPelicula text-center my-4">
                <label for="donacion"><h3>Donaciones</h3></label><br/>
                <p>Si deseas contribuír en la producción de esta película, puedes realizar tu donación haciendo click <a href="{{ $pelicula->donacion }}" target="_blank" class="text-primary">aquí</a>.</p>
            </div>
        </div>
        @endif
    </div>
</section>


@endsection