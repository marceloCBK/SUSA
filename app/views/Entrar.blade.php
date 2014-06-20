@extends ('layouts.templateEntrar')

<?php $title = 'Sistema Ulbra de Submissões Avaliativas'; ?>
@section('title')
<% $siteName.' - '.$title %>
@stop

@section('conteudo')
<div class="row">
    <div class="col-md-4 col-md-offset-4">

        <?php
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

        //print_r(Session::get('user'));
        echo Auth::user()->email_usr;
        if (Input::old('email_usr')) {
            $value = ' value="'.Input::old('email_usr').'"';
        }
        ?>

        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Entrar</h3>
            </div>
            <div class="panel-body">

                <form role="form" id="entrar" name="entrar" enctype="multipart/form-data" method="post" action="">
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="E-mail" id="email_usr" name="email_usr" type="email"<?php echo $value;?> autofocus>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Senha" id="senha_usr" name="senha_usr" type="password" value="">
                        </div>
                        <div class="form-group checkbox">
                            <label>
                                <input name="remember" type="checkbox" value="Lembrar?">Lembrar?
                            </label>
                        </div>
                        <!-- Change this to a button or input when using this as a form -->
                        <input type="submit" class="btn btn-lg btn-success btn-block" value="Login" />
                    </fieldset>
                </form>

            </div>
        </div>
    </div>
</div>
@stop

