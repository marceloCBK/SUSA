@extends ('layouts.template')

<?php
/*foreach (Config::get('Globals') as $key => $globalsRow) {
    $$key = $globalsRow;
}*/
$title = '404 Página Não Encontrada';
?>
@section('title')
<% 'SUSA - '.$title %>
@stop

<?php

?>
@section('conteudo')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><% $title %></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">

</div>
@stop
