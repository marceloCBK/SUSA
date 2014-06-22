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
        <form role="form" class="panel panel-default"<?php echo ' method="post" action="'.$route.(($id)?'/'.$id:'').'"';?>>
            <div class="panel-body">
                <div class="form-group">
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
                <div class="form-group">
                    <label class="control-label" for="inputError">Confirme a Senha</label>
                    <input type="password" class="form-control"<?php $fieldName = 'senha_usr_confirmation'; echo ' id="'.$fieldName.'" name="'.$fieldName.'"';?>>
                </div>
                <button type="submit" class="btn btn-outline btn-default">Salvar</button>
            </div>
        </form>
    </div>
</div>
@stop

@section('scripts')
<script src="/js/jquery-validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript">
    $(function() {
        $('form').validate({
            messages: {
                nome_usr: {
                    required: "Este campo é necessário!",
                    minlength: $.validator.format("Por favor, insira pelo menos {0} caracteres!")
                },
                email_usr: {
                    required: "Este campo é necessário!",
                    email: "Digite um e-mail válido!",
                    minlength: $.validator.format("Por favor, insira pelo menos {0} caracteres!")
                },
                ra_usr: {
                    required: "Este campo é necessário!",
                    minlength: $.validator.format("Por favor, insira pelo menos {0} digitos!"),
                    maxlength: $.validator.format("Por favor, insira no máximo {0} caracteres!"),
                    digits: $.validator.format("Por favor, insira apenas numeros!")
                },
                cgu_usr: {
                    required: "Este campo é necessário!",
                    minlength: $.validator.format("Por favor, insira pelo menos {0} digitos!"),
                    maxlength: $.validator.format("Por favor, insira no máximo {0} caracteres!"),
                    digits: $.validator.format("Por favor, insira apenas numeros!")
                },
                senha_usr: {
                    required: "Este campo é necessário!",
                    minlength: $.validator.format("Por favor, insira pelo menos {0} caracteres!")
                },
                senha_usr_confirmation: {
                    required: "Este campo é necessário!",
                    minlength: $.validator.format("Por favor, insira pelo menos {0} caracteres!")
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
                    minlength: 10,
                    maxlength: 10,
                    required: true,
                    digits: true
                }
                ,cgu_usr: {
                    minlength: 8,
                    maxlength: 8,
                    required: true,
                    digits: true
                }
                <?php
                if (empty($id)) {
                    $required = 'required: true,';
                }
                ?>
                ,senha_usr: {
                    <% $required %>
                    minlength: 8,
                }
                ,senha_usr_confirmation: {
                    <% $required %>
                    minlength: 8,
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