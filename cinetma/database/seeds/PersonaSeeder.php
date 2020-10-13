<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Persona;
use App\Pelicula;

class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create();

        for ($i=0; $i < 100; $i++) {

            Persona::create(
                [
                    'nombre'=>$faker->name()
                ]
            );
        }
    }

}

