<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    <!-- Core CSS - Include with every page -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Dashboard -->
    <link href="/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    <link href="/css/plugins/timeline/timeline.css" rel="stylesheet">

    <!-- SB Admin CSS - Include with every page -->
    <link href="/css/sb-admin.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">


</head>

<body>

<div id="wrapper">

    <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">SUSA - Sistema Ulbra de Submissões Avaliativas</a>
        </div>
        @include('IncSite.MenuSite')
    </nav>

    <div id="page-wrapper">
        @yield('conteudo')
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Core Scripts - Include with every page -->
<script src="/js/jquery-1.11.1.min.js"></script>
<script src="/js/bootstrap.file-input.js"></script>


<script src="/js/bootstrap.min.js"></script>
<script src="/js/plugins/metisMenu/jquery.metisMenu.js"></script>

<script src="/js/plugins/morris/raphael-2.1.0.min.js"></script>
<script src="/js/plugins/morris/morris.js"></script>


<script src="/js/sb-admin.js"></script>
@yield('scripts')
</body>

</html>
