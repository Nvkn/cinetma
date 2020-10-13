@extends('layouts.main')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/pelicula.css') }}">
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
@endsection


@section('content')

<!-- Película -->
<section id="pelicula" class="mt-5">
    <div class="container my-5" id="main">
        <div class="row">
            <div class="col-12 tituloPelicula text-center my-4">
                <h1>{{ $persona->nombre }}</h1>
                <br/>
                <hr class="divider my-4" />
            </div>
        </div>
        @if($persona->actuaciones)
        <div class="row mt-5">
            <div class="col-12 text-center">
                <h3>Ha participado como actor/actriz en:</h3>
                <br/>
                <hr class="divider my-4" />
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="w-50">Película</th>
                            <th scope="col" class="w-50">Papel</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($persona->actuaciones as $pelicula)
                        <tr>
                            <td class="align-middle" scope="row"><a class="text-dark" target="_blank" href="https://cinetma.myftp.org/pelicula/{{$pelicula->id}}">{{ $pelicula->titulo }}</a></td>
                            <td class="align-middle">{{ $pelicula->pivot->papel }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
        @if($persona->producciones)
        <div class="row mt-5">
            <div class="col-12 text-center">
                <h3>Ha participado en el equipo técnico de:</h3>
                <br/>
                <hr class="divider my-4" />
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="w-50">Película</th>
                            <th scope="col" class="w-50">Rol</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($persona->producciones as $pelicula)
                        <tr>
                            <td class="align-middle" scope="row"><a class="text-dark" target="_blank" href="https://cinetma.myftp.org/pelicula/{{$pelicula->id}}">{{ $pelicula->titulo }}</a></td>
                            <td class="align-middle">{{ $pelicula->pivot->rol }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
</section>


@endsection