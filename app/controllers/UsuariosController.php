<?php

class UsuariosController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 */
	public function index()
	{
        $usuarios = Usuarios::paginate(20);
        return View::make('ListUsuarios')
            ->with(Config::get('Globals'))
            ->with(
                array(
                     'menu'=>ConteudoController::menu()
                    ,'usuarios'=>$usuarios
                )
            )
        ;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 */
	public function create()
	{
        return View::make('SetUsuarios')
            ->with(Config::get('Globals'))
            ->with(
                array(
                    'menu'=>ConteudoController::menu(),
                )
            )
        ;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 */
	public function store()
	{
        $rules = array(
            'nome_usr'                  => ['required', 'unique:susa_usuarios_usr'],
            'email_usr'                 => ['required', 'email', 'unique:susa_usuarios_usr'],
            'ra_usr'                    => ['required', 'min:10', 'max:10'],
            'cgu_usr'                   => ['required', 'min:8', 'max:8'],
            'senha_usr'                 => ['required', 'min:8', 'Confirmed'],//Regex:/^([a-z])+$/i
            'senha_usr_confirmation'    => ['required', 'min:8'],
        );

        $messages = array(
            'nome_usr.unique' => 'Este <b>nome</b> já foi cadastrado!',
            'email_usr.unique' => 'Este <b>e-mail</b> já foi cadastrado!',
        );

        $validation = Validator::make(Input::all(), $rules, $messages);

        //return var_dump($validation->messages()->get('nome_usr'));
        if (!($validation->fails())) {
            $usuarios = new Usuarios();
            $usuarios->nome_usr         = $_POST['nome_usr'];
            $usuarios->email_usr        = $_POST['email_usr'];
            $usuarios->ra_usr           = $_POST['ra_usr'];
            $usuarios->cgu_usr          = $_POST['cgu_usr'];
            $usuarios->first_date_usr   = date("Y-m-d H:i:s");

            if ($_POST['senha_usr']){
                $usuarios->senha_usr = sha1($_POST['senha_usr']);
                //$usuarios->senha_usr = Hash::make($_POST['senha_usr']);
            }

            $response = json_encode($usuarios->save());
        }

        $id = $usuarios->nome_usr;
        //Mensagem->
        $acao = 'inserido';
        if ($response)      {$menssagem[] = '<b>'.$usuarios->nome_usr.'</b> '.$acao.' com sucesso!';}

        if ($validation->messages()->get('nome_usr'))       {$menssagem[] = $validation->messages()->first('nome_usr');}
        if ($validation->messages()->get('email_usr'))      {$menssagem[] = $validation->messages()->first('email_usr');}

        if (!($menssagem[0]))      {$menssagem[] = 'Ops! Um <b>problema</b> aconteceu. <b>Tente novamente</b> mais tarde.';}
        //Mensagem<-

        $resp = json_encode([
             'response'         =>$response
            ,'menssagem'        =>$menssagem
            //,'respArquivos'     =>$respArquivos
            ,'id'               =>$id
        ]);
        return Redirect::action('UsuariosController@index')
            ->with(['resp'=>$resp]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 */
	public function edit($id)
	{
        if ($id>0){
            $usuarios = Usuarios::find($id);
            if ($usuarios){
                return View::make('SetUsuarios')
                    ->with(Config::get('Globals'))
                    ->with(
                        array(
                            'menu'=>ConteudoController::menu(),
                            'usuarios'=>$usuarios,
                            //'resp'=>$resp,
                        )
                    )
                    ;
            } else {App::abort(404);}
        }
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
     * @return Response
	 */
	public function update($id)
	{
        if($id>0) {
            $rules = array(
                'nome_usr'                  => ['required', 'unique:susa_usuarios_usr,nome_usr,'.$id.',id_usr'],
                'email_usr'                 => ['required', 'email', 'unique:susa_usuarios_usr,email_usr,'.$id.',id_usr'],
                'ra_usr'                    => ['required', 'min:10', 'max:10'],
                'cgu_usr'                   => ['required', 'min:8', 'max:8'],
                'senha_usr'                 => ['min:8', 'Confirmed'],//Regex:/^([a-z])+$/i
                'senha_usr_confirmation'    => ['min:8'],
            );

            $messages = array(
                'nome_usr.unique' => 'Este <b>nome</b> já foi cadastrado!',
                'email_usr.unique' => 'Este <b>e-mail</b> já foi cadastrado!',
            );

            $validation = Validator::make(Input::all(), $rules, $messages);
            //return var_dump($validation->messages());
            if (!($validation->fails())) {
                $usuarios = Usuarios::find($id);
                $usuarios->nome_usr     = $_POST['nome_usr'];
                $usuarios->email_usr    = $_POST['email_usr'];
                $usuarios->ra_usr       = $_POST['ra_usr'];
                $usuarios->cgu_usr      = $_POST['cgu_usr'];

                if ($_POST['senha_usr']){
                    $usuarios->senha_usr = sha1($_POST['senha_usr']);
                    //$usuarios->senha_usr = Hash::make($_POST['senha_usr']);
                }

                $response = json_encode($usuarios->save());
            }

            //$id = $usuarios->nome_usr;
            //Mensagem->
            $acao = 'atualizado';
            if ($response)      {$menssagem[] = '<b>'.$usuarios->nome_usr.'</b> '.$acao.' com sucesso!';}

            if ($validation->messages()->get('nome_usr'))       {$menssagem[] = $validation->messages()->first('nome_usr');}
            if ($validation->messages()->get('email_usr'))      {$menssagem[] = $validation->messages()->first('email_usr');}

            if (!($menssagem[0]))      {$menssagem[] = 'Ops! Um <b>problema</b> aconteceu. <b>Tente novamente</b> mais tarde.';}
            //Mensagem<-

            $resp = json_encode([
                 'response'         =>$response
                ,'menssagem'        =>$menssagem
                //,'respArquivos'     =>$respArquivos
                ,'id'               =>$id
            ]);
            return Redirect::action('UsuariosController@index')
                ->with(['resp'=>$resp]);
        } else App::abort(404);
	}

    public function updateStatus($id)
    {
        if($id>0) {
            $usuarios = Usuarios::find($id);
            if ($usuarios->status_usr) {
                $usuarios->status_usr = NULL;
            }else {
                $usuarios->status_usr = 1;
            }
            $resp = $usuarios->save();

            //Recarrega pagina via jQuery na view
            return json_encode(array(
                'id'=>$id,
                'resp'=>$resp,
            ));
        }
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
     * @return Response
	 */
	public function destroy($id)
	{
        if($id>0) {
            $usuarios = Usuarios::find($id);
            $resp = $usuarios->delete();

            $acao = 'deletado';
            if ($resp)          {$menssagem[] = '<b>'.ucwords($acao).'</b> com sucesso!';}

            //Recarrega pagina via jQuery na view
            return json_encode([
                'id'=>$id,
                'response'=>$resp,
                'menssagem'=>$menssagem,
            ]);
        }
	}

}