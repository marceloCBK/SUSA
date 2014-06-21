@extends ('layouts.template')

<?php
$id = $conteudos->id_con; //verifica se é existem valores a serem editados
$title = (($id)?'Editar Trabalho "'.$conteudos->titulo_con.'"':'Novo Trabalho');
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
                    <label class="control-label" for="inputSuccess">Titulo</label>
                    <input type="text" class="form-control"<?php $fieldName = 'titulo_con'; echo ' id="'.$fieldName.'" name="'.$fieldName.'"'.(($id)?' value="'.$conteudos->$fieldName.'"':''); ?> />
                </div>
                @if ($cursos[0])
                <div class="form-group">
                    <?php
                    echo Form::label(($fieldName = 'id_cur_con'), ($labelname = 'Cursos').':', array('class'=>'control-label', 'for' => 'inputWarning'));

                    foreach ($cursos as $cursosRow) {
                        $List[$cursosRow->id_cur] = $cursosRow->nome_cur;
                    }
                    echo Form::select($fieldName, $List, $conteudos->$fieldName,['class'=>'form-control']);
                    unset($List);
                    ?>
                </div>
                @endif
                @if ($eventos[0])
                <div class="form-group">
                    <?php
                    echo Form::label(($fieldName = 'id_evt_con'), ($labelname = 'Eventos').':', array('class'=>'control-label', 'for' => 'inputWarning'));

                    foreach ($eventos as $eventosRow) {
                        $List[$eventosRow->id_evt] = $eventosRow->nome_evt;
                    }
                    echo Form::select($fieldName, $List, $conteudos->$fieldName,['class'=>'form-control']);
                    unset($List);
                    ?>
                </div>
                @endif
                <div class="form-group">
                    <label class="control-label" for="inputWarning">Autores</label>
                <?php
                $fieldName = 'autores_con[]';
                $autoresText = function ($fieldName,$autoresRow=null) {
                    return '
                        <div class="form-group input-group" id="Mais">
                            <input type="text" class="form-control id="'.$fieldName.'" name="'.$fieldName.'"'.(($autoresRow->nome_cus)?' value="'.$autoresRow->nome_cus.'"':'').'>
                            <span type="button" class="btn btn-info btn-circle input-group-addon Plus" onclick="clonar()"><i class="fa fa-plus"></i></span>
                        </div>
                    ';
                };

                if($conteudos->autores[0]) {
                    foreach($conteudos->autores as $autoresRow){
                        echo $autoresText($fieldName,$autoresRow);
                    }
                } else {
                    echo $autoresText($fieldName);
                }
                ?>
                </div>
                <div class="form-group">
                    <!--<label class="control-label" for="inputWarning">Resumo</label>-->
                    <?php $fieldName = 'nome_arq'; echo '<input type="file" data-filename-placement="inside" class="file-inputs" id="'.$fieldName.'" name="'.$fieldName.'">';?>
                </div>
                <div class="form-group">
                    <label class="control-label">Resumo</label>
                    <?php $fieldName = 'descricao_con'; echo '<textarea class="form-control" id="'.$fieldName.'" name="'.$fieldName.'" rows="5">'.(($id)?''.$conteudos->$fieldName.'':'').'</textarea>';?>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-outline btn-default">Salvar</button>
                    <div class="checkbox Status">
                        <?php
                            echo '
                            <label for="'.($fieldName = 'status_con').'">
                                '.($labelname = 'Status')
                                 .Form::checkbox($fieldName, 1, $conteudos->$fieldName,['class' => 'Radio Box']).'
                            </label>';
                        ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@stop

@section('scripts')
<script src="/js/jquery-validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript">
    function clonar (){
        $( "#Mais" ).clone().appendTo( ".MaisUm" );
        //$( ".Mais" ).append('<div class="form-group input-group"><input type="text" class="form-control"<?php $fieldName = 'autores_usr[]'; echo ' id="'.$fieldName.'" name="'.$fieldName.'"'.(($id)?' value="'.$conteudos->email_usr.'"':'');?>></div>');
    }
    //Validation ->
    $(function() {
        $('.file-inputs').bootstrapFileInput();

        $('form').validate({
            messages: {
                titulo_con: {
                    required: "Este campo é necessário!",
                    minlength: $.validator.format("Por favor, insira pelo menos {0} caracteres!")
                },
                autores_con: {
                    required: "Este campo é necessário!",
                    minlength: $.validator.format("Por favor, insira pelo menos {0} caracteres!")
                },
                descricao_con: {
                    required: "Este campo é necessário!",
                    minlength: $.validator.format("Por favor, insira pelo menos {0} caracteres!")
                }
            },
            rules: {
                 titulo_con: {
                    minlength: 3,
                    //maxlength: 15,
                    required: true
                }
                ,autores_con: {
                    //minlength: 3,
                    //maxlength: 15,
                    required: true,
                    email: true
                }
                ,descricao_con: {
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
    //Vilidation <-
    });
</script>
@stop