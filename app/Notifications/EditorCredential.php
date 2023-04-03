<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EditorCredential extends Notification
{
    use Queueable;

    public $data;

    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Credenciales de Redactor para entrar a la plataforma')
            ->greeting('¡Hola ' . $this->data['name'] . '!' )
            ->line('Hemos registrado tus datos en nuestra plataforma web, y es por esto')
            ->line('que te compartimos tus credenciales de acceso:')
            ->line('Usuario: ' . $this->data['email'])
            ->line('Contraseña: ' . $this->data['password'])
            ->action('¡Ingresar ahora!', url('/'))
            ->line('¡Nos alegra tenerte con nosotros!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
