<?php

namespace App\Notifications;

use App\Pelicula;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;


class PeliculaFinalizada extends Notification implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $pelicula;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Pelicula $pelicula)
    {
        $this->pelicula = $pelicula;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
        ->subject('Cinetma - Nueva película disponible!')
        ->line('El equipo de Cinetma se alegra de informarte que se ha publicado una nueva película que puede resultar de tu interés. ')
        ->line('La película es "'.$this->pelicula->titulo.'". ')
        ->line('Esperamos que sea de tu agrado. ¡Te recordamos que puedes valorarla en nuestra página web! ')
        ->action('Ver película', url('https://cinetma.myftp.org/pelicula/'.$this->pelicula->id))
        ->line('¡Muchas gracias por formar parte de nuestra comunidad! ');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
