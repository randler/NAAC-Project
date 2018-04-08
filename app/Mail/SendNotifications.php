<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNotifications extends Mailable
{
    use Queueable, SerializesModels;

    public $dadosEmail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dadosEmail)
    {
        $this->dadosEmail = $dadosEmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.body-mail')
                    ->subject($this->dadosEmail->assunto);
    }
}
