<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="Nicolás Barcia Quintela" />

    <title>{{ config('app.name', 'Cinetma') }}</title>

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
    <!-- Third party plugin CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>

    @yield('css')

</head>
<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-2" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="{{ route('index') }}">Cinetma</a><button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto my-2 my-lg-0 d-lg-flex align-items-center">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ route('peliculas') }}">Peliculas</a></li>
                    {{-- <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#services">Mejor valoradas</a></li> --}}
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ route('produccion') }}">En producción</a></li>
                    @guest
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ route('login') }}">Acceder</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ route('register') }}">Registrarse</a></li>
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->nick }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('perfil') }}">Perfil</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">Desconectarse</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                    <li class="nav-item">
                        <form id="busqueda" action="{{ route('busqueda') }}" method="GET">
                            <div class="input-group">
                                <input type="text" class="search-query form-control" name="busqueda" placeholder="Search" />
                                <span class="input-group-btn input-group-append">
                                    <button class="btn btn-busqueda" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>


@yield('content')


{{-- No muestra el Footer para las secciones de acceso y registro --}}
@if (!\Request::is('login') && !\Request::is('register') && !\Request::is('perfil') && !\Request::is('forgotpassword'))
<!-- Footer-->
<footer class="bg-primary py-5">
    <div class="container"><div class="small text-center text-muted">Copyright © 2020 - Cinetma</div></div>
</footer>
@endif


<!-- Bootstrap core JS--><script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<!-- Third party plugin JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<!-- Core theme JS-->
<script src="{{ asset('js/scripts.js') }}"></script>
@yield('js')
</body>
</html>