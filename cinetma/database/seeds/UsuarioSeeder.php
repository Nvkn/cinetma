<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        if(! sizeof(User::all()) >= 1 )
        {
        	User::create(
        		[
        			'nombre'=>'Nicolás',
        			'apellidos'=>'Barcia Quintela',
        			'nick'=>'Nikel',
        			'email'=>'a18nicolasbq@iessanclemente.nett',
        			'password'=>Hash::make('abc123..'),
        			'notificaciones'=>1
        		]
        	);
        }

        for ($i=1; $i <= 14; $i++) {
        	User::create(
        		[
        			'nombre'=>$faker->firstName(),
        			'apellidos'=>$faker->lastName(),
        			'nick'=>$faker->userName(),
        			'email'=>$faker->email(),
        			'password'=>Hash::make('abc123..'),
        			'notificaciones'=>$faker->numberBetween($min = 0, $max = 1)
        		]
        	);
        }
    }
}
