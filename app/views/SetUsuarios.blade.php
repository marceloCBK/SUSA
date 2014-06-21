@extends ('layouts.template')

<?php
$id = $usuarios->id_usr; //verifica se é existem valores a serem editados
$title = (($id)?'Editar Usuário "'.$usuarios->nome_usr.'"':'Novo Usuário');
?>
@section('title')
<% $siteName.' - '.$title %>
@stop

@section('conteudo')
<?php

?>
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
    <div class="col-lg-6">
        <form role="form" class="panel panel-default"<?php echo ' method="post" action="'.$route.(($id)?'/'.$id:'').'"';?>>
            <div class="panel-body">
                <div class="form-group<?php //has-success has-warning has-error?>">
                    <label class="control-label" for="inputSuccess">Nome</label>
                    <input type="text" class="form-control"<?php $fieldName = 'nome_usr'; echo ' id="'.$fieldName.'" name="'.$fieldName.'"'.(($id)?' value="'.$usuarios->nome_usr.'"':''); ?>>
                </div>
                <div class="form-group">
                    <label class="control-label" for="inputWarning">E-mail</label>
                    <input type="text" class="form-control"<?php $fieldName = 'email_usr'; echo ' id="'.$fieldName.'" name="'.$fieldName.'"'.(($id)?' value="'.$usuarios->email_usr.'"':'');?>>
                </div>
                <div class="form-group">
                    <label class="control-label" for="inputWarning">RA</label>
                    <input type="text" class="form-control"<?php $fieldName = 'ra_usr'; echo ' id="'.$fieldName.'" name="'.$fieldName.'"'.(($id)?' value="'.$usuarios->ra_usr.'"':'');?>>
                </div>
                <div class="form-group">
                    <label class="control-label" for="inputWarning">CGU</label>
                    <input type="text" class="form-control"<?php $fieldName = 'cgu_usr'; echo ' id="'.$fieldName.'" name="'.$fieldName.'"'.(($id)?' value="'.$usuarios->cgu_usr.'"':'');?>>
                </div>
                <div class="form-group">
                    <label class="control-label" for="inputError">Senha</label>
                    <input type="password" class="form-control"<?php $fieldName = 'senha_usr'; echo ' id="'.$fieldName.'" name="'.$fieldName.'"';?>>
                </div>
<!--                <div class="form-group">
                    <label class="control-label" for="inputError">Senha Novamente</label>
                    <input type="password" class="form-control" id="inputError">
                </div>
-->                <button type="submit" class="btn btn-outline btn-default">Salvar</button>
            </div>
        </form>
    </div>
</div>
@stop

@section('scripts')
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script type="text/javascript">
    $(function() {
        $('form').validate({
            messages: {
                nome_usr: {
                    required: "Este campo é necessário!",
                    minlength: jQuery.format("Por favor, insira pelo menos {0} caracteres!")
                },
                email_usr: {
                    required: "Este campo é necessário!",
                    email: "Digite um e-mail válido!",
                    minlength: jQuery.format("Por favor, insira pelo menos {0} caracteres!")
                },
                ra_usr: {
                    required: "Este campo é necessário!",
                    minlength: jQuery.format("Por favor, insira pelo menos {0} caracteres!")
                },
                cgu_usr: {
                    required: "Este campo é necessário!",
                    minlength: jQuery.format("Por favor, insira pelo menos {0} caracteres!")
                },
                senha_usr: {
                    required: "Este campo é necessário!",
                    minlength: jQuery.format("Por favor, insira pelo menos {0} caracteres!")
                }
            },
            rules: {
                 nome_usr: {
                    minlength: 3,
                    //maxlength: 15,
                    required: true
                }
                ,email_usr: {
                    //minlength: 3,
                    //maxlength: 15,
                    required: true,
                    email: true
                }
                ,ra_usr: {
                    minlength: 3,
                    //maxlength: 15,
                    required: true
                }
                ,cgu_usr: {
                    minlength: 3,
                    //maxlength: 15,
                    required: true
                }
                <?php
                if (empty($id)) {
                    echo('
                ,senha_usr: {
                    minlength: 3,
                    maxlength: 15,
                    required: true
                }
                    ');
                }
                ?>

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