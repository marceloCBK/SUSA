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

Route::get      ('eventos'                   , array('uses' => 'EventosController@index'))->before('auth');
Route::get      ('eventos/inserir'           , array('uses' => 'EventosController@create'))->before('auth');
Route::post     ('eventos'                   , array('uses' => 'EventosController@store'))->before('auth');
//Route::get      ('eventos/{param}'           , array('uses' => 'EventosController@show'))->before('auth');
Route::get      ('eventos/{param}/editar'    , array('uses' => 'EventosController@edit'))->before('auth');
Route::post     ('eventos/{param}'           , array('uses' => 'EventosController@update'))->before('auth');
Route::delete   ('eventos/{param}'           , array('uses' => 'EventosController@destroy'))->before('auth');

Route::get      ('cursos'                   , array('uses' => 'CursosController@index'))->before('auth');
Route::get      ('cursos/inserir'           , array('uses' => 'CursosController@create'))->before('auth');
Route::post     ('cursos'                   , array('uses' => 'CursosController@store'))->before('auth');
//Route::get      ('cursos/{param}'           , array('uses' => 'CursosController@show'))->before('auth');
Route::get      ('cursos/{param}/editar'    , array('uses' => 'CursosController@edit'))->before('auth');
Route::post     ('cursos/{param}'           , array('uses' => 'CursosController@update'))->before('auth');
Route::delete   ('cursos/{param}'           , array('uses' => 'CursosController@destroy'))->before('auth');

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
