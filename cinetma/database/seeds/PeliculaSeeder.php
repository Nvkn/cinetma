<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Pelicula;

class PeliculaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i=0; $i < 50; $i++) {

        	Pelicula::create(
        		[
        			'titulo'=>$faker->streetName(),
        			'finalizada'=>$faker->numberBetween($min = 0, $max = 1),
        			'fechaLanzamiento'=>$faker->date($format = 'Y-m-d', $max = 'now'),
        			'duracion'=>$faker->numberBetween($min = 60, $max = 180),
        			'descripcion'=>$faker->text($maxNbChars = 200),
        			'sinopsis'=>$faker->text($maxNbChars = 1000),
        			'trailer'=>$faker->url(),
                    'donacion'=>$faker->url(),
        			'portada'=>'portada.png',
        			'user_id'=>1
        		]
        	);
        }
    }
}
