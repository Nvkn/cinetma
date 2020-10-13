<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Pelicula;
use App\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::create(['categoria'=>'Terror']);
        Categoria::create(['categoria'=>'Romance']);
        Categoria::create(['categoria'=>'Acción']);
        Categoria::create(['categoria'=>'Drama']);
        Categoria::create(['categoria'=>'Comedia']);
        Categoria::create(['categoria'=>'Ciencia ficción']);
        Categoria::create(['categoria'=>'Suspense']);
    }
}