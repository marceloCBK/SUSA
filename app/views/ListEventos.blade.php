@extends ('layouts.template')

<?php $title = 'Eventos'; ?>
@section('title')
<% $siteName.' - '.$title %>
@stop

@section('conteudo')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><% $title %></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">

<?php
$resp = json_decode(Session::get('resp'));
if ($resp){
    $mensagem = implode('<br />', $resp->menssagem);
    echo '
    <div class="alert'.(($resp->response)?' alert-success':' alert-danger').' alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        '.$mensagem.'
    </div>
    ';
}
?>
</div>
<div class="row">
    <div class="panel panel-default">
        <div class="panel-body">
            <?php
            //TODO Criar BoxModal para confirmações (Tem certeza que deseja deletar isso?)
            if ($eventos[0]) {
                foreach ($eventos as $eventosRow) { //DADOS
                    $eventosPrint .= '
                    <tr'.(($resp->id==$eventosRow->id_evt)?' class="Marcar"':'').'>
                        <td>'.$eventosRow->nome_evt.'</td>
                        <td>'.$eventosRow->descricao_evt.'</td>
                        <td>'.date("d/m/Y",strtotime($eventosRow->data_ini_evt)).'</td>
                        <td>'.date("d/m/Y",strtotime($eventosRow->data_fim_evt)).'</td>
                        <td>'.(($eventosRow->status_evt)
                            ?'<div type="button" class="btn btn-success btn-circle"><i class="fa fa-thumbs-up"></i></div>'
                            :'<div type="button" class="btn btn-danger btn-circle"><i class="fa fa-thumbs-down"></i></div>').'</td>
                        <td>
                        <div>
                            <a type="button" class="btn btn-warning btn-circle alterar" href="'.(($route)?$route.'/'.$eventosRow->id_evt.'/editar':'').'" ><i class="fa fa-edit"></i></a>
                            <a type="button" class="btn btn-danger btn-circle deletar" href="'.(($route)?$route.'/'.$eventosRow->id_evt:'').'"><i class="fa fa-times"></i></a>
                        </div>
                        </td>
                    </tr>
                    ';
                }

                //ESTRUTURA
                echo '
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th class="col-lg-6">Descrição</th>
                            <th>Inicío</th>
                            <th>Término</th>
                            <th>Status</th>
                            <th class="col-lg-1">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        '.$eventosPrint.'
                        </tbody>
                    </table>
                </div>
                <div class="Center">
                '. $eventos->links().'
                </div>';
            }
            ?>
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                        </div>
                        <div class="modal-body">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')

<?php
echo '
<script>
$(function() {
    $(".deletar").click(function() {
        var url = $(this).attr("href");
        $.ajax({
            url: url,
            type: "DELETE",
            success: function(result) {
                //console.log(result);
                reponse = $.parseJSON(result);

                if (reponse.resp) {
                    location.reload();
                }
            }
        });
        return false;
    });
});
</script>
';
?>
@stop

