<?php

class AuthController extends \BaseController {

	public function logout()
	{
        Auth::logout();
        $respAuth = json_encode([
            'response' => false,
            'menssagem' => ['Você saiu do sistema!'],
        ]);
        return Redirect::to('entrar')
            ->with(array('respAuth'=>$respAuth));
	}

	public function login()
	{
        /* Testes com "Auth::attempt"
         $user = array(
            'email_usr' => Input::get('email_usr'),
            'senha_usr' => Input::get('senha_usr')
            //'email_usr' => 'marcelo@cbkdigital.com.br',
            //'senha_usr' => '123'
            //'senha_usr' => sha1(Input::get('senha_usr'))
            //'senha_usr' => Hash::make(Input::get('senha_usr'))
        );
        */

        $user = Usuarios
            ::where('email_usr', Input::get('email_usr'))
            ->where('senha_usr', sha1(Input::get('senha_usr')))
            ->first();

        if($user->id_usr) {
            Auth::login($user);
            $respAuth = json_encode([
                'response' => true,
                'menssagem' => ['Olá, '.$user->nome_usr.'! Você logou no SUSA!!!!'],
            ]);
            return Redirect::to('inicio')
                ->with(array('respAuth'=>$respAuth));
        }

        // authentication failure! lets go back to the login page
        $respAuth = json_encode([
            'response' => false,
            'menssagem' => ['O login/senha está errado!'],
        ]);
        return Redirect::to('entrar')
            ->with(array('respAuth'=>$respAuth))
            //->with('user', $user->email_usr)
            ->withinput();
	}

}