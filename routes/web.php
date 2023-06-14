<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    AuthController,
    ConfiguracoesController,
    RouteController,
    UserController,
    GroupUserController,
    ParlamentarController,
    PerfilParlamentarControlle,
    ProposicoesController,
    TramitacoesController
};
use App\Models\Proposicoes;

Route::get('/', [AuthController::class, 'index'])->name('auth');
Route::get('/rotas', [RouteController::class, 'index'])->name('routeController');

/* Rota para o usuário logar */

Route::post('/auth', [UserController::class, 'auth'])->name('auth.post');
Route::get('/logout', [UserController::class, 'logout'])->name('auth.logout');

Route::get('/importParlamentar', [ParlamentarController::class, 'ImportParlamentar'])->name('import.parlamentar');
Route::get('/importProposicoes', [ProposicoesController::class, 'ImportProposicoes'])->name('import.proposicoes');
Route::get('/importTramitacoes', [TramitacoesController::class, 'ImportTramitacoes'])->name('import.tramitacoes');

Route::group(['middleware' => 'auth:web'], function() {

    /* Rota de dashboard */
    Route::get('/dash', ['as' => 'dashboard',  'nickname' => 'Acessar o sistema',     'groupname' => 'DashBoard',    'resource' => 'web',    'uses' => 'App\Http\Controllers\HomeController@index']);
    /* Fim rota dashboard */

    /* Inicio rota Grupos de usuarios */
    Route::get('/grupos',      ['as' => 'group',      'nickname' => 'Visualizar cadastrados',        'groupname' => 'Grupos',    'resource' => 'web',    'uses' => 'App\Http\Controllers\GroupUserController@index']);
    Route::get('/grupos/novo', ['as' => 'grupo.show',  'nickname' => 'Cadastrar novo',      'groupname' => 'Grupos',    'resource' => 'web',    'uses' => 'App\Http\Controllers\GroupUserController@show']);
    Route::post('/grupos/novo', [GroupUserController::class, 'store'])->name('grupo.store');
    Route::get('/grupos/{id}', ['as' => 'grupo.update',  'nickname' => 'Editar cadastrados',     'groupname' => 'Grupos',    'resource' => 'web',    'uses' => 'App\Http\Controllers\GroupUserController@edit']);
    Route::post('/grupos/{id}', [GroupUserController::class, 'update'])->name('grupo.atualiza');
    Route::get('/grupos/remove/{id}', ['as' => 'grupo.destroy',  'nickname' => 'Remover cadastrado',      'groupname' => 'Grupos',    'resource' => 'web',    'uses' => 'App\Http\Controllers\GroupUserController@destroy']);
    /* Fim rota Grupos de usuarios */

    /* Inicio rota usuarios*/
    Route::get('/usuarios',      ['as' => 'usuarios',      'nickname' => 'Visualizar cadastrados',        'groupname' => 'Usuarios',    'resource' => 'web',    'uses' => 'App\Http\Controllers\UserCreateController@index']);
    /* Fim rota de usuarios */

    /* Inicio rota Parlamentar*/
    Route::get('/parlamentar',      ['as' => 'parlamentar',      'nickname' => 'Visualizar e Buscar',        'groupname' => 'Parlamentar',    'resource' => 'web',    'uses' => 'App\Http\Controllers\PerfilParlamentarControlle@index']);
    Route::get('/parlamentar/{id}',      ['as' => 'parlamentar.show',      'nickname' => 'Visualizar perfil',        'groupname' => 'Parlamentar',    'resource' => 'web',    'uses' => 'App\Http\Controllers\PerfilParlamentarControlle@show']);
    Route::post('/parlamentar/{id}', [PerfilParlamentarControlle::class, 'anotacoes'])->name('anotacoes.post');
    Route::post('/parlamentar/{id}/perfil',      ['as' => 'parlamentar.perfil',      'nickname' => 'Adicionar informações adicionais',        'groupname' => 'Parlamentar',    'resource' => 'web',    'uses' => 'App\Http\Controllers\PerfilParlamentarControlle@perfil']);
    /* Fim rota de usuarios */


    /* Proposições */
    Route::get('/proposicoes/{id}/tramitacao',      ['as' => 'tramitacao',      'nickname' => 'Visualizar Tramitação',        'groupname' => 'Tramitação',    'resource' => 'web',    'uses' => 'App\Http\Controllers\ProposicoesController@show']);
    Route::get('/proposicoes/{id}/seguir',      ['as' => 'seguir.proposicao',      'nickname' => 'Seguir proposição',        'groupname' => 'Proposição',    'resource' => 'web',    'uses' => 'App\Http\Controllers\ProposicoesController@follow']);
    Route::get('/proposicoes/{id}/unfollow',      ['as' => 'unfollow.proposicao',      'nickname' => 'Deixar de seguir proposição',        'groupname' => 'Proposição',    'resource' => 'web',    'uses' => 'App\Http\Controllers\ProposicoesController@unfollow']);

    Route::post('/proposicoes/{id}/parecer',      ['as' => 'parecer.proposicao',      'nickname' => 'Inserir Parecer na proposição',        'groupname' => 'Proposição',    'resource' => 'web',    'uses' => 'App\Http\Controllers\ProposicoesController@parecerProposicao']);

    Route::get('/proposicoes/{id}/parecer-remove/{id_proposicao}', ['as' => 'parecer.proposicao.destroy',     'nickname'  => 'Remover parecer',  'groupname' => 'Proposição',     'resource' => 'web',    'uses' => 'App\Http\Controllers\ProposicoesController@removeParecer']);

    Route::post('/proposicoes/{id}/tramitacao/anotacoes',      ['as' => 'tramitacao.anotacoes',      'nickname' => 'Visualizar Anotações da proposição',        'groupname' => 'Proposição',    'resource' => 'web',    'uses' => 'App\Http\Controllers\ProposicoesController@anotacoesProposicoes']);

    Route::get('/proposicoes-seguidas', ['as' => 'proposicoes.seguidas',     'nickname'  => 'Visualizar Proposições seguidas',  'groupname' => 'Proposição',     'resource' => 'web',    'uses' => 'App\Http\Controllers\ProposicoesController@propoFollow']);
    // Route::post('/proposicoes-seguidas', [ProposicoesController::class, 'inserPalavrasChaves'])->name('palavras.post');

    Route::get('/proposicoes', ['as' => 'proposicoes.all',     'nickname'  => 'Visualizar todas as Proposições',  'groupname' => 'Proposição',     'resource' => 'web',    'uses' => 'App\Http\Controllers\ProposicoesController@all']);

    /* Limpar cache*/
    Route::get('/cache', ['as' => 'cache.clear',     'nickname'  => 'Limpar Cache',  'groupname' => 'Cache',     'resource' => 'web',    'uses' => 'App\Http\Controllers\CacheController@clearAll']);
    /*  Fim Limpar cache*/

    Route::get('/notificacao/{id}', [ProposicoesController::class, 'notificacao'])->name('notificacao.lida');


    /*configurações de palavras chaves e pareceres */

    Route::get('/configurador', ['as' => 'configurador', 'nickname' => 'Acessar as Configurações',  'groupname' => 'Configurações', 'resource' => 'web', 'uses' => 'App\Http\Controllers\ConfiguracoesController@index']);
    Route::post('/parecer', [ConfiguracoesController::class, 'insereParecer'])->name('parecer.post');
    Route::post('/parecer/{id}', [ConfiguracoesController::class, 'editParecer'])->name('parecer.edit');
    Route::post('/palavrasChaves', [ConfiguracoesController::class, 'inserPalavrasChaves'])->name('palavras.post');

});


