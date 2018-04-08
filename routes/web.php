<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Auth::routes();
//Route::get('sendemail', 'Email\EmailController@sendemail');

Auth::routes();

$this->get('/', 'HomeController@index')->name('index');
$this->get('/contato',  'HomeController@contact')->name('contact');
$this->get('/inicio',   'HomeController@home')->middleware('auth', 'auth.unique.user')->name('home');
$this->post('/apagar-notificacoes', 'HomeController@apagarTodasNotificacoes')->name('apagar-notificacoes');
$this->post('/perfil',  'User\PerfilController@update')->middleware('auth', 'auth.unique.user')->name('update-user');
$this->get('/perfil',   'User\PerfilController@index')->middleware('auth', 'auth.unique.user')->name('perfil');
$this->get('/download-projeto/{id}',    'Projeto\DownloadController@downloadProjetoPDF')->middleware('auth', 'auth.unique.user')->name('download-projeto');
$this->get('/download-lista/{id}',      'Projeto\DownloadController@downloadListaPDF')->middleware('auth', 'auth.unique.user')->name('download-lista');


/**    ****************** ROTAS DO AUTOR **************************     */
$this->group(['namespace' => 'Projeto','middleware' => ['auth', 'check.autor', 'auth.unique.user']], function() {
    $this->get('/novo-projeto',         'ProjetoAutorController@novoProjeto')->name('new-projeto');
    $this->get('/projetos-usuario',     'ProjetoAutorController@todosProjetosUser')->name('todos-projetos-user');
    $this->get('/projetos-correcao',    'ProjetoAutorController@projetosCorrecao')->name('projetos-correcao-user');
    $this->get('/editar-projeto-usuario/{id}/{notify_id?}', 'ProjetoAutorController@visualizarCorrigirProjeto')->name('corrigir-projeto-user');
    $this->get('/ver-projeto/{id}/{notify_id?}',            'ProjetoAutorController@verProjeto')->name('visualizar-projeto');
    $this->get('/projetos-deferidos-usuario',               'ProjetoAutorController@projetosDeferidos')->name('projetos-deferidos-user');
    
    $this->post('/salvar-projeto',       'ProjetoAutorController@salvarProjeto')->name('save-project');
    
    $this->put('/projeto-correcao/{id}', 'ProjetoAutorController@atualizarCorrecaoProjeto')->name('update-correcao-projeto');
});

$this->group(['namespace' => 'Relatorio', 'middleware' => ['auth', 'check.autor', 'auth.unique.user']], function() {
    $this->get('/projetos-relatorio',   'RelatorioAutorController@index')->name('index-relatorio');
    $this->get('/novo-relatorio/{id}',  'RelatorioAutorController@novoRelatorio')->name('novo-relatorio');
    $this->get('/novo-relatorio/{id}',  'RelatorioAutorController@novoRelatorio')->name('novo-relatorio');
        $this->get('/relatorios-usuario',   'RelatorioAutorController@todosRelatoriosUser')->name('todos-relatorios-user');
    $this->get('/relatorios-deferidos-usuario',   'RelatorioAutorController@relatoriosDeferidos')->name('relatorios-deferidos-user');
    $this->get('/relatorios-correcao',  'RelatorioAutorController@relatoriosCorrecao')->name('relatorios-correcao-user');
    $this->get('/editar-relatorio-usuario/{id}/{notify_id?}', 'RelatorioAutorController@viewCorrigirRelatorio')->name('corrigir-relatorio-user');

    $this->post('salvar-relatorio', 'RelatorioAutorController@salvarRelatorio')->name('salvar-relatorio');

    $this->put('/relatorio-correcao/{id}', 'RelatorioAutorController@salvarCorrecaoRelatorio')->name('update-correcao-relatorio');
});

/**    ****************** ROTAS DO ADMIN **************************     */
$this->group(['namespace' => 'Admin', 'middleware' => ['auth', 'check.admin', 'auth.unique.user']], function() {
    $this->get('/liberar-usuarios/{notify_id?}',    'UsuarioController@acesso')         ->name('request-users');
    $this->get('/liberar-usuario/{id}',             'UsuarioController@liberar')    ->name('liberar-user');
    $this->get('/negar-usuario/{id}',               'UsuarioController@negar')        ->name('negar-user');
});

$this->group(['namespace' => 'Projeto', 'middleware' => ['auth', 'check.admin', 'auth.unique.user']], function() {
    $this->get('/todos-projetos',       'ProjetoAdminController@todosProjetos')                   ->name('todos-projetos');
    $this->get('/projetos-reenviados',  'ProjetoAdminController@todosProjetosCorrigidos')    ->name('projetos-reenviados');
    $this->get('/projetos-deferidos',   'ProjetoAdminController@todosProjetosDeferidos')      ->name('projetos-deferidos');
    $this->get('/projetos-enviados',    'ProjetoAdminController@projetosSolicitados')          ->name('projetos-solicitados');
    $this->get('/editar-projeto/{id}/{notify_id?}', 'ProjetoAdminController@corrigirProjeto')->name('corrigir-project');
    $this->post('/editar-projeto/{id}',             'ProjetoAdminController@salvarCorrigirProjeto')     ->name('salvar-corrigir-project');
    $this->get('/indeferir-projeto/{id}',           'ProjetoAdminController@indeferirProjeto')        ->name('indeferir-projeto');
    $this->get('/deferir-projeto/{id}',             'ProjetoAdminController@deferirProjeto')            ->name('deferir-projeto');
    
    
});