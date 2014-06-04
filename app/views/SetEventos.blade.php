@extends ('layouts.template')

<?php
$id = $eventos->id_evt; //verifica se é existem valores a serem editados
$title = (($id)?'Editar Evento "'.$eventos->nome_evt.'"':'Novo Evento');
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
    <div class="col-lg-4">
        <form role="form" class="panel panel-default" enctype="multipart/form-data"<?php echo ' method="post" action="'.$route.(($id)?'/'.$id:'').'"';?>>
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label" for="inputSuccess">Nome</label>
                    <input type="text" class="form-control"<?php $fieldName = 'nome_evt'; echo ' id="'.$fieldName.'" name="'.$fieldName.'"'.(($id)?' value="'.$eventos->$fieldName.'"':''); ?> />
                </div>
                <div class="form-group">
                    <label class="control-label" for="inputWarning">Descrição</label>
                    <?php $fieldName = 'descricao_evt'; echo '<textarea class="form-control" id="'.$fieldName.'" name="'.$fieldName.'" rows="5">'.(($id)?''.$eventos->$fieldName.'':'').'</textarea>';?>
                </div>
                <div class="form-group">
                    <div class="form-group Data">
                        <label class="control-label" for="inputWarning">Data de Início</label>
                        <div class="form-group input-group">
                            <input type="text" class="form-control datepicker" size="16" readonly<?php $fieldName = 'data_ini_evt'; echo ' id="'.$fieldName.'" name="'.$fieldName.'"'.(($id)?' value="'.date("d/m/Y", strtotime($eventos->$fieldName)).'"':' value="'.date("d/m/Y").'"'); ?> />
                            <!--<span class="btn btn-info btn-circle input-group-addon"><i class="fa fa-calendar"></i></span>-->
                        </div>
                    </div>
                    <div class="form-group Data">
                        <label class="control-label" for="inputWarning">Data de Finalização</label>
                        <div class="form-group input-group">
                            <input type="text" class="form-control datepicker" size="16" readonly<?php $fieldName = 'data_fim_evt'; echo ' id="'.$fieldName.'" name="'.$fieldName.'"'.(($id)?' value="'.date("d/m/Y", strtotime($eventos->$fieldName)).'"':' value="'.date("d/m/Y").'"'); ?> />
                            <!--<span class="btn btn-info btn-circle input-group-addon"><i class="fa fa-calendar"></i></span>-->
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-outline btn-default">Salvar</button>
            </div>
        </form>
    </div>
</div>
@stop

@section('scripts')
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
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
                nome_evt: {
                    required: "Este campo é necessário!",
                    minlength: jQuery.format("Por favor, insira pelo menos {0} caracteres!")
                },
                descricao_evt: {
                    required: "Este campo é necessário!",
                    minlength: jQuery.format("Por favor, insira pelo menos {0} caracteres!")
                },
                data_ini_evt: {
                    required: "Este campo é necessário!",
                    minlength: jQuery.format("Por favor, insira pelo menos {0} caracteres!")
                },
                data_fim_evt: {
                    required: "Este campo é necessário!",
                    minlength: jQuery.format("Por favor, insira pelo menos {0} caracteres!")
                }
            },
            rules: {
                nome_evt: {
                    minlength: 3,
                    //maxlength: 15,
                    required: true
                }
                ,descricao_evt: {
                    minlength: 15,
                    //maxlength: 15,
                    required: true,
                }
                ,data_ini_evt: {
                    minlength: 8,
                    date: true,
                    required: true
                }
                ,data_fim_evt: {
                    minlength: 8,
                    date: true,
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
