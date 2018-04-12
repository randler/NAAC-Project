<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendContatoNotifications extends Mailable
{
    use Queueable, SerializesModels;
    public $dadosEmail;
    public $link_face = 'http://www.facebook.com/';

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
        return $this->view('email.contato_opiniao')
                    ->subject($this->dadosEmail->assunto);
    }
}
