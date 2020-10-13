<?php

namespace App\Jobs;

use App\User;
use App\Pelicula;
use App\Notifications\PeliculaFinalizada;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class EnviarNotificacionPeliculaFinalizada implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $pelicula;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Pelicula $pelicula)
    {
        $this->pelicula = $pelicula;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Notificar por correo electrónico
        $users = User::where('notificaciones','1')->get();
        foreach ($users as $user) {
            $user->notify(new PeliculaFinalizada($this->pelicula));
        }

        // Notificar en el servidor de Discord
        $response = Http::asForm()->post('https://cinetma.myftp.org:8443/nuevaPelicula', [
            'pelicula' => $this->pelicula->toArray(),
            'categorias' => $this->pelicula->stringCategorias
        ]);

        $jsonData = $response->json();

        // dd($jsonData);
    }
}
