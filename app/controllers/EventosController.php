<?php

class EventosController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $eventos = Eventos::orderBy('data_fim_evt', 'ASC')->orderBy('nome_evt', 'ASC')->orderBy('id_evt', 'DESC')->paginate(20);
        return View::make('ListEventos')
            ->with(Config::get('Globals'))
            ->with(
                array(
                    'menu'=>ConteudoController::menu()
                    ,'eventos'=>$eventos
                )
            )
            ;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('SetEventos')
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
	 * @return Response
	 */
	public function store()
	{
        if (!empty($_POST['nome_evt']) && !empty($_POST['descricao_evt']) && !empty($_POST['data_ini_evt']) && !empty($_POST['data_fim_evt'])) {
            $eventos = new Eventos();

            $eventos->nome_evt = Input::get('nome_evt');
            $eventos->descricao_evt = Input::get('descricao_evt');
            //$eventos->first_date_con = date("Y-m-d H:i:s");
            $eventos->data_ini_evt = DateTime::createFromFormat('d/m/Y', Input::get('data_ini_evt'))->format('Y-m-d'); //Converte data "dd/mm/YYYY" para o tipo padrao timestamp
            $eventos->data_fim_evt = DateTime::createFromFormat('d/m/Y', Input::get('data_fim_evt'))->format('Y-m-d'); //Converte data "dd/mm/YYYY" para o tipo padrao timestamp
            var_dump($respEventos = $eventos->save());

            //Resposta final
            $response = $respEventos;

            //Mensagem->
            $acao = 'inserido';
            if ($respEventos)   {$menssagem[] = '<b>'.$eventos->titulo_con.'</b> '.$acao.' com sucesso!';}
            if (!$response)     {$menssagem[] = 'Ops! Um <b>problema</b> aconteceu. <b>Tente novamente</b> mais tarde.';}
            //Mensagem<-

        } else $menssagem[] = 'Registro <b>não foi salvo!</b> Informe <b>todos os dados</b> na próxima vez!';
        $resp = json_encode(array(
             'response'         =>$response
            ,'respEventos'      =>$respEventos
            ,'menssagem'        =>$menssagem
            ,'id'               =>$eventos->id_evt
            ,'error'            =>$error
        ));

        return Redirect::action('EventosController@index')
            ->with(array('resp'=>$resp));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        if ($id>0){
            $eventos = Eventos::find($id);
            if ($eventos){
                return View::make('ViewEventos')
                    ->with(Config::get('Globals'))
                    ->with(
                        array(
                            'menu'=>ConteudoController::menu(),
                            'eventos'=>$eventos
                        )
                    )
                    ;
            } else {App::abort(404);}
        } else {App::abort(404);}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        if ($id>0){
            $eventos = Eventos::find($id);
            if ($eventos){
                return View::make('SetEventos')
                    ->with(Config::get('Globals'))
                    ->with(
                        array(
                            'menu'=>ConteudoController::menu(),
                            'eventos'=>$eventos,
                            //'resp'=>$resp,
                        )
                    )
                    ;
            } else {App::abort(404);}
        } else {App::abort(404);}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if ($id>0){
            if (!empty($_POST['nome_evt']) && !empty($_POST['descricao_evt']) && !empty($_POST['data_ini_evt']) && !empty($_POST['data_fim_evt'])) {
                $eventos = Eventos::find($id);

                $eventos->nome_evt = Input::get('nome_evt');
                $eventos->descricao_evt = Input::get('descricao_evt');
                //$eventos->first_date_con = date("Y-m-d H:i:s");
                $eventos->data_ini_evt = DateTime::createFromFormat('d/m/Y', Input::get('data_ini_evt'))->format('Y-m-d'); //Converte data "dd/mm/YYYY" para o tipo padrao timestamp
                $eventos->data_fim_evt = DateTime::createFromFormat('d/m/Y', Input::get('data_fim_evt'))->format('Y-m-d'); //Converte data "dd/mm/YYYY" para o tipo padrao timestamp
                var_dump($respEventos = $eventos->save());

                //Resposta final
                $response = $respEventos;

                //Mensagem->
                $acao = 'inserido';
                if ($respEventos)   {$menssagem[] = '<b>'.$eventos->titulo_con.'</b> '.$acao.' com sucesso!';}
                if (!$response)     {$menssagem[] = 'Ops! Um <b>problema</b> aconteceu. <b>Tente novamente</b> mais tarde.';}
                //Mensagem<-

            } else $menssagem[] = 'Registro <b>não foi salvo!</b> Informe <b>todos os dados</b> na próxima vez!';
            $resp = json_encode(array(
                'response'         =>$response
            ,'respEventos'      =>$respEventos
            ,'menssagem'        =>$menssagem
            ,'id'               =>$eventos->id_evt
            ,'error'            =>$error
            ));

            return Redirect::action('EventosController@index')
                ->with(array('resp'=>$resp));
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
            $eventos = Eventos::find($id);
            $resp = $eventos->delete();

            //Recarrega pagina via jQuery na view
            return json_encode(array(
                'id'=>$id,
                'resp'=>$resp
            ));
        }
	}

}