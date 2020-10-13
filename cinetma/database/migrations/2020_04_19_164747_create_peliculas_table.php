<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeliculasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peliculas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo',100);
            $table->boolean('finalizada')->default('1');
            $table->date('fechaLanzamiento')->nullable();
            $table->integer('duracion')->nullable();
            $table->string('descripcion',255);
            $table->longtext('sinopsis');
            $table->string('portada');
            $table->string('donacion')->nullable();
            $table->string('trailer',255)->nullable();
            $table->longtext('imagenes')->nullable();

            $table->foreignId('user_id')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peliculas');
    }
}
