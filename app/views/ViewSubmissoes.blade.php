@extends ('layouts.template')

<?php
$id = $conteudos->id_con; //verifica se é existem valores a serem editados
$title = $conteudos->titulo_con;
?>
@section('title')
<% $siteName.' - '.$title %>
@stop

@section('conteudo')
<style>
    .alterar {margin-bottom: 10px;}
</style>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><% $title %></h1>
        <?php
        echo '
         <a type="button" class="btn btn-warning btn-square alterar" href="'.(($route)?$route.'/'.$conteudos->id_con.'/editar':'').'" ><i class="fa fa-edit"></i> Editar</a>
        ';
        ?>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
<?php
if ($conteudos->autores[0]){
    echo '
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">Autores</div>
            <div class="panel-body">
            ';
            foreach ($conteudos->autores as $autoresRow) {
                echo '
                <div class="col-lg-12 text-primary">'.$autoresRow->nome_cus.'</div>
                ';
            }
            echo '
            </div>
        </div>
    </div>
    ';
}
if ($conteudos->arquivos[0]){
    echo '
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">Arquivos Enviados</div>
            <div class="panel-body">
            ';
            foreach ($conteudos->arquivos as $arquivosRow) {
                $fileName = $arquivosRow->nome_arq;
                $path = $arquivosRow->caminho_arq.'/';
                echo '
                <a class="col-lg-12 text-primary" href="'.$path.$fileName.'" title="'.$fileName.'" download>'.$fileName.'</a>
                ';
            }
            echo '
            </div>
        </div>
    </div>
    ';
}
?>
    <div class="col-lg-12">
        <div class="well">
            <?php
            echo '
            <h4>Resumo</h4>
            <div>'.$conteudos->descricao_con.'</div>
            ';
            ?>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="chat-panel panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-comments fa-fw"></i>
                Mensagens
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <ul class="chat">
                    <li class="left clearfix">
                        <span class="chat-img pull-left"><img src="http://placehold.it/50/55C1E7/fff" alt="User Avatar" class="img-circle"></span>
                        <div class="chat-body clearfix">
                            <div class="header">
                                <strong class="primary-font">Jack Sparrow</strong>
                                <small class="pull-right text-muted"><i class="fa fa-clock-o fa-fw"></i> 12 mins ago</small>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.</p>
                        </div>
                    </li>
                    <li class="right clearfix">
                        <span class="chat-img pull-right"><img src="http://placehold.it/50/FA6F57/fff" alt="User Avatar" class="img-circle"></span>
                        <div class="chat-body clearfix">
                            <div class="header">
                                <strong class="pull-right primary-font">Bhaumik Patel</strong>
                                <small class=" text-muted"><i class="fa fa-clock-o fa-fw"></i> 13 mins ago</small>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.</p>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- /.panel-body -->
            <div class="panel-footer">
                <div class="input-group">
                    <input id="btn-input" type="text" class="form-control input-sm" placeholder="Digite sua mensagem aqui...">
                    <span class="input-group-btn"><button class="btn btn-warning btn-sm" id="btn-chat">Send</button></span>
                </div>
            </div>
            <!-- /.panel-footer -->
        </div>
    </div>
</div>
@stop

@section('scripts')
@stop