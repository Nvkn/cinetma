<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Categoria;
use App\Pelicula;

class CategoriaPeliculaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create();
    	foreach (Pelicula::all() as $pelicula)
    	{
    		$categorias = Categoria::all()->random(rand(1, sizeof(Categoria::all())));
    		foreach($categorias as $categoria)
    		{
    			$pelicula->categorias()->attach($categoria);
    		}
    	}
    }
}
