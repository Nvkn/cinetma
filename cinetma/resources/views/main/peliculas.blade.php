@extends('layouts.main')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/peliculas.css') }}">
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
<script type="text/javascript" src="{{ asset('js/peliculas.js') }}"></script>
@endsection


@section('content')

<!-- Películas Destacadas -->
<section id="tabs">
    <div class="container pt-5">
        <h3 class="h1 pt-4 text-center">Películas destacadas</h3>
        <hr class="divider my-4" />

        <div class="row">
            <div class="col-xs-12">
                <nav>
                    <div class="nav nav-tabs nav-fill row" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active text-dark col-6 col-md-3" id="peliculaDestacada1-tab" data-toggle="tab" href="#peliculaDestacada1" role="tab" aria-controls="nav-peliculaDestacada1" aria-selected="true">Película 1</a>
                        <a class="nav-item nav-link text-dark col-6 col-md-3" id="peliculaDestacada2-tab" data-toggle="tab" href="#peliculaDestacada2" role="tab" aria-controls="nav-peliculaDestacada2" aria-selected="false">Película 2</a>
                        <a class="nav-item nav-link text-dark col-6 col-md-3" id="peliculaDestacada3-tab" data-toggle="tab" href="#peliculaDestacada3" role="tab" aria-controls="nav-peliculaDestacada3" aria-selected="false">Película 3</a>
                        <a class="nav-item nav-link text-dark col-6 col-md-3" id="peliculaDestacada4-tab" data-toggle="tab" href="#peliculaDestacada4" role="tab" aria-controls="nav-peliculaDestacada4" aria-selected="false">Película 4</a>
                    </div>
                </nav>
                <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="peliculaDestacada1" role="tabpanel" aria-labelledby="peliculaDestacada1-tab">
                        <div class="row pt-3 d-flex align-items-center justify-content-center">
                            <div class="divImagen col-md-5">
                                <img src="{{ asset('assets/img/destacadas/lebowski.jpg') }}" class="w-100">
                            </div>
                            <div class="col-md-7">
                                <h3 class="text-center my-3 py-2">Título de la película 1</h3>
                                <p class="text-justify">Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat.</p>
                                <p class="text-justify">Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="peliculaDestacada2" role="tabpanel" aria-labelledby="peliculaDestacada2-tab">
                        <div class="row pt-3 d-flex align-items-center justify-content-center">
                            <div class="divImagen col-md-5">
                                <img src="{{ asset('assets/img/destacadas/lebowski.jpg') }}" class="w-100">
                            </div>
                            <div class="col-md-7">
                                <h3 class="text-center my-3 py-2">Título de la película 2</h3>
                                <p class="text-justify">Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat.</p>
                                <p class="text-justify">Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="peliculaDestacada3" role="tabpanel" aria-labelledby="peliculaDestacada3-tab">
                        <div class="row pt-3 d-flex align-items-center justify-content-center">
                            <div class="divImagen col-md-5">
                                <img src="{{ asset('assets/img/destacadas/lebowski.jpg') }}" class="w-100">
                            </div>
                            <div class="col-md-7">
                                <h3 class="text-center my-3 py-2">Título de la película 3</h3>
                                <p class="text-justify">Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat.</p>
                                <p class="text-justify">Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="peliculaDestacada4" role="tabpanel" aria-labelledby="peliculaDestacada4-tab">
                        <div class="row pt-3 d-flex align-items-center justify-content-center">
                            <div class="divImagen col-md-5">
                                <img src="{{ asset('assets/img/destacadas/lebowski.jpg') }}" class="w-100">
                            </div>
                            <div class="col-md-7">
                                <h3 class="text-center my-3 py-2">Título de la película 4</h3>
                                <p class="text-justify">Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat.</p>
                                <p class="text-justify">Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- Todas las películas -->

<section>
    <div class="container" id="listadoPeliculas">
        <h2 class="mb-4 text-center">Todas las películas disponibles</h2>
        <hr class="divider my-4" />
        <div id="selectoresPeliculas" class="d-flex justify-content-center flex-wrap">
            <div class="form-group mx-2">
                <select v-model="orden" @click="listarPeliculas()" class="form-control w-auto select-personalizado rounded-0" id="orden">
                    <option value="0">Últimas películas</option>
                    <option value="1">Mejor valoradas</option>
                </select>
            </div>
            <div class="form-group mx-2">
                <select v-model="categoria" @click="listarPeliculas()" class="form-control w-auto select-personalizado rounded-0" id="categoria">
                    <option value="">Categoría...</option>
                    <option value="Drama">Drama</option>
                    <option value="Terror">Terror</option>
                    <option value="Romance">Romance</option>
                    <option value="Accion">Acción</option>
                    <option value="Comedia">Comedia</option>
                    <option value="Ciencia ficción">Ciencia ficción</option>
                    <option value="Suspense">Suspense</option>
                </select>
            </div>
        </div>
        <div class="row text-center mt-3">

            {{-- Listado de películas con VUE --}}
            <div v-for="pelicula in peliculas" is="pelicula" v-if="peliculas" :pelicula="pelicula" v-bind:key="pelicula.id"></div>

            {{-- Paginación con VUE --}}
            <div class="pagination col-12 justify-content-center" is="pagination" v-if="pagination" :pagination="pagination">
                <button class="btn btn-default" @click="listarPeliculas(pagination.prev_page_url)"
                :disabled="!pagination.prev_page_url">Anterior</button>
                <span class="my-5">Página @{{pagination.current_page}} de @{{pagination.last_page}}</span>
                <button class="btn btn-default" @click="listarPeliculas(pagination.next_page_url)"
                :disabled="!pagination.next_page_url">Siguiente</button>
            </div>
        </div>
    </div>
</section>

@endsection

<template id="template-pelicula">
    <div class="col-6 col-lg-3 col-md-4 py-2">
        <a :href="'https://cinetma.myftp.org/pelicula/' + pelicula.id" class="text-dark">
            <div class="card border-0 rounded-0" v-if="pelicula" v-if="pagination">
                <img class="card-img-top rounded-0" :src="'storage/portadas/' + pelicula.portada" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">@{{pelicula.titulo}}</h5>
                </div>
            </div>
        </a>
    </div>
</template>