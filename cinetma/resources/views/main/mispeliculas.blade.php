@extends('layouts.main')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/mispeliculas.css') }}">
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="{{ asset('js/mispeliculas.js') }}"></script>
<script>
    token = "{{ csrf_token() }}";
</script>
@endsection


@section('content')


<!-- Películas Destacadas -->
<section>
    <div class="container pt-5 mt-5" id="listadoPeliculas">
        <h3 class="h1 pt-4 text-center">Mis películas</h3>
        <hr class="divider my-4" />

        <div class="table-responsive">
            <table class="table table-hover text-center" id="listaPeliculas">
                <thead class="thead-granate thead-dark">
                    <tr>
                        <th scope="col">Portada</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <tr v-for="pelicula in peliculas" is="pelicula" v-if="peliculas" :pelicula="pelicula" v-bind:key="pelicula.id" id_pelicula="pelicula.id"></tr>
                </tbody>
            </table>

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
    <tr id_pelicula="pelicula.id">
        <td scope="row" class="portada text-dark align-middle">
            <a :href="'https://cinetma.myftp.org/pelicula/' + pelicula.id" >
                <img :src="'storage/portadas/' + pelicula.portada" alt="Portada">
            </a>
        </td>
        <td class="titulo align-middle">
            <a :href="'https://cinetma.myftp.org/pelicula/' + pelicula.id" >
                <b>@{{pelicula.titulo}}</b>
            </a>
        </td>
        {{-- Buscar como poner el estado de la película 0/1 -> finalizada/en producción VUE.JS --}}
        <td class="estado align-middle" v-if="pelicula.finalizada == 1">Finalizada</td>
        <td class="estado align-middle" v-else>En producción</td>
        <td class="acciones align-middle my-3">
            <a class="btn mx-2 p-1 bg-secondary editar" :href="'https://cinetma.myftp.org/editarpelicula/' + pelicula.id">
                <i class="fas fa-pen" alt="editar"></i>
            </a>
            <a class="btn mx-2 p-1 bg-primary my-3 eliminar" @click="eliminarPelicula(pelicula.id)">
                <i class="fas fa-trash-alt" alt="eliminar"></i>
            </a>
        </td>
    </tr>
</template>
