<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Blade::setContentTags('<%', '%>');


Route::post('entrar', function () {
    /*$user = array(
        'email_usr' => Input::get('email_usr'),
        'senha_usr' => Input::get('senha_usr')
        //'email_usr' => 'marcelo@cbkdigital.com.br',
        //'senha_usr' => '123'
        //'senha_usr' => sha1(Input::get('senha_usr'))
        //'senha_usr' => Hash::make(Input::get('senha_usr'))
    );*/

    $user = Usuarios
        ::where('email_usr', Input::get('email_usr'))
        ->where('senha_usr', sha1(Input::get('senha_usr')))
        ->first();

    if($user->id_usr) {
        Auth::login($user);
        return Redirect::to('/inicio')
            ->with('flash_notice', 'You are successfully logged in.');
    }

    /*if (Auth::attempt($user)) {
        return Redirect::to('inicio')
            ->with('flash_notice', 'You are successfully logged in.');
    }*/

    // authentication failure! lets go back to the login page
    return Redirect::to('entrar')
        ->with('flash_error', 'your username/password combination was incorrect.')
        //->with('user', $user->email_usr)
        ->withinput();
});

Route::get      ('entrar'                       , array('uses' => 'ConteudoController@entrar'))->before('guest');
Route::get      ('/'                            , array('uses' => 'ConteudoController@Index'))->before('auth');
Route::get      ('inicio'                       , array('uses' => 'ConteudoController@Index'))->before('auth');

Route::get      ('eventos'                   , array('uses' => 'EventosController@index'))->before('auth');
Route::get      ('eventos/inserir'           , array('uses' => 'EventosController@create'))->before('auth');
Route::post     ('eventos'                   , array('uses' => 'EventosController@store'))->before('auth');
Route::get      ('eventos/{param}'           , array('uses' => 'EventosController@show'))->before('auth');
Route::get      ('eventos/{param}/editar'    , array('uses' => 'EventosController@edit'))->before('auth');
Route::post     ('eventos/{param}'           , array('uses' => 'EventosController@update'))->before('auth');
Route::delete   ('eventos/{param}'           , array('uses' => 'EventosController@destroy'))->before('auth');

Route::get      ('submissoes'                   , array('uses' => 'SubmissoesController@index'))->before('auth');
Route::get      ('submissoes/inserir'           , array('uses' => 'SubmissoesController@create'))->before('auth');
Route::post     ('submissoes'                   , array('uses' => 'SubmissoesController@store'))->before('auth');
Route::get      ('submissoes/{param}'           , array('uses' => 'SubmissoesController@show'))->before('auth');
Route::get      ('submissoes/{param}/editar'    , array('uses' => 'SubmissoesController@edit'))->before('auth');
Route::post     ('submissoes/{param}'           , array('uses' => 'SubmissoesController@update'))->before('auth');
Route::delete   ('submissoes/{param}'           , array('uses' => 'SubmissoesController@destroy'))->before('auth');

Route::get      ('usuarios'                     , array('uses' => 'UsuariosController@index'))->before('auth');
Route::get      ('usuarios/inserir'             , array('uses' => 'UsuariosController@create'))->before('auth');
Route::post     ('usuarios'                     , array('uses' => 'UsuariosController@store'))->before('auth');
//Route::get      ('usuarios/{param}'             , array('uses' => 'UsuariosController@show'))->before('auth');
Route::get      ('usuarios/{param}/editar'      , array('uses' => 'UsuariosController@edit'))->before('auth');
Route::post     ('usuarios/{param}'             , array('uses' => 'UsuariosController@update'))->before('auth');
Route::delete   ('usuarios/{param}'             , array('uses' => 'UsuariosController@destroy'));
//Route::get ('usuarios'                   , array('uses' => 'ConteudoController@ListUsuarios'))->before('auth');
//Route::resource ('usuarios/inserir'      , 'ConteudoController@NewUsuarios');
//Route::resource('/api/conteudo', 'ApiConteudoController');
//Route::get('/{not}', function(){ return View::make('404'); });
