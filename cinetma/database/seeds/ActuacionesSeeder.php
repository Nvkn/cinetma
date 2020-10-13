<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Pelicula;
use App\Persona;

class ActuacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (Persona::all() as $persona){
            $peliculas = Pelicula::all()->random(3);
            foreach ($peliculas as $pelicula) {
                $persona->actuaciones()->attach($pelicula, array ('papel' => $faker->name()));
            }
        }
    }
}
