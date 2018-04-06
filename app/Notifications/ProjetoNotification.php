<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ProjetoNotification extends Notification
{
    use Queueable;
    private $projeto;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($projeto)
    {
        $this->projeto = $projeto;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
            'id'                => $this->projeto->id,
            'status_projeto'    => $this->projeto->status_projeto,
            'titulo_projeto'    => $this->projeto->titulo_projeto,
        ];
    }
}
