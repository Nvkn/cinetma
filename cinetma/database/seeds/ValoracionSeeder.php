<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Valoracion;
use App\Pelicula;
use App\User;

class ValoracionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $numPeliculas = Pelicula::all()->count();
        $numUsuarios = User::all()->count();

        for ($i=2; $i <= $numUsuarios; $i++) {
            for($j = 1; $j <= $numPeliculas; $j ++) {

                Valoracion::create(
                    [
                        'nota'=>$faker->randomFloat($nbMaxDecimals = 1, $min = 0, $max = 10),
                        'pelicula_id'=>$j,
                        'user_id'=>$i
                    ]
                );

            }
        }


    }
}
