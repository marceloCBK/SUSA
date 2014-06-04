@extends ('layouts.template')

<?php $title = 'Usuários'; ?>
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
    <div class="panel panel-default">
        <div class="panel-body">
            <?php
            //TODO Mensagem de cadastrado com sucesso e marcar o registro cadastrado ou editado na lista
            //TODO Criar BoxModal para confirmações (Tem certeza que deseja deletar isso?)
            if ($usuarios[0]) {
                foreach ($usuarios as $usuariosRow) { //DADOS
                    $usuariosPrint .= '
                    <tr>
                        <td><span class="chat-img pull-left"><img src="http://placehold.it/50/55C1E7/fff" alt="User Avatar" class="img-circle" /></span></td>
                        <td>'.$usuariosRow->nome_usr.'</td>
                        <td>'.$usuariosRow->email_usr.'</td>
                        <td>'.$usuariosRow->ra_usr.'</td>
                        <td>'.$usuariosRow->cgu_usr.'</td>
                        <td>'.date("d/m/Y",strtotime($usuariosRow->first_date_usr)).'</td>
                        <td>'.(($usuariosRow->status_usr)
                            ?'<div type="button" class="btn btn-success btn-circle"><i class="fa fa-thumbs-up"></i></div>'
                            :'<div type="button" class="btn btn-danger btn-circle"><i class="fa fa-thumbs-down"></i></div>').'</td>
                        <td>
                        <div>
                            <a type="button" class="btn btn-warning btn-circle alterar" href="'.(($route)?$route.'/'.$usuariosRow->id_usr.'/editar':'').'" ><i class="fa fa-edit"></i></a>
                            <a type="button" class="btn btn-danger btn-circle deletar" href="'.(($route)?$route.'/'.$usuariosRow->id_usr:'').'"><i class="fa fa-times"></i></a>
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
                            <th>Foto</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>RA</th>
                            <th>CGU</th>
                            <th>Desde</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        '.$usuariosPrint.'
                        </tbody>
                    </table>
                </div>
                <div class="Center">
                '. $usuarios->links().'
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
                resp = $.parseJSON(result);

                if (resp.response) {
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

