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
        $usuarios = new Usuarios();

        $usuarios->nome_usr         = Input::get('nome_usr');
        $usuarios->email_usr        = Input::get('email_usr');
        $usuarios->ra_usr           = Input::get('ra_usr');
        $usuarios->cgu_usr          = Input::get('cgu_usr');
        $usuarios->senha_usr        = sha1(Input::get('senha_usr'));
        //$usuarios->senha_usr        = Hash::make(Input::get('senha_usr'));
        $usuarios->first_date_usr   = date("Y-m-d H:i:s");

        $resp = json_encode($usuarios->save());
        return Redirect::action('UsuariosController@index');
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
            $usuarios = Usuarios::find($id);
            $usuarios->nome_usr     = $_POST['nome_usr'];
            $usuarios->email_usr    = $_POST['email_usr'];
            $usuarios->ra_usr       = $_POST['ra_usr'];
            $usuarios->cgu_usr      = $_POST['cgu_usr'];

            if ($_POST['senha_usr']){
                $usuarios->senha_usr = sha1($_POST['senha_usr']);
                //$usuarios->senha_usr = Hash::make($_POST['senha_usr']);
            }

            $resp = json_encode($usuarios->save());
            return Redirect::action('UsuariosController@index');
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
            $resp = json_encode($usuarios->delete());

            //Recarrega pagina via jQuery na view
            return json_encode(array(
                'id'=>$id,
                'response'=>$resp
            ));
        }
	}

}