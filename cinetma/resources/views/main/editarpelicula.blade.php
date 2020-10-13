@extends('layouts.main')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/editarpelicula.css') }}">
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    token = "{{ csrf_token() }}";
</script>
<script src="{{ asset('js/editarpelicula.js') }}"></script>
@endsection

@section('content')


<!-- Película -->
<section id="nuevapelicula">
    <div class="container my-5" id="main">
        <form method="post" action="https://cinetma.myftp.org/editarpelicula/{{$pelicula->id}}" id="form" name="form" enctype="multipart/form-data">
            @csrf
            <div class="col-12 tituloPelicula text-center my-4">
                <label for="titulo"><h3>Título de la película*</h3></label><br/>
                <input type="text" id="titulo" name="titulo" class="@error('titulo') is-invalid @enderror input-estilo" placeholder="Introduce el título de la película." value="{{ $pelicula->titulo }}" autocomplete="off" required>
                @error('titulo')
                <div class="text-center">
                    <span class="text-muted" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                </div>
                @enderror
            </div>
            <hr class="divider my-4" />
            <div class="row">
                <div class="col-12 col-lg-6 align">
                    <div class="portadaPelicula text-center my-auto">
                        <h5 class="mt-lg-5">Foto de portada</h5>
                        <br/>
                        <div class="portadaPelicula text-center">
                            <img src="{{ asset('storage/portadas/'.$pelicula->portada)}}" alt="Imagen de portada" class="w-50 mw-100">
                        </div>
                        <p class="text-muted mt-3">Introduce otra imagen de portada si la deseas reemplazar.</p>
                        <input type="file" id="portada" name="portada" class="w-75 @error('portada') is-invalid @enderror">
                        @error('portada')
                        <div class="text-center">
                            <span class="text-muted" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="d-flex  mt-4 mt-lg-0 text-center justify-content-center align-items-center h-100">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group text-center text-sm-left">
                                                    <label for="finalizada" class="col-sm-4">Estado*</label>
                                                    <select class="col-7 form-control d-inline-block input-estilo mx-auto rounded-0 @error('finalizada') is-invalid @enderror" id="finalizada" name="finalizada" required>
                                                        <option value="1" @if ($pelicula->finalizada == 1) selected @endif>Finalizada</option>
                                                        <option value="0"@if ($pelicula->finalizada == 0) selected @endif>En producción</option>
                                                    </select>
                                                    @error('finalizada')
                                                    <div class="text-center">
                                                        <span class="text-muted" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group text-center text-sm-left">
                                                    <label for="duracion" class="col-sm-4">Duracion*</label>
                                                    <input id="duracion" name="duracion" class="col-7 input-estilo mx-auto @error('duracion') is-invalid @enderror" type="number" placeholder="Minutos" value="{{$pelicula->duracion}}">
                                                </div>
                                                @error('duracion')
                                                <div class="text-center">
                                                    <span class="text-muted" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group text-center text-sm-left">
                                                    <label for="nombre" class="col-sm-4">Fecha de lanzamiento</label>
                                                    <input id="fechaLanzamiento" name="fechaLanzamiento" class="col-7 input-estilo mx-auto @error('fechaLanzamiento') is-invalid @enderror" type="date" value="{{ $pelicula->fechaLanzamiento }}">
                                                </div>
                                                @error('fechaLanzamiento')
                                                <div class="text-center">
                                                    <span class="text-muted" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group text-center text-sm-left d-sm-flex align-items-center">
                                                    <label for="categoria" class="col-sm-4">Categoría*</label>
                                                    <select class="col-7 form-control d-inline-block input-estilo mx-auto m-sm-0 ml-sm-1 rounded-0 @error('categoria.*') is-invalid @enderror" id="categoria" name="categoria[]" required multiple>
                                                        <option value="Drama" @if (in_array("Drama", $pelicula->arrayCategorias)) selected @endif>Drama</option>
                                                        <option value="Terror" @if (in_array("Terror", $pelicula->arrayCategorias)) selected @endif>Terror</option>
                                                        <option value="Romance" @if (in_array("Romance", $pelicula->arrayCategorias)) selected @endif>Romance</option>
                                                        <option value="Acción" @if (in_array("Acción", $pelicula->arrayCategorias)) selected @endif>Acción</option>
                                                        <option value="Comedia" @if (in_array("Comedia", $pelicula->arrayCategorias)) selected @endif>Comedia</option>
                                                        <option value="Ciencia ficción" @if (in_array("Ciencia ficción", $pelicula->arrayCategorias)) selected @endif>Ciencia ficción</option>
                                                        <option value="Suspense" @if (in_array("Suspense", $pelicula->arrayCategorias)) selected @endif>Suspense</option>
                                                    </select>
                                                </div>
                                                @error('categoria.*')
                                                <div class="text-center">
                                                    <span class="text-muted" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <h3 class="text-center">Descripción breve*</h3>
                    <hr class="divider my-4" />
                    <div class=" mx-auto text-center">
                        <textarea name="descripcion" id="descripcion" rows="4" class="text-left @error('descripcion') is-invalid @enderror" placeholder="Introduce una descripción breve de la película." maxlength="255" style="resize:none" required>{{$pelicula->descripcion}}</textarea>
                    </div>
                    @error('descripcion')
                    <div class="text-center">
                        <span class="text-muted" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    </div>
                    @enderror
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <h3 class="text-center">Sinopsis*</h3>
                    <hr class="divider my-4" />
                    <div class=" mx-auto text-center">
                        <textarea id="sinopsis" name="sinopsis" rows="10" class="text-left @error('sinopsis') is-invalid @enderror" placeholder="Introduce la sinopsis de la película." required>{{$pelicula->sinopsis}}</textarea>
                    </div>
                    @error('sinopsis')
                    <div class="text-center">
                        <span class="text-muted" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    </div>
                    @enderror
                </div>
            </div>
            <div class="row mt-lg-5">
                <div class="col-12 col-lg-6 mt-5 mt-lg-0 px-0">
                    <h3 class="text-center">Trailer</h3>
                    <hr class="divider my-4" />
                    <div class="d-flex flex-column align-items-center">
                        <div class="w-75 text-center">
                            <div class="text-center mt-2 video-container">
                                <iframe src="https://www.youtube.com/embed/{{ $pelicula->trailerId}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <input type="url" id="trailer" name="trailer" class="input-esilo text-left mt-4 @error('trailer') is-invalid @enderror" value="{{$pelicula->trailer}}">
                            <p class="text-muted mt-1">El trailer debe ser de youtube.</p>
                        </div>
                    </div>
                    @error('trailer')
                    <div class="text-center">
                        <span class="text-muted" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    </div>
                    @enderror
                </div>
                <div class="col-12 col-lg-6 mt-5 mt-lg-0 px-0 text-center">
                    <h3 class="text-center">Imágenes</h3>
                    <hr class="divider my-4" />
                    <div class="container">
                        <div class="row" class="mt-lg-4">
                            <div class="col-12 mt-lg-4">
                                <div class="container">
                                    <div class="row justify-content-center" id="imagenesActuales">
                                        <div class="col-12 mt-2">
                                            <p>Imágenes actuales:</p>
                                        </div>
                                        @if (sizeof($pelicula->arrayImagenes) > 0)
                                        @for ($i = 0; $i < sizeof($pelicula->arrayImagenes); $i++)
                                        <div class="col-4 col-md-3 mt-2 imagenGuardada">
                                            <div class="card w-100  rounded-0">
                                                <img class="card-img-top rounded-0" src="{{ asset('storage/imagenes/'. e($pelicula->arrayImagenes[$i]) ) }}" alt="Imagen">
                                                <div class="card-body">
                                                    <p class="card-text">
                                                        <a id="{{$pelicula->arrayImagenes[$i]}}" href="#" class="btn bg-primary eliminarImagen"><i class="fas fa-trash-alt" alt="eliminar imagen"></i></a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        @endfor
                                        @else
                                        <div class="col-12 mt-2">
                                            <p class="text-center">No hay imágenes.</p>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                <input type="file" id="imagenes" name="imagenes[]" class="mt-lg-4 w-75 @error('imagenes.*') is-invalid @enderror" accept=".jpeg, .jpg, .png, .webp" multiple>
                                @error('imagenes.*')
                                <div class="text-center">
                                    <span class="text-muted" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                </div>
                                @enderror
                                <p class="mt-4 text-muted">Puedes seleccionar las fotos y arrastrarlas al botón.</p>
                                <p class="text-muted">Existe un máximo de 4 imágenes.</p>
                                <p class="text-muted">Formatos válidos: png, jpg, jpeg, webp</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12 text-center">
                    <h3 class="text-center">Reparto</h3>
                    <hr class="divider my-4"/>
                    <p class="text-muted">Los papeles que representan los actores son optativos.</p>
                </div>
            </div>
            <div class="row mt-5 form-group">
                <label for="naReparto" class="col-sm-2">Nombre y Apellidos</label>
                <div class="col-sm-10 text-center">
                    <input type="text" id="naReparto" class="form-control rounded-0 @error('reparto.nombre.*') is-invalid @enderror" placeholder="Nombre y Apellidos" autocomplete="off">
                    @error('reparto.nombre.*')
                    <div class="text-center">
                        <span class="text-muted" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    </div>
                    @enderror
                </div>
            </div>
            <div class="row form-group">
                <label for="papel" class="col-sm-2">Papel</label>
                <div class="col-sm-10 text-center">
                    <input type="text" id="papel" class="form-control rounded-0 @error('reparto.papel.*') is-invalid @enderror" placeholder="Papel" autocomplete="off">
                    @error('reparto.papel.*')
                    <div class="text-center">
                        <span class="text-muted" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    </div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col text-right">
                    @error('repartoEliminado.*')
                    <div class="text-center">
                        <span class="text-muted" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    </div>
                    @enderror
                    <a href="#" id="añadirReparto" class="btn btn-secondary">Añadir</a>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <table class="table table-md text-center w-auto mx-auto" id="tablaReparto">
                        <thead>
                            <tr scope="row">
                                <th scope="col">Nombre</th>
                                <th scope="col">Papel</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="reparto">
                            @if (sizeof($pelicula->actuaciones) > 0)

                            @foreach($pelicula->actuaciones as $actor)
                            <tr>
                                <th scope="row">
                                    {{$actor->nombre}}
                                </th>
                                <td>
                                    {{$actor->pivot->papel}}
                                </td>
                                <td style="width:35px">
                                    <input type="hidden" value="{{$actor->id}}">
                                    <button class="btn btn-outline-primary rounded-0 eliminarRepartoGuardado" type="button">x</button>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-12 text-center">
                    <h3 class="text-center">Equipo técnico</h3>
                    <hr class="divider my-4"/>
                    <p class="text-muted">Los roles que desempeñan los miembros del equipo técnico son obligatorios.</p>
                </div>
            </div>
            <div class="row mt-5 form-group">
                <label for="naStaff" class="col-sm-2">Nombre y Apellidos</label>
                <div class="col-sm-10 text-center">
                    <input type="text" id="naStaff" class="form-control rounded-0 @error('staff.nombre.*') is-invalid @enderror" placeholder="Nombre y Apellidos" autocomplete="off">
                    @error('staff.nombre.*')
                    <div class="text-center">
                        <span class="text-muted" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    </div>
                    @enderror
                </div>
            </div>
            <div class="row form-group">
                <label for="rol" class="col-sm-2">Rol</label>
                <div class="col-sm-10 text-center">
                    <input type="text" id="rol" class="form-control rounded-0 @error('staff.rol.*') is-invalid @enderror" placeholder="Rol" autocomplete="off">
                    @error('staff.rol.*')
                    <div class="text-center">
                        <span class="text-muted" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    </div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col text-right">
                    @error('staffEliminado.*')
                    <div class="text-center">
                        <span class="text-muted" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    </div>
                    @enderror
                    <a href="#" id="añadirStaff" class="btn btn-secondary">Añadir</a>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <table class="table table-md text-center w-auto mx-auto" id="tablaStaff">
                        <thead>
                            <tr scope="row">
                                <th scope="col">Nombre</th>
                                <th scope="col">Rol</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="staff">
                            @if (sizeof($pelicula->producciones) > 0)
                            @foreach($pelicula->producciones as $miembroStaff)
                            <tr>
                                <th scope="row">
                                    {{$miembroStaff->nombre}}
                                </th>
                                <td>
                                    {{$miembroStaff->pivot->rol}}
                                </td>
                                <td style="width:35px">
                                    <input type="hidden" value="{{$miembroStaff->id}}">
                                    <button class="btn btn-outline-primary rounded-0 eliminarStaffGuardado" type="button">x</button>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12 tituloPelicula text-center my-4">
                    <label for="donacion"><h3>Enlace para donaciones</h3></label><br/>
                    <input type="url" id="donacion" name="donacion" class="input-estilo @error('donacion') is-invalid @enderror" placeholder="Introduce la URL para realizar la donación." value="{{ $pelicula->donacion }}" autocomplete="off">
                    @error('donacion')
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center">
                                <span class="text-muted" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </div>
                        </div>
                    </div>
                    @enderror
                    <p class="text-muted mt-3">En caso de que la película esté en producción, puedes añadir un enlace para que los usuarios puedan aportar dinero a la producción de la película.</p>
                </div>
                @error('donacion')
                <div class="row">
                    <div class="col-12">
                        <div class="text-center">
                            <span class="text-muted" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        </div>
                    </div>
                </div>
                @enderror
            </div>
            <div class="container">
                <div class="row mt-lg-5">
                    <div class="col-12 text-center">
                        <hr class="divider my-4" />
                        <input type="submit" value="Guardar" id="botonEnviar">
                        <p class="text-center">Los campos que contienen un asterisco (*) deben ser completados obligatoriamente.</p>
                        <p class="text-center">En caso de que se cometa un error en la edición de los campos, se indicará el mismo pero los campos serán reseteados.</p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>


@endsection