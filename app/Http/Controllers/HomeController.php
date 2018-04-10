<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    public function contact()
    {
        return view('contact.contact');
    }

    public function home() {
        if (auth()->user()->liberado) {
            return view('home');
        } else {
            Auth::logout();
            return redirect()->route('login')
                            ->withErrors(['Usuário Não liberado!']);
        }
        
    }
    public function apagarTodasNotificacoes(Request $request)
    {
        $saida = false;
        $id = $request->notification;   
        foreach (auth()->user()->unreadNotifications as $notification)
                $del = $notification->delete();
                
        if ($del)
           $saida = true;

        if($saida) {
            return redirect()
                        ->back()
                        ->with('success','Notificações removidas');
        } else {
            return redirect()
                        ->back()
                        ->with('error', 'Erro ao tentar apagar notificações');
        }
    }
}
