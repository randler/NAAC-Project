<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\Projeto;
use App\Models\Relatorio;
use App\Notifications\ResetPassword;
use DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email', 
        'password',
        'instituicao',
        'cpf',
        'area_atuacao',
        'curso',
        'funcao',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function projects()
    {
        return $this->hasMany(Projeto::class);
    }

    public function relatorios()
    {
        return $this->hasMany(Relatorio::class);
    }

    public function atualizarUsuario($user): Array
    {
        DB::beginTransaction();
        $updateUser = $this->where('email', $user['email'])->first();
        //$updateUser = $user;
        //dd($user);
        $update = $updateUser->update($user);

        if ($update) {
            DB::commit();
            
            return [
                'success' => true,
                'message' => 'Dados do usuário atualizados com sucesso!'
            ];
        }
        DB::rollback();
        
        return [
            'success' => false,
            'message' => 'Erro ao tentar atualizar os dados!'
        ];
    }

    public function liberarAcesso($id): Array
    {
        DB::beginTransaction();
        $user = $this->find($id);
        
        $user->liberado = true;
        $user->novo = false;

        $saveUser = $user->save();

        if ($saveUser) {
            DB::commit();
            return [
                'success' => true,
                'message' => 'Usuario liberado!'
            ];
        }

        DB::rollback();
        
        return [
            'success' => false,
            'message' => 'Erro ao tentar liberar o usuário!'
        ];
    }

    public function negarAcesso($id): Array
    {
        DB::beginTransaction();
        $user = $this->find($id);
        
        $user->liberado = false;

        $saveUser = $user->save();

        if ($saveUser) {
            DB::commit();
            return [
                'success' => true,
                'message' => 'Usuario bloqueado!'
            ];
        }

        DB::rollback();
        
        return [
            'success' => false,
            'message' => 'Erro ao tentar bloquear o usuário!'
        ];
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }
}
