@extends ('layouts.templateSite')

<?php
$title = $cursos->nome_cur;
?>
@section('title')
<% $siteName.' - '.$title %>
@stop

@section('conteudo')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><% $title %></h1>
    </div>
</div>

<div class="row">
    <?php
    //Mostra mensagem se houver alguma -->
    $resp = json_decode(Session::get('resp'));
    //print_r($resp);
    if ($resp){
        $mensagem = implode('<br />', $resp->menssagem);
        echo '
        <div class="alert'.(($resp->response)?' alert-success':' alert-danger').' alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            '.$mensagem.'
        </div>
        ';
    }
    //Mostra mensagem se houver alguma <--
    ?>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="well">
            <div><% $cursos->descricao_cur %></div>
        </div>
    </div>
</div>

<div class="row">
    <?php
    if ($conteudos[0]){
    echo '
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">Trabalhos Realizados</div>
            <div class="panel-body">
            ';
        foreach ($conteudos as $arquivosRow) {
            $titulo = $arquivosRow->titulo_con;
            $fileName = $arquivosRow->nome_arq;
            $path = $arquivosRow->caminho_arq.'/';
            echo '
                <a class="col-lg-12 text-primary" href="'.$path.$fileName.'" title="'.$fileName.'" download>'.$titulo.'</a>
                ';
        }
        echo '
            </div>
        </div>
    </div>
    ';
    } else {
        echo '
        <div class="col-lg-6">
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                Nenhum arquivo para este curso!
            </div>
        </div>
        ';
    }
    ?>
</div>
@stop