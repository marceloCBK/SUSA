<?php
/*require_once('Connections/conn.php');
$colname_rsPLC = "-1";
if (isset($_GET['plc'])) {
  $colname_rsPLC = $_GET['plc'];
}

mysql_select_db($database_conn, $conn);
$query_rsPLC = sprintf("SELECT * FROM publicidade_locais_plc WHERE id_plc = %s AND status_plc = 1", $colname_rsPLC);
$rsPLC = mysql_query($query_rsPLC, $conn) or die(mysql_error());
$row_rsPLC = mysql_fetch_assoc($rsPLC);
$totalRows_rsPLC = mysql_num_rows($rsPLC); 

$colname_rsPBE = "-1";
if (isset($_GET['plc'])) {
  $colname_rsPBE = $_GET['plc'];
}

mysql_select_db($database_conn, $conn);
$query_rsPBE = sprintf("SELECT * FROM publicidade_pbe
                        WHERE status_pbe = 1 AND id_plc_pbe = %s AND id_pbe != %s
                        AND data_ins_pbe <= CURRENT_DATE() AND (data_exp_pbe >= CURRENT_DATE() OR expirar_pbe = 0)
                        ORDER BY data_exp_pbe ASC"
                        , $colname_rsPBE, $colname_rsPBE);
$rsPBE = mysql_query($query_rsPBE, $conn) or die(mysql_error());
$row_rsPBE = mysql_fetch_assoc($rsPBE);
$totalRows_rsPBE = mysql_num_rows($rsPBE); 

if($totalRows_rsPBE == 0) {
	$query_rsPBE = sprintf("SELECT * FROM publicidade_pbe WHERE status_pbe = 1 AND id_pbe = %s", $colname_rsPBE);
	$rsPBE = mysql_query($query_rsPBE, $conn) or die(mysql_error());
	$row_rsPBE = mysql_fetch_assoc($rsPBE);
	$totalRows_rsPBE = mysql_num_rows($rsPBE); 
}*/

$Publicidades = PublicidadesCtr::Publicidade($IdPcl);
//print_r($Publicidades);
$PubLocal = $Publicidades[0]->publicidadeLocais;



if ($PubLocal->cycle_plc == 1) {
/*?><!--
<script type="text/javascript" src="ScriptLibrary/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="ScriptLibrary/swfobject.js"></script>
<script type="text/javascript" src="ScriptLibrary/cycle/jquery.cycle.all.js"></script>
--><?php */
echo '
<script type="text/javascript">
    $(function() {
        $("#publicadades' . $IdPlc->id_plc . '").cycle({
            fx: "fade",
            timeout: ' . $IdPlc->duracao_plc . '
        });
    });
</script>
';
}
?>

<style type="text/css">
    .publicidadeError {
        font-size: .6em;
        font-family: Arial, Helvetica, sans-serif;
        text-align: center;
        height: 100%;
        background: #F1F1F1;
    }
</style>

<?php if (!empty($Publicidades) && count($Publicidades) > 0) { ?>
    <div id="publicadades<?php echo $PublicidadesRow->id_plc; ?>" class="Publicidades Center" style="height:100%;">
        <?php
        foreach ($Publicidades as $PublicidadesRow) {
            $dimensoes = explode("x", $PubLocal->dimensoes_plc);

            $width  = $dimensoes[0];
            $height = $dimensoes[1];

            if($PubResp[0]) $width  = $PubResp[0];
            if($PubResp[1]) $height = $PubResp[1];

            $local = '';

            if (preg_match("/empty/", $PublicidadesRow->url_pbe))
                $local .= "idades/empty/" . $PublicidadesRow->url_pbe;

            else
                $local .= "/publicidades/" . $PublicidadesRow->id_plc_pbe . "/" . $PublicidadesRow->url_pbe;

            $nomeExt = explode(".", $PublicidadesRow->url_pbe);
            if (preg_match("/.swf/", $PublicidadesRow->url_pbe) || preg_match("/.SWF/", $PublicidadesRow->url_pbe)) {
                ?>
                <div class="PubItem" style="position: relative; width:<?php echo $width ?>; height:<?php echo $height ?>;">
                    <div class="PubImg Block">
                        <?php if (!empty($PublicidadesRow->linkbtn_pbe)) { //INSERE LINK SOBRE SWF?>
                            <div style="position: absolute; width:<?php echo $width ?>; height:<?php echo $height ?>;">
                                <a href="<?php echo $PublicidadesRow->linkbtn_pbe; ?>"
                                   target="<?php echo $PublicidadesRow->linktarget_pbe; ?>"><img
                                        src="/mediaTemplate/images/link_swf.png"
                                        width="<?php echo $width ?>" height="<?php echo $height ?>"/></a>
                            </div>
                        <?php } ?>
                        <div id="pbe_<?php echo $PublicidadesRow->id_pbe; ?>" class="<?php echo $PubLocal->class_plc; ?>">
                            <script type="text/javascript">
                                $(document).ready(function () {
                                    var so = new SWFObject("<?php echo $local ?>", "pbeSlide<?php echo $PublicidadesRow->id_pbe; ?>", "<?php echo $width;?>", "<?php echo $height;?>", "8", "#000000");
                                    so.addParam("quality", "high");
                                    so.addParam("wmode", "transparent");
                                    so.write("pbe_<?php echo $PublicidadesRow->id_pbe; ?>");
                                });
                            </script>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="PubItem" class="<?php echo $PubLocal->class_plc; ?>"
                     style="text-align:center; width:<?php echo $width; ?>px; height:<?php echo $height; ?>px;">
                    <div class="PubImg Block">
                    <?php if (!empty($PublicidadesRow->linkbtn_pbe)) { ?>
                        <a href="<?php echo $PublicidadesRow->linkbtn_pbe; ?>"
                           target="<?php echo $PublicidadesRow->linktarget_pbe; ?>">
                            <?php if (preg_match("/empty/", $PublicidadesRow->url_pbe)) { ?>
                                <img src="<?php echo $local ?>" width="<?php if ($height >= $width) {
                                    echo $width;
                                } ?>" height="<?php if ($height <= $width) {
                                    echo $height;
                                } //DIMINUI E CENTRALIZA O 'ANUNCIE AQUI' PADRÃO
                                ?>"
    <?php } else { ?>
                            <img src="<?php echo $local ?>" width="<?php echo $width; ?>"
                                 height="<?php echo $height; //DEFINE REDIMENSIONA A IMAGEM PARA O TAMANHO LOCAL ?>"
                                <?php } ?>

                                <?php //echo (preg_match("/empty/", $PublicidadesRow->url_pbe)) ? 'style="margin-top:'.(($height-50)/2).'px"' : ""; ?> />
                            <!-- FECHA <IMG> ACIMA --></a>
                    <?php } else { ?>
                        <img src="<?php echo $local ?>" width="<?php echo $width ?>" height="<?php echo $height ?>"/>
                    <?php } ?>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
<?php } else { ?>
    <div class="publicidadeError"></div>
<?php } unset($PubResp); ?>
