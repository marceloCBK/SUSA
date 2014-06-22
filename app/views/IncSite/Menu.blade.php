<?php
/**
 * Created by PhpStorm.
 * User: ALIS
 * Date: 16/05/14
 * Time: 22:50
 */

function novoNivel($menuRow)
{
    if ($menuRow->modulo[0]) {
        $Print = '
        <ul class="nav nav-second-level">';
        foreach ($menuRow->modulo as $moduloRow) {
            $Print .= '
            <li>
                <a href="' . $moduloRow->rota_mod . '"><i class="fa ' . (($moduloRow->icone_mod) ? $moduloRow->icone_mod : 'fa-hand-o-right') . ' fa-fw"></i> ' . $moduloRow->nome_mod . '</a>
            </li>' . novoNivel($moduloRow);
        }
        $Print .= '
        </ul>';
    }
    return $Print;
}

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
                <a href="/inicio"><i class="fa fa-dashboard fa-fw"></i> Início</a>
            </li>

            <?php
            //print_r($menu);
            if ($menu[0]) {
                foreach ($menu as $menuRow) {
                    //$route esta em Globals.php
                    if ($route == $menuRow->rota_mod) {$active = ' class="active"';}
                    $menuPrint .= '
                <li' . $active . '>
                    <a href="' . $menuRow->rota_mod . '"><i class="fa ' . (($menuRow->icone_mod) ? $menuRow->icone_mod : 'fa-hand-o-right') . ' fa-fw"></i> ' . $menuRow->nome_mod . '</a>
                    ' . novoNivel($menuRow) . '
                </li>';
                    unset($active);
                }

                echo $menuPrint;
            }

            /*
            <li>
                <a href="#"><i class="fa fa-sitemap fa-fw"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#">Second Level Item</a>
                    </li>
                    <li>
                        <a href="#">Second Level Item</a>
                    </li>
                    <li>
                        <a href="#">Third Level <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="#">Third Level Item</a>
                            </li>
                            <li>
                                <a href="#">Third Level Item</a>
                            </li>
                            <li>
                                <a href="#">Third Level Item</a>
                            </li>
                            <li>
                                <a href="#">Third Level Item</a>
                            </li>
                        </ul>
                        <!-- /.nav-third-level -->
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            */
            ?>


        </ul>
        <!-- /#side-menu -->
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
