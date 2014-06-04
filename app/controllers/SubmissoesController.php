<?php

class SubmissoesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $conteudos = Conteudos::orderBy('last_date_con', 'DESC')->orderBy('id_con', 'DESC')->paginate(20);
        return View::make('ListSubmissoes')
            ->with(Config::get('Globals'))
            ->with(
                array(
                 'menu'=>ConteudoController::menu()
                ,'conteudos'=>$conteudos
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
        return View::make('SetSubmissoes')
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
        if (!empty($_POST['titulo_con']) && !empty($_POST['descricao_con'])) {
            $conteudos = new Conteudos();

            $conteudos->titulo_con = Input::get('titulo_con');
            $conteudos->descricao_con = Input::get('descricao_con');
            $conteudos->first_date_con = date("Y-m-d H:i:s");
            $respConteudos = $conteudos->save();
            $autores_con = Input::get('autores_con');

            if($autores_con[0] && $respConteudos){
                foreach($autores_con as $autoresRow){
                    $autores = new ConteudosUsers();
                    $autores->nome_cus = $autoresRow;

                    $respAutores = $conteudos->autores()->save($autores);
                }
            }

            //Upload->
            $idCon = $conteudos->id_con;//seleciona id da submissão referente
            $titulo = ConteudoController::CharSP($conteudos->titulo_con); //Usa o titulo do trabalho como nome de arquivo
            $fileName = 'nome_arq';
            if(Input::hasFile($fileName)){
                $arquivos   = Arquivos::where('id_fk_arq', $idCon);
                $titulo    .= $arquivos->count();
                $route      = Config::get('Globals')['routeThis'][0];
                $modulo     = ModuloMdl::where('rota_mod','LIKE', '%'.$route.'%')->where('id_fk_mod', null)->get();


                $idArea     = $modulo[0]->id_ars_mod;
                //retorna "Upload não realizado! Arquivo não encontrado!" se o usuario não enviar o arquivo
                $respUp = ConteudoController::Uploader($fileName, $idCon, $titulo, $idArea);
                $error['respUp'] = $respUp['error'];

                if ($respUp['resp']) {
                    $arquivos = new Arquivos();
                    $arquivos->nome_arq = $respUp['nome'];
                    $arquivos->id_fk_arq = $idCon;
                    $arquivos->id_ars_arq = $idArea;
                    $arquivos->caminho_arq = $respUp['caminho'];
                    $respArquivos = $arquivos->save();
                }
            }
            //Upload<-

            //Resposta final
            $response = $respConteudos;

            //Mensagem->
            $acao = 'inserido';
            if ($respConteudos) {$menssagem[] = '<b>'.$conteudos->titulo_con.'</b> '.$acao.' com sucesso!';}
            //if ($respAutores)   {$menssagem[] = '<b>Autor(es)</b> '.$acao.' com sucesso!';}
            if ($respArquivos)  {$menssagem[] = 'Arquivo <b>'.$arquivos->nome_arq.'</b> foi adicionado com sucesso!';}
            if (!$response)      {$menssagem[] = 'Ops! Um <b>problema</b> aconteceu. <b>Tente novamente</b> mais tarde.';}
            //Mensagem<-

        } else $menssagem[] = 'Registro <b>não foi salvo!</b> Informe <b>todos os dados</b> na próxima vez!';
        $resp = json_encode(array(
             'response'         =>$response
            ,'respConteudos'    =>$respConteudos
            ,'respAutores'      =>$respAutores
            ,'menssagem'        =>$menssagem
            //,'autores'          =>$autores_con
            ,'respArquivos'     =>$respArquivos
            ,'id'               =>$idCon
            ,'error'            =>$error
        ));

        return Redirect::action('SubmissoesController@index')
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
            $conteudos = Conteudos::find($id);
            if ($conteudos){
                return View::make('ViewSubmissoes')
                    ->with(Config::get('Globals'))
                    ->with(
                        array(
                            'menu'=>ConteudoController::menu(),
                            'conteudos'=>$conteudos
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
            $conteudos = Conteudos::find($id);
            if ($conteudos){
                return View::make('SetSubmissoes')
                    ->with(Config::get('Globals'))
                    ->with(
                        array(
                            'menu'=>ConteudoController::menu(),
                            'conteudos'=>$conteudos,
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
        if($id>0) {
            if (!empty($_POST['titulo_con']) && !empty($_POST['descricao_con'])) {
                $conteudos = Conteudos::find($id);
                $conteudos->titulo_con       = $_POST['titulo_con'];
                $conteudos->descricao_con    = $_POST['descricao_con'];
                $autores_con = Input::get('autores_con');

                if($autores_con){
                    foreach ($conteudos->autores as $key => $autoresRow) {
                        $conteudos->autores[$key]->nome_cus = $autores_con[$key];
                        unset($autores_con[$key]);
                    }
                    $respPost = $conteudos->push();

                    foreach($autores_con as $autoresRow){
                        $autores = new ConteudosUsers();
                        $autores->nome_cus = $autoresRow;

                        $respAutores = $conteudos->autores()->save($autores);
                    }
                }

                //Upload->
                $idCon = $conteudos->id_con;//seleciona id da submissão referente
                $titulo = ConteudoController::CharSP($conteudos->titulo_con); //Usa o titulo do trabalho como nome de arquivo
                $fileName = 'nome_arq';
                if(Input::hasFile($fileName)){
                    $arquivos   = Arquivos::where('id_fk_arq', $idCon)->get();
                    $titulo    .= (($arquivos->count())?$arquivos->count():'');
                    $route      = Config::get('Globals')['routeThis'][0];
                    $modulo     = ModuloMdl::where('rota_mod','LIKE', '%'.$route.'%')->where('id_fk_mod', null)->get();


                    $idArea     = $modulo[0]->id_ars_mod;
                    //retorna "Upload não realizado! Arquivo não encontrado!" se o usuario não enviar o arquivo
                    $respUp = ConteudoController::Uploader($fileName, $idCon, $titulo, $idArea);
                    $error['respUp'] = $respUp['error'];

                    if ($respUp['resp']) {
                        $arquivos = new Arquivos();
                        $arquivos->nome_arq = $respUp['nome'];
                        $arquivos->id_fk_arq = $idCon;
                        $arquivos->id_ars_arq = $idArea;
                        $arquivos->caminho_arq = $respUp['caminho'];
                        $respArquivos = $arquivos->save();
                    }
                }
                //Upload<-

                //Resposta final
                $response = $respPost;

                //Mensagem->
                $acao = 'atualizado';
                if ($respPost)      {$menssagem[] = '<b>'.$conteudos->titulo_con.'</b> '.$acao.' com sucesso!';}
                if ($respArquivos)  {$menssagem[] = 'Arquivo <b>'.$arquivos->nome_arq.'</b> foi adicionado com sucesso!';}
                if (!$response)      {$menssagem[] = 'Ops! Um <b>problema</b> aconteceu. <b>Tente novamente</b> mais tarde.';}

                //Mensagem<-
            } else $menssagem[] = 'Registro <b>não foi salvo!</b> Informe <b>todos os dados</b> na próxima vez!';

            $resp = json_encode(array(
                 'response'         =>$response
                ,'respPost'         =>$respPost
                ,'menssagem'        =>$menssagem
                //,'autores'          =>$autores_con
                ,'respArquivos'     =>$respArquivos
                ,'id'               =>$idCon
                ,'error'            =>$error
            ));
            return Redirect::action('SubmissoesController@index')
                            ->with(array('resp'=>$resp));

        } else App::abort(404);
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
            $conteudos = Conteudos::find($id);
            $resp = $conteudos->delete();

            $autores = ConteudosUsers::where('id_con_cus', $id);
            $respAutores = $autores->delete();

            //Recarrega pagina via jQuery na view
            return json_encode(array(
                'id'=>$id,
                'resp'=>$resp,
                'respAutores'=>$respAutores
            ));
        }
	}

}