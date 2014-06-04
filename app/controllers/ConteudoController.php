<?php

class ConteudoController extends \BaseController {

    public function menu()
    {
        $menu = ModuloMdl
            ::where('status_mod', 1)
            ->where('status_menu_mod', 1)
            ->where('id_fk_mod', null)
            ->orderBy('nome_mod', 'asc')
            ->get();

        return $menu;
    }

    public function CharSP($palavra) //Remove caracteres especiais e acentuação
    {
        $texto = mb_strtolower($palavra, 'UTF-8');
        $texto = preg_replace("(á|à|ã|â|ä)",		"a",$texto);
        $texto = preg_replace("(é|è|ê|ë)",			"e",$texto);
        $texto = preg_replace("(í|ì|î|ï)",			"i",$texto);
        $texto = preg_replace("(ó|ò|õ|ô|ö)",	    "o",$texto);
        $texto = preg_replace("(ú|ù|û|ü)",			"u",$texto);
        $texto = str_replace("ç",					"c",$texto);

        return preg_replace("/[^a-zA-Z ]/", "", $texto);
    }

    public function Uploader($fileName, $idCon, $titulo=null, $idArea='avulsos') //Remove caracteres especiais e acentuação
    {
        if (Input::hasFile($fileName) && $idCon){

            $file = Input::file($fileName);
            $path = "/uploads/".$idArea."/".$idCon;
            $destinationPath = $_SERVER['DOCUMENT_ROOT'].$path;
            $extension = $file->getClientOriginalExtension(); //Armazena extensão do arquivo enviado

            $filename = (($titulo)
                ?camel_case($titulo).'.'.$extension
                :'Arquivo.'.$extension
            );//Altera o nome do arquivo
            //$filename = $file->getClientOriginalName();

            $upload_success = $file->move($destinationPath, $filename); //Move o arquivo para sua pasta definitiva

            if(!$upload_success) {
                $error = 'Upload não realizado! Arquivo não foi movido';
            }
        } else {
            if ($idCon) {$error = 'Upload não realizado! Submissão referente não foi encontrada';
            } else {     $error = 'Upload não realizado! Arquivo não encontrado';}
        }

        $result = array('resp'=>$upload_success, 'caminho'=>$path, 'nome'=>$filename, 'error'=>$error);
        return $result;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function Entrar()
    {
        return View::make('Entrar')
            ->with(Config::get('Globals'))
            ->with(
                array(
                    'menu'=>ConteudoController::menu()
                )
            )
            ;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function Index()
    {
        return View::make('Default')
            ->with(Config::get('Globals'))
            ->with(
                array(
                    'menu'=>ConteudoController::menu()
                )
            )
            ;
    }

    /**
     * Display a listing of the resource.
     *x
     * @return Response
     */
    public function ListUsuarios()
    {
        //$route = Route::getCurrentRoute()->getPath();

        return View::make('ListUsuarios')
            ->with(Config::get('Globals'))
            ->with(
                array(
                    'menu'=>ConteudoController::menu()
                )
            )
            ;
    }

    public function NewUsuarios()
    {
        //$route = Route::getCurrentRoute()->getPath();


        return View::make('NewUsuarios')
        ->with(Config::get('Globals'))
            ->with(
                array(
                    'menu'=>ConteudoController::menu()
                )
            )
            ;
    }

}