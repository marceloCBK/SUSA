<?php
/**
 * Created by PhpStorm.
 * User: ALIS
 * Date: 16/05/14
 * Time: 22:50
 */
?>
<div class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <?php /*
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search..."/>
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
                <!-- /input-group -->
            </li>
            */ ?>
            <li>
                <a href="/sic"><i class="fa fa-dashboard fa-fw"></i> Início</a>
            </li>

            <?php
            //print_r($menu);
            if ($menu[0]) {
                foreach ($menu as $menuRow) {
                    //$route esta em Globals.php
                    if ($route == $menuRow->rota_mod) {$active = ' class="active"';}
                    $menuPrint .= '
                <li' . $active . '>
                    <a href="'.$route.'/'.$menuRow->id_cur .'"><i class="fa fa-book fa-fw"></i> '.$menuRow->nome_cur.'</a>
                </li>';
                    unset($active);
                }

                echo $menuPrint;
            }
            ?>

        </ul>
        <!-- /#side-menu -->
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
