<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call('UsuarioSeeder');
        $this->call('PeliculaSeeder');
        $this->call('CategoriaSeeder');
        $this->call('PersonaSeeder');
        $this->call('ActuacionesSeeder');
        $this->call('ProduccionesSeeder');
        $this->call('ValoracionSeeder');
        $this->call('CategoriaPeliculaSeeder');
    }
}