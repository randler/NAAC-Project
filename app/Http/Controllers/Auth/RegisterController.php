<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Notifications\ProjetoNotification;

use DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/inicio';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'          => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:users',
            'instituicao'   => 'required|string|max:255',
            'cpf'           => 'required|string|max:14',
            'area_atuacao'  => 'required|string|max:255',
            'curso'         => 'required|string|max:255',
            'funcao'        => 'required|string|max:255',
            'password'      => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        DB::beginTransaction();
        $user = User::create([
            'name'          => $data['name'],
            'email'         => $data['email'],
            'instituicao'   => $data['instituicao'],
            'cpf'           => $data['cpf'],
            'area_atuacao'  => $data['area_atuacao'],
            'curso'         => $data['curso'],
            'funcao'        => $data['funcao'],
            'password'      => bcrypt($data['password']),
        ]);
        
        //dd($user);

        if ($user) {
            $notifyProject = (object) [
                'id' => 'new_user',
                'titulo_projeto' => $data['name'],
                'status_projeto' => 'new_user' 
            ];
            //dd($notifyProject->id);
            $admins = User::where('admin', true)->get();
            
            foreach ($admins as $admin)
                $admin->notify(new ProjetoNotification($notifyProject));

            DB::commit();
        } else {
            DB::rollback();
        }
        
        return $user;
    }
}
