@extends ('layouts.template')

<?php
$id = $cursos->id_cur; //verifica se é existem valores a serem editados
$title = (($id)?'Editar Evento "'.$cursos->nome_cur.'"':'Novo Evento');
?>
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
    <div class="col-lg-4">
        <form role="form" class="panel panel-default" enctype="multipart/form-data"<?php echo ' method="post" action="'.$route.(($id)?'/'.$id:'').'"';?>>
            <div class="panel-body">

                <div class="form-group">
                    <label class="control-label" for="inputSuccess">Nome</label>
                    <input type="text" class="form-control"<?php $fieldName = 'nome_cur'; echo ' id="'.$fieldName.'" name="'.$fieldName.'"'.(($id)?' value="'.$cursos->$fieldName.'"':''); ?> />
                </div>
                <div class="form-group">
                    <label class="control-label" for="inputWarning">Descrição</label>
                    <?php $fieldName = 'descricao_cur'; echo '<textarea class="form-control" id="'.$fieldName.'" name="'.$fieldName.'" rows="5">'.(($id)?''.$cursos->$fieldName.'':'').'</textarea>';?>
                </div>

                <button type="submit" class="btn btn-outline btn-default">Salvar</button>

            </div>
        </form>
    </div>
</div>
@stop

@section('scripts')
<script src="/js/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="/js/datepicker/js/bootstrap-datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="/js/datepicker/css/datepicker.css" />
<script type="text/javascript">
    $(function() {
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            //startDate: '-3d'
        });

        $('form').validate({
            messages: {
                nome_cur: {
                    required: "Este campo é necessário!",
                    minlength: $.validator.format("Por favor, insira pelo menos {0} caracteres!")
                },
                descricao_cur: {
                    required: "Este campo é necessário!",
                    minlength: $.validator.format("Por favor, insira pelo menos {0} caracteres!")
                }
            },
            rules: {
                nome_cur: {
                    minlength: 3,
                    //maxlength: 15,
                    required: true
                }
                ,descricao_cur: {
                    minlength: 15,
                    //maxlength: 15,
                    required: true
                }

            },
            highlight: function(element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function(element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function(error, element) {
                if(element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            }
        });
    });
</script>
@stop
