<?php

class AuthController extends \BaseController {

	public function logout()
	{
        Auth::logout();
        return Redirect::to('/entrar')
            ->with('flash_notice', 'Voce saiu do sistema!');
	}

	public function login()
	{
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
                ->with('flash_notice', 'Olá, '.$user->nome_usr.'! Você logou no SUSA!!!');
        }

        /*if (Auth::attempt($user)) {
            return Redirect::to('inicio')
                ->with('flash_notice', 'You are successfully logged in.');
        }*/

        // authentication failure! lets go back to the login page
        return Redirect::to('entrar')
            ->with('flash_error', 'O login/senha está errado!')
            //->with('user', $user->email_usr)
            ->withinput();
	}

}