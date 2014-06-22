<?php

class CursosController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $cursos = Cursos::orderBy('nome_cur', 'ASC')->orderBy('id_cur', 'DESC')->paginate(20);
        return View::make('ListCursos')
            ->with(Config::get('Globals'))
            ->with(
                array(
                    'menu'=>ConteudoController::menu()
                    ,'cursos'=>$cursos
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
        return View::make('SetCursos')
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
        if (!empty($_POST['nome_cur']) && !empty($_POST['descricao_cur'])) {
            $cursos = new Cursos();

            $cursos->nome_cur = Input::get('nome_cur');
            $cursos->descricao_cur = Input::get('descricao_cur');
            $cursos->first_date_cur = date("Y-m-d H:i:s");
            $respCursos = $cursos->save();

            //Resposta final
            $response = $respCursos;

            //Mensagem->
            $acao = 'inserido';
            if ($respCursos)        {$menssagem[] = '<b>'.$cursos->nome_cur.'</b> '.$acao.' com sucesso!';}
            if (!($menssagem[0]))   {$menssagem[] = 'Ops! Um <b>problema</b> aconteceu. <b>Tente novamente</b> mais tarde.';}
            //Mensagem<-

        } else $menssagem[] = 'Registro <b>não foi salvo!</b> Informe <b>todos os dados</b> na próxima vez!';
        $resp = json_encode(array(
         'response'         =>$response
        ,'respCursos'       =>$respCursos
        ,'menssagem'        =>$menssagem
        ,'id'               =>$cursos->id_cur
        ,'error'            =>$error
        ));

        return Redirect::action('CursosController@index')
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
            $cursos = Cursos::find($id);
            if ($cursos){
                return View::make('ViewCursos')
                    ->with(Config::get('Globals'))
                    ->with(
                        array(
                            'menu'=>ConteudoController::menu(),
                            'cursos'=>$cursos
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
            $cursos = Cursos::find($id);
            if ($cursos){
                return View::make('SetCursos')
                    ->with(Config::get('Globals'))
                    ->with(
                        array(
                            'menu'=>ConteudoController::menu(),
                            'cursos'=>$cursos,
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
            if (!empty($_POST['nome_cur']) && !empty($_POST['descricao_cur'])) {
                $cursos = Cursos::find($id);

                $cursos->nome_cur = Input::get('nome_cur');
                $cursos->descricao_cur = Input::get('descricao_cur');
                //$cursos->first_date_cur = date("Y-m-d H:i:s");
                $respCursos = $cursos->save();

                //Resposta final
                $response = $respCursos;

                //Mensagem->
                $acao = 'inserido';
                if ($respCursos)        {$menssagem[] = '<b>'.$cursos->nome_cur.'</b> '.$acao.' com sucesso!';}
                if (!($menssagem[0]))   {$menssagem[] = 'Ops! Um <b>problema</b> aconteceu. <b>Tente novamente</b> mais tarde.';}
                //Mensagem<-

            } else $menssagem[] = 'Registro <b>não foi salvo!</b> Informe <b>todos os dados</b> na próxima vez!';
            $resp = json_encode(array(
             'response'         =>$response
            ,'respCursos'       =>$respCursos
            ,'menssagem'        =>$menssagem
            ,'id'               =>$cursos->id_cur
            ,'error'            =>$error
            ));

            return Redirect::action('CursosController@index')
                ->with(array('resp'=>$resp));
        }
    }

    public function updateStatus($id)
    {
        if($id>0) {
            $cursos = Cursos::find($id);
            if ($cursos->status_cur) {
                $cursos->status_cur = NULL;
            }else {
                $cursos->status_cur = 1;
            }
            $resp = $cursos->save();

            //Recarrega pagina via jQuery na view
            return json_encode(array(
                'id'=>$id,
                'resp'=>$resp,
                'menssagem'=>$menssagem,
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
            $cursos = Cursos::find($id);
            $resp = $cursos->delete();

            //TODO mensagem de removido com sucesso
            //Recarrega pagina via jQuery na view
            return json_encode(array(
                'id'=>$id,
                'resp'=>$resp
            ));
        }
    }

}