@extends('layouts.main')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/nuevapelicula.css') }}">
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="{{ asset('js/nuevapelicula.js') }}"></script>
@endsection

@section('content')


<!-- Película -->
<section id="nuevapelicula">
    <div class="container my-5" id="main">
        <form method="POST" action="https://cinetma.myftp.org/nuevapelicula" id="form" name="form" enctype="multipart/form-data">
            @csrf
            <div class="col-12 tituloPelicula text-center my-4">
                <label for="titulo"><h3>Título de la película*</h3></label><br/>
                <input type="text" id="titulo" name="titulo" class="@error('titulo') is-invalid @enderror input-estilo" placeholder="Introduce el título de la película." value="{{ old('titulo') }}" autocomplete="off" required>
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
                        <input type="file" id="portada" name="portada" class="@error('portada') is-invalid @enderror">
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
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group text-center text-sm-left">
                                            <label for="finalizada" class="col-sm-4">Estado*</label>
                                            <select class="col-7 form-control d-inline-block input-estilo mx-auto rounded-0 @error('finalizada') is-invalid @enderror" id="finalizada" name="finalizada" value="{{ old('finalizada') }}" required>
                                                <option value="1" selected id="finalizada">Finalizada</option>
                                                <option value="0" @if(old('finalizada')==0) selected @endif id="enProduccion">En producción</option>
                                            </select>
                                        </div>
                                        @error('finalizada')
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
                                            <label for="duracion" class="col-sm-4">Duracion</label>
                                            <input id="duracion" name="duracion" class="col-7 input-estilo mx-auto @error('duracion') is-invalid @enderror" type="number" value="{{ old('duracion') }}" placeholder="Minutos">
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
                                        <div class="form-group text-center text-sm-left d-sm-flex align-items-center">
                                            <label for="categoria" class="col-sm-4">Categoría*</label>
                                            <select class="col-7 form-control d-inline-block input-estilo mx-auto m-sm-0 ml-sm-1 rounded-0 @error('categoria') is-invalid @enderror" id="categoria" name="categoria[]" required multiple>
                                                <option value="Drama" @if(old('categoria'))@if(in_array("Drama", old('categoria'))) selected @endif @endif>Drama</option>
                                                <option value="Terror" @if(old('categoria'))@if(in_array("Terror", old('categoria'))) selected @endif @endif>Terror</option>
                                                <option value="Romance" @if(old('categoria'))@if(in_array("Romance", old('categoria'))) selected @endif @endif>Romance</option>
                                                <option value="Acción" @if(old('categoria'))@if(in_array("Acción", old('categoria'))) selected @endif @endif>Acción</option>
                                                <option value="Comedia" @if(old('categoria'))@if(in_array("Comedia", old('categoria'))) selected @endif @endif>Comedia</option>
                                                <option value="Ciencia ficción" @if(old('categoria'))@if(in_array("Ciencia ficción", old('categoria'))) selected @endif @endif>Ciencia ficción</option>
                                                <option value="Suspense" @if(old('categoria'))@if(in_array("Suspense", old('categoria'))) selected @endif @endif>Suspense</option>
                                            </select>
                                        </div>
                                        @error('categoria')
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
                                            <label for="fechaLanzamiento" class="col-sm-4">Fecha de lanzamiento</label>
                                            <input id="fechaLanzamiento" name="fechaLanzamiento" class="col-7 input-estilo mx-auto @error('fechaLanzamiento') is-invalid @enderror" value="{{ old('fechaLanzamiento') }}" type="date">
                                            <p class="text-muted mt-1">Si está finalizada, debes introducir su fecha de lanzamiento.</p>
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
                        <textarea name="descripcion" id="descripcion" rows="4" class="text-left @error('descripcion') is-invalid @enderror" placeholder="Introduce una descripción breve de la película." maxlength="255" style="resize:none" required>{{ old('descripcion') }}</textarea>
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
                        <textarea id="sinopsis" name="sinopsis" rows="10" class="text-left @error('sinopsis') is-invalid @enderror" placeholder="Introduce la sinopsis de la película." required>{{ old('sinopsis') }}</textarea>
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
                <div class="col-12 col-lg-6 mt-3 mt-lg-0 px-0">
                    <h3 class="text-center">Trailer</h3>
                    <hr class="divider my-4" />
                    <div class="d-flex flex-column align-items-center">
                        <div class="w-75 mt-2 text-center">
                            <p>Introduce la URL del vídeo de youtube.</p>
                            <input type="url" id="trailer" name="trailer" value="{{ old('trailer') }}" class="input-esilo text-left @error('trailer') is-invalid @enderror"  autocomplete="off">
                        </div>
                        @error('trailer')
                        <div class="text-center">
                            <span class="text-muted" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-lg-6 mt-5 mt-lg-0 px-0 text-center">
                    <h3 class="text-center">Imágenes</h3>
                    <hr class="divider my-4" />
                    <input type="file" id="imagenes" name="imagenes[]" class="mt-lg-4 @error('imagenes') is-invalid @enderror" accept=".jpeg, .jpg, .png, .webp" multiple>
                    @error('imagenes')
                    <div class="text-center">
                        <span class="text-muted" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    </div>
                    @enderror
                    <p class="mt-2 text-muted">Puedes seleccionar las fotos y arrastrarlas al botón.</p>
                    <p class="text-muted">Existe un máximo de 4 imágenes.</p>
                    <p class="text-muted">Formatos válidos: png, jpg, jpeg, webp</p>
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
                    <input type="text" id="naReparto" class="form-control rounded-0 @error('reparto.nombre') is-invalid @enderror" placeholder="Nombre y Apellidos" autocomplete="off">
                </div>
            </div>
            <div class="row form-group">
                <label for="papel" class="col-sm-2">Papel</label>
                <div class="col-sm-10 text-center">
                    <input type="text" id="papel" class="form-control rounded-0 @error('reparto.papel') is-invalid @enderror" placeholder="Papel" autocomplete="off">
                </div>
            </div>
            @error('reparto')
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
            <div class="row">
                <div class="col text-right">
                    <a href="#" id="añadirReparto" class="btn btn-secondary">Añadir</a>
                </div>
            </div>
            <div class="row mt-5">
                <table id="reparto" class="col-12 table table-sm text-center">
                    @if(old('reparto.nombre'))
                    @for($i=0; $i < sizeof(old('reparto.nombre')); $i++)
                    <tr><th scope="row"><input type="hidden" name="reparto[nombre][]" value="{{old('reparto.nombre')[$i]}}">{{old('reparto.nombre')[$i]}}</th><td><input type="hidden" name="reparto[papel][]" value="{{old('reparto.papel')[$i]}}">{{old('reparto.papel')[$i]}}</td><td style="width:35px"><button class="btn btn-outline-primary rounded-0 eliminarFila" type="button">x</button></td></tr>
                    @endfor
                    @endif
                </table>
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
                    <input type="text" id="naStaff" class="form-control rounded-0 @error('staff.nombre') is-invalid @enderror" placeholder="Nombre y Apellidos" autocomplete="off">
                </div>
            </div>
            <div class="row form-group">
                <label for="rol" class="col-sm-2">Rol</label>
                <div class="col-sm-10 text-center">
                    <input type="text" id="rol" class="form-control rounded-0 @error('staff.rol') is-invalid @enderror" placeholder="Rol" autocomplete="off">
                </div>
            </div>
            @error('staff.nombre')
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
            <div class="row">
                <div class="col text-right">
                    <a href="#" id="añadirStaff" class="btn btn-secondary">Añadir</a>
                </div>
            </div>
            <div class="row mt-5">
                <table id="staff" class="col-12 table table-sm text-center">
                    @if(old('staff.nombre'))
                    @for($i=0; $i < sizeof(old('staff.nombre')); $i++)
                    <tr><th scope="row"><input type="hidden" name="staff[nombre][]" value="{{old('staff.nombre')[$i]}}">{{old('staff.nombre')[$i]}}</th><td><input type="hidden" name="staff[rol][]" value="{{old('staff.rol')[$i]}}">{{old('staff.rol')[$i]}}</td><td style="width:35px"><button class="btn btn-outline-primary rounded-0 eliminarFila" type="button">x</button></td></tr>
                    @endfor
                    @endif
                </table>
            </div>
            <div class="row mt-5">
                <div class="col-12 tituloPelicula text-center my-4">
                    <label for="donacion"><h3>Enlace para donaciones</h3></label><br/>
                    <input type="url" id="donacion" name="donacion" class="input-estilo @error('donacion') is-invalid @enderror" placeholder="Introduce la URL para realizar la donación." value="{{ old('donacion') }}" autocomplete="off">
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
            </div>
            <div class="row mt-lg-5">
                <div class="col-12 text-center">
                    <hr class="divider my-4" />
                    <input type="submit" value="Enviar" id="botonEnviar">
                    <p class="text-center">Los campos que contienen un asterisco (*) deben ser completados obligatoriamente.</p>
                </div>
            </div>
        </form>
    </div>
</section>


@endsection