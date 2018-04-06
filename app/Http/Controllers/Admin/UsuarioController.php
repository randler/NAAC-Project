<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;

class UsuarioController extends Controller
{
    //


    public function acesso($notify_id = '', User $user)
    {
        $usuarios = $user->all();
        
        if ($notify_id != '')
            $this->setLida($notify_id); 

        return view('admin.user.acesso', compact('usuarios'));
    }

    public function liberar($id, User $user)
    {
        $responseSave = $user->liberarAcesso($id);

        if ($responseSave['success']) {
            return redirect()
                        ->back()
                        ->with('success', $responseSave['message']);
        } else {
            return redirect()
                        ->back()
                        ->with('error', $responseSave['message']);
        }
    }

    public function negar($id, User $user)
    {
        $responseSave = $user->negarAcesso($id);
        
                if ($responseSave['success']) {
                    return redirect()
                                ->back()
                                ->with('success', $responseSave['message']);
                } else {
                    return redirect()
                                ->back()
                                ->with('error', $responseSave['message']);
                }
    }

    private function setLida($notify_id)
    {
        foreach (auth()->user()->unreadNotifications as $notification)
            if ($notification->data['id'] == $notify_id)
                $notification->delete();
    }
}
