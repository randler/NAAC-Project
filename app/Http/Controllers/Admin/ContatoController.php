<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Notifications\ProjetoNotification;
use App\Mail\SendContatoNotifications;

use App\Http\Requests\Contato\ContatoNotificationFormRequest;

use Mail;
use DB;
use App\User;

class ContatoController extends Controller
{

    public function sendEmailContact(ContatoNotificationFormRequest $request)
    {  
        $user = new User;
        
        $dadosEmail = (object) Array (
            'para'          => $user->where('admin', true)->get()->first()->email,
            'assunto'       => '[Contato - Opinião/Dúvida]',
            'de'            => $request->email,
            'mensagem'      => $request->mensagem
        );
        //dd($dadosEmail, $request);
        $this->sendEmail($dadosEmail);
        
        return view('contact.agradecimento');
    }

    private function sendEmail($dadosEmail)
    {
        Mail::to($dadosEmail->para)->send(new SendContatoNotifications($dadosEmail));
    }
}
