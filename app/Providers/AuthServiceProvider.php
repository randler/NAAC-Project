<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Models\Projeto;
use App\Models\Relatorio;
use App\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //App\User::class => \App\Policies\AutorPolicy::class,
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('verificar-projeto', function(Projeto $projeto) {
            return auth()->user()->id == $projeto->user_id;
        });

        Gate::define('verificar-relatorio', function(Relatorio $relatorio) {
            return auth()->user()->id == $relatorio->user_id;
        });

        Gate::define('autor', function(User $user) {
            return $user->admin == false;
        });
    }
}
