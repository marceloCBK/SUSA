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



Route::get      ('logout'                       , array('uses' => 'AuthController@logout'));
Route::post     ('entrar'                       , array('uses' => 'AuthController@login'));

Route::get      ('entrar'                       , array('uses' => 'ConteudoController@entrar'))->before('guest');
Route::get      ('/'                            , array('uses' => 'ConteudoController@Index'))->before('auth');
Route::get      ('inicio'                       , array('uses' => 'ConteudoController@Index'))->before('auth');

Route::group(['before' => 'auth|permit'],function(){
    //EVENTOS -->
    Route::get      ('eventos'                   , array('uses' => 'EventosController@index'));
    Route::get      ('eventos/inserir'           , array('uses' => 'EventosController@create'));
    Route::post     ('eventos'                   , array('uses' => 'EventosController@store'));
    //Route::get      ('eventos/{param}'           , array('uses' => 'EventosController@show'));
    Route::get      ('eventos/{param}/editar'    , array('uses' => 'EventosController@edit'));
    Route::post     ('eventos/{param}'           , array('uses' => 'EventosController@update'));
    Route::delete   ('eventos/{param}'           , array('uses' => 'EventosController@destroy'));
    //EVENTOS <--

    //CURSOS -->
    Route::get      ('cursos'                   , array('uses' => 'CursosController@index'));
    Route::get      ('cursos/inserir'           , array('uses' => 'CursosController@create'));
    Route::post     ('cursos'                   , array('uses' => 'CursosController@store'));
    //Route::get      ('cursos/{param}'           , array('uses' => 'CursosController@show'));
    Route::get      ('cursos/{param}/editar'    , array('uses' => 'CursosController@edit'));
    Route::post     ('cursos/{param}'           , array('uses' => 'CursosController@update'));
    Route::delete   ('cursos/{param}'           , array('uses' => 'CursosController@destroy'));
    //CURSOS <--

    //SUBMISSOES -->
    Route::get      ('submissoes'                   , array('uses' => 'SubmissoesController@index'));
    Route::get      ('submissoes/inserir'           , array('uses' => 'SubmissoesController@create'));
    Route::post     ('submissoes'                   , array('uses' => 'SubmissoesController@store'));
    Route::get      ('submissoes/{param}'           , array('uses' => 'SubmissoesController@show'));
    Route::get      ('submissoes/{param}/editar'    , array('uses' => 'SubmissoesController@edit'));
    Route::post     ('submissoes/{param}'           , array('uses' => 'SubmissoesController@update'));
    Route::patch    ('submissoes/{param}'           , array('uses' => 'SubmissoesController@updateStatus'));
    Route::delete   ('submissoes/{param}'           , array('uses' => 'SubmissoesController@destroy'));
    //SUBMISSOES <--

    //USUARIOS -->
    Route::get      ('usuarios'                     , array('uses' => 'UsuariosController@index'));
    Route::get      ('usuarios/inserir'             , array('uses' => 'UsuariosController@create'));
    Route::post     ('usuarios'                     , array('uses' => 'UsuariosController@store'));
    //Route::get      ('usuarios/{param}'             , array('uses' => 'UsuariosController@show'));
    Route::get      ('usuarios/{param}/editar'      , array('uses' => 'UsuariosController@edit'));
    Route::patch    ('usuarios/{param}'             , array('uses' => 'UsuariosController@updateStatus'));
    Route::post     ('usuarios/{param}'             , array('uses' => 'UsuariosController@update'));
    Route::delete   ('usuarios/{param}'             , array('uses' => 'UsuariosController@destroy'));
    //USUARIOS <--
});
//Route::get ('usuarios'                   , array('uses' => 'ConteudoController@ListUsuarios'));
//Route::resource ('usuarios/inserir'      , 'ConteudoController@NewUsuarios');
//Route::resource('/api/conteudo', 'ApiConteudoController');
//Route::get('/{not}', function(){ return View::make('404'); });
