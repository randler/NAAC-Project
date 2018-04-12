<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User; 

class PerfilController extends Controller
{
    //

    public function index()
    {
        $user = auth()->user();
        //dd($user);
        return view('user.index', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $newUser = $request->all();

        if (!$newUser['password']) {
            $newUser['password'] = auth()->user()->password;
            $newUser['password_confirmation'] = auth()->user()->password;
        } else {
            $newUser['password'] = bcrypt($newUser['password']);
            $newUser['password_confirmation'] = bcrypt($newUser['password_confirmation']);
        }

        $updateResponse = $user->atualizarUsuario($newUser);

        if ($updateResponse['success']) {
            return redirect()
                        ->back()
                        ->with('success', $updateResponse['message']);        
        }
        
        return redirect()
                    ->back()
                    ->with('error', $updateResponse['message']);
    }
}
