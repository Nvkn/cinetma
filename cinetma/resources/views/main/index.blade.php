@extends('layouts.main')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/index.css') }}">
@endsection


@section('content')

<!-- Cabecera (Carrusel de películas destacadas) -->
<header>
    <div id="carouselDestacadas" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselDestacadas" data-slide-to="0" class="active"></li>
            <li data-target="#carouselDestacadas" data-slide-to="1"></li>
            <li data-target="#carouselDestacadas" data-slide-to="2"></li>
            <li data-target="#carouselDestacadas" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <!-- Slide One -->
            <div class="carousel-item active" style="background-image: url('{{ asset('assets/img/destacadas/lostintranslation2.jpeg') }}')">
                <div class="carousel-caption">
                    <a href="#" style="text-decoration: none;"><h3 class="display-5">Lost in Translation</h3></a>
                    <p class="lead d-none d-md-block">Un actor de mediana edad que está en Tokio para grabar un comercial conoce a la joven esposa de un fotógrafo de famosos.</p>
                </div>
            </div>
            <!-- Slide Two -->
            <div class="carousel-item" style="background-image: url('{{ asset('assets/img/destacadas/lebowski.jpg') }}')">
                <div class="carousel-caption">
                    <h3 class="display-5">El Gran Lebowski</h3>
                    <p class="lead d-none d-md-block">Un desempleado es confundido por unos matones con el millonario Jeff Lebowski, quien se llama igual que él y a cuya esposa han secuestrado. Cuando acude a casa del millonario para quejarse, éste decide contratarlo para rescatar a su esposa a cambio de una recompensa.</p>
                </div>
            </div>
            <!-- Slide Three -->
            <div class="carousel-item" style="background-image: url('{{ asset('assets/img/destacadas/lostintranslation2.jpeg') }}')">
                <div class="carousel-caption">
                    <a href="#" style="text-decoration: none;"><h3 class="display-5">Lost in Translation 2</h3></a>
                    <p class="lead d-none d-md-block">Un actor de mediana edad que está en Tokio para grabar un comercial conoce a la joven esposa de un fotógrafo de famosos.</p>
                </div>
            </div>
            <!-- Slide Four -->
            <div class="carousel-item" style="background-image: url('{{ asset('assets/img/destacadas/lebowski.jpg') }}')">
                <div class="carousel-caption">
                    <h3 class="display-5">El Gran Lebowski 2</h3>
                    <p class="lead d-none d-md-block">Un desempleado es confundido por unos matones con el millonario Jeff Lebowski, quien se llama igual que él y a cuya esposa han secuestrado. Cuando acude a casa del millonario para quejarse, éste decide contratarlo para rescatar a su esposa a cambio de una recompensa.</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselDestacadas" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselDestacadas" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
      </a>
  </div>
</header>

<!-- Últimas Películas-->
<section id="portfolio">
    <div class="container mb-5">
        <h2 class="text-center mt-3 pt-5">Últimas películas</h2>
        <hr class="divider my-4" />
        <div class="container-fluid p-0">
            <div class="row no-gutters justify-content-between">
                @foreach($ultimas as $pelicula)
                <div class="col-6 col-md-3">
                    <a class="portfolio-box" href="https://cinetma.myftp.org/pelicula/{{$pelicula->id}}">
                        <img class="img-fluid" src="{{ asset('storage/portadas/'.$pelicula->portada) }}" alt="{{$pelicula->titulo}}" />
                        <div class="portfolio-box-caption">
                            <div class="project-name">{{$pelicula->titulo}}</div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Mejores Películas-->
<section id="portfolio">
    <div class="container mb-5">
        <h2 class="text-center mt-3 pt-5">Mejor Valoradas</h2>
        <hr class="divider my-4" />
        <div class="container-fluid p-0">
            <div class="row no-gutters justify-content-between">
                @foreach($mejorValoradas as $pelicula)
                <div class="col-6 col-md-3">
                    <a class="portfolio-box" href="https://cinetma.myftp.org/pelicula/{{$pelicula->id}}">
                        <img class="img-fluid" src="{{ asset('storage/portadas/'.$pelicula->portada) }}" alt="{{$pelicula->titulo}}" />
                        <div class="portfolio-box-caption">
                            <div class="project-name">{{$pelicula->titulo}}</div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@endsection