@extends ('layouts.template')

<?php $title = 'Cursos'; ?>
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
    ?>
</div>
<div class="row">
    <div class="panel panel-default">
        <div class="panel-body">
            <?php
            //TODO Criar BoxModal para confirmações (Tem certeza que deseja deletar isso?)
            //TODO Mostrar autor(es) do trabalho submetido
            if ($cursos[0]) {
                foreach ($cursos as $cursosRow) { //DADOS
                    $cursosPrint .= '
                    <tr'.(($resp->id==$cursosRow->id_cur)?' class="Marcar"':'').'>
                        <td>'.$cursosRow->nome_cur.'</td>
                        <td>'.$cursosRow->descricao_cur.'</td>
                        <td>'.date("d/m/Y",strtotime($cursosRow->first_date_cur)).'</td>
                        <td>'.(($cursosRow->status_cur)
                            ?'<div type="button" class="btn btn-success btn-circle"><i class="fa fa-thumbs-up"></i></div>'
                            :'<div type="button" class="btn btn-danger btn-circle"><i class="fa fa-thumbs-down"></i></div>').'</td>
                        <td>
                        <div>
                            './*'<a type="button" title="Ver '.$cursosRow->nome_cur.'" class="btn btn-info btn-circle ver" href="'.(($route)?$route.'/'.$cursosRow->id_cur:'').'" ><i class="fa fa-file"></i></a>'.*/'
                            <a type="button" title="Editar '.$cursosRow->nome_cur.'" class="btn btn-warning btn-circle alterar" href="'.(($route)?$route.'/'.$cursosRow->id_cur.'/editar':'').'" ><i class="fa fa-edit"></i></a>
                            <a type="button" title="Deletar '.$cursosRow->nome_cur.'" class="btn btn-danger btn-circle deletar" href="'.(($route)?$route.'/'.$cursosRow->id_cur:'').'"><i class="fa fa-times"></i></a>
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
                            <th>Titulo</th>
                            <th class="col-lg-6">Resumo</th>
                            <th>Desde</th>
                            <th>Status</th>
                            <th class="col-lg-1">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        '.$cursosPrint.'
                        </tbody>
                    </table>
                </div>
                <div class="Center">
                '. $cursos->links().'
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

                if (reponse.resp || reponse.respAutores) {
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

