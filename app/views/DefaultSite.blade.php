@extends ('layouts.template')

<?php $title = 'Sistema Ulbra de Submissões Avaliativas'; ?>
@section('title')
<% $siteName.' - '.$title %>
@stop

@section('conteudo')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Início</h1>
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

    /*
    //Mostra mensagem se houver alguma -->
    $respAuth = json_decode(Session::get('respAuth'));
    //var_dump($respAuth);
    if ($respAuth){
        $mensagem = implode('<br />', $respAuth->menssagem);
        echo '
            <div class="alert'.(($respAuth->response)?' alert-success':' alert-danger').' alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                '.$mensagem.'
            </div>
            ';
    }
    //Mostra mensagem se houver alguma <--
    */
    ?>
</div>
@stop