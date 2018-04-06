<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name'          => 'NAAC-admin',
            'email'         => 'admin.naac@naac.com',
            'password'      => bcrypt('abobora'),
            'instituicao'   => 'FTC',
            'cpf'           => '000.000.000-00',
            'area_atuacao'  => 'Administrador',
            'curso'         => '-',
            'funcao'        => 'Administrador', 
            'admin'         => true,
            'liberado'      => true,
        ]);
    }
}
