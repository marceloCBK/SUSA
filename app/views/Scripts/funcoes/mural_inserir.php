<?php require_once('../ScriptLibrary/dmxValidator.php'); ?>
<?php require_once('../ScriptLibrary/captcha/class.captcha.php'); ?>
<?php require_once('../Connections/conn.php'); ?>
<?php
// Load the common classes
require_once('../includes/common/KT_common.php');

function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	
	if( PhpCaptcha::Validate( $_POST['code_captcha'] ) ) {
	
		  $insertSQL = sprintf("INSERT INTO muralderecados_mur (nome_mur, email_mur, fone_mur, texto_mur, `data_mur`, ip_mur, status_mur) VALUES (%s, %s, %s, %s, %s, %s, 0)",
							   GetSQLValueString($_POST['nome'], "text"),
							   GetSQLValueString($_POST['email'], "text"),
							   GetSQLValueString($_POST['fone'], "text"),
							   GetSQLValueString($_POST['texto'], "text"),
							   GetSQLValueString($_POST['data'], "date"),
							   GetSQLValueString($_POST['ip'], "text"));
		  mysql_select_db($database_conn, $conn);
		
		  //INICIO DO FILTRO
			$texto = $_POST['texto'];
			function Filtro($texto){
				$filtro = array (
					"viagra" => "xxx",
					"cialis" => "xxx",
					"porn" => "xxx",
					"href" => "xxx",
					"Givenchy" => "xxx",
					"japanese" => "xxx",
					"burberry " => "xxx",
					"watch" => "xxx",
					"nixon" => "xxx",
					"ambien" => "xxx",
					"generic" => "xxx",	
					"swiss" => "xxx",			
					"http" => "xxx",												
					"rolex" => "xxx",												
					"bulgari" => "xxx",
					"script" => "xxx",
					"javascript" => "xxx",
					"<script>" => "xxx"	
					);
				foreach ($filtro as $errado => $certo){
					$texto = preg_replace ("/".$errado."/i", $certo, $texto);
				}
				return $texto;
			}
			//FIM DO FILTRO
			
			
			
			//INICIO DO FILTRO IP
			$ipp = getenv("REMOTE_ADDR");
			function FiltroIpp($ipp){
				$filtro = array (
					"80.254.12.14" => "xxx"
					);
				foreach ($filtro as $errado => $certo){
					$ipp = preg_replace ("/".$errado."/i", $certo, $ipp);
				}
				return $ipp;
			}
			//FIM DO FILTRO IP
			
		
			if ($texto == Filtro ($texto)){
				if($ipp == FiltroIpp($ipp)){
			$Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
			} else {
			//nothing
			}
			}
			
		  $insertGoTo = "mural_inserir.php?ok=1";
		  if (isset($_SERVER['QUERY_STRING'])) {
			$insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
			$insertGoTo .= "pag=".$_POST['pag'];
		  }
		  header(sprintf("Location: %s", $insertGoTo));
		  
	} else {
		$error = "formError";
	}
  
}
?> 
<?php
// Universal Form Validator PHP 1.5.5
$dmxval1 = new dmxValidator();
$dmxval1->script_folder = "ScriptLibrary";
$dmxval1->cs_validate_on_change = true;
$dmxval1->cs_validate_on_submit = true;
$dmxval1->reenable_javascript = true;
$dmxval1->use_bot_check = true;
$dmxval1->report_type = 4;
$dmxval1->error_font =  "Arial";
$dmxval1->error_font_size = 12;
$dmxval1->error_color = "#ffffff";
$dmxval1->error_bold = true;
$dmxval1->error_italic = false;
$dmxval1->error_image = "";
$dmxval1->error_fixed = "Custom";
$dmxval1->error_padding = 4;
$dmxval1->border_color = "#FF0000";
$dmxval1->border_style = "solid";
$dmxval1->css_error_file = "validatorError3";
$dmxval1->error_bg_color = "#ff0000";
$dmxval1->error_preset = "error_five.txt";
$dmxval1->tooltip_position = "top";
$dmxval1->css_hint_file = "validatorHint3";
$dmxval1->hint_preset = "blue.txt";
$dmxval1->hint_tooltip_position = "top";
$dmxval1->hint_border_color = "#0099ff";
$dmxval1->hint_border_style = "solid";
$dmxval1->hint_bg_color = "#003399";
$dmxval1->hint_text_color = "#ffffff";
$dmxval1->hint_text_font = "Arial";
$dmxval1->hint_text_size = 12;
$dmxval1->hint_text_bold = false;
$dmxval1->hint_text_italic = false;
$dmxval1->hint_box_width = 200;
$dmxval1->hint_image = "";
$dmxval1->hint_fixed = "Custom";
$dmxval1->hint_padding = 4;
$dmxval1->use_custom_focus_class = "fixed";
$dmxval1->focus_border_style = "groove";
$dmxval1->focus_border_size = 2;
$dmxval1->focus_border_color = "#C3D9FF";
$dmxval1->focus_bg_color = "#FFFFFF";
$dmxval1->focus_text_color = "#000000";
$dmxval1->use_custom_valid_class = "fixed";
$dmxval1->valid_border_style = "groove";
$dmxval1->valid_border_size = 2;
$dmxval1->valid_border_color = "#00FF00";
$dmxval1->valid_bg_color = "#FFFFFF";
$dmxval1->valid_text_color = "#000000";
$dmxval1->use_custom_invalid_class = "fixed";
$dmxval1->invalid_border_style = "groove";
$dmxval1->invalid_border_size = 2;
$dmxval1->invalid_border_color = "#FF0000";
$dmxval1->invalid_bg_color = "#FFFFFF";
$dmxval1->invalid_text_color = "#000000";
$dmxval1->add_rule("form1", "texto", "allformats", ",,", "true", "", "", "", "");
$dmxval1->add_rule("form1", "nome", "allformats", ",,", "true", "", "", "", "");
$dmxval1->add_rule("form1", "email", "emailcond", ",,", "false", "", "", "", "");
$dmxval1->add_mask("form1", "fone", "custom", "(99) 9999-9999");
$dmxval1->add_rule("form1", "code_captcha", "allformats", ",,", "true", "", "", "", "");
$dmxval1->validate();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sem t&iacute;tulo</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
<link rel="stylesheet" href="../Styles/dmxValidator/validatorHint3.css" type="text/css" />
<link rel="stylesheet" href="../Styles/dmxValidator/validatorError3.css" type="text/css" />
<script type="text/javascript" src="../ScriptLibrary/jsvat.js"></script>
<script type="text/javascript" src="../ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="../ScriptLibrary/jquery.inputHintBox.js"></script>
<script type="text/javascript" src="../ScriptLibrary/jquery.maskedinput-1.2.2.js"></script>
<script type="text/javascript" src="../ScriptLibrary/jquery.validate.min.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmx.jquery.validate.js"></script>
<script type="text/javascript" src="../ScriptLibrary/jquery.tooltip.min.js"></script>
<script type="text/javascript" src="../ScriptLibrary/jquery.hoverIntent.min.js"></script>
<?php
// dmxValidatorJSStart
$dmxval1->generate_javascript_and_css();
// dmxValidatorJSEnd
?>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><form action="" method="post" name="form1" id="form1">
      <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
        <tr>
          <td colspan="2" align="center"><span class="txt-arial-12"><strong>Deixe aqui sua Mensagem</strong> <a name="recado" id="recado2"></a></span></td>
        </tr>
        <tr>
          <td align="left" class="texto-1">&nbsp;</td>
          <td align="left" class="texto-1">&nbsp;</td>
        </tr>
        <?php if(isset($_GET['ok'])) { ?>
        <tr>
          <td align="left" class="texto-1">&nbsp;</td>
          <td align="center" class="texto-1">&nbsp;</td>
        </tr>
        <tr>
          <td align="left" class="texto-1">&nbsp;</td>
          <td align="center" class="texto-1">&nbsp;</td>
        </tr>
        <tr>
          <td align="left" class="texto-1">&nbsp;</td>
          <td align="center" class="texto-1"><span class="txt-arial-12-bold">Mensagem enviada com sucesso!</span></td>
        </tr>
        <tr>
          <td align="left" class="texto-1">&nbsp;</td>
          <td align="center" class="texto-1">&nbsp;</td>
        </tr>
        <tr>
          <td align="left" class="texto-1">&nbsp;</td>
          <td align="center" class="texto-1"><span class="txt-arial-11">Mensagem passará por uma análise antes de ser publicada.</span></td>
        </tr>
        <?php } if(!isset($_GET['ok'])) { ?>
        <tr>
          <td width="4%" align="left" class="texto-1">&nbsp;</td>
          <td width="96%" align="left" class="texto-1"><strong class="txt-arial-12-bold">Nome: </strong></td>
        </tr>
        <tr>
          <td align="left">&nbsp;</td>
          <td align="left"><span id="sprytextfield1">
            <input name="nome" type="text" class="form-240px" id="nome" value="<?php echo dmxSetValue("", "nome") ?>" size="40" maxlength="30" />
            <?php $dmxval1->generate_error("form1","nome","requiredcond",",,");$dmxval1->generate_error("form1","nome","allformats",",,");?>
          </span></td>
        </tr>
        <tr>
          <td align="left">&nbsp;</td>
          <td align="left" class="texto-1"><strong class="txt-arial-12-bold">E-mail:</strong></td>
          </tr>
        <tr>
          <td align="left">&nbsp;</td>
          <td align="left"><input name="email" type="text" class="form-240px" id="email" value="<?php echo dmxSetValue("", "email") ?>" size="40" maxlength="255" />
            <?php $dmxval1->generate_error("form1","email","emailcond",",,"); ?></td>
          </tr>
        <tr>
          <td align="left">&nbsp;</td>
          <td align="left" class="texto-1"><strong class="txt-arial-12-bold">Telefone:</strong></td>
        </tr>
        <tr>
          <td align="left">&nbsp;</td>
          <td align="left"><input name="fone" type="text" class="form-240px" id="fone" value="<?php echo dmxSetValue("", "fone") ?>" size="40" maxlength="30" /></td>
        </tr>
        <tr>
          <td align="left">&nbsp;</td>
          <td align="left"><strong class="txt-arial-12-bold">Mensagem:</strong></td>
        </tr>
        <tr>
          <td align="left">&nbsp;</td>
          <td align="left"><span id="sprytextarea1">
            <textarea name="texto" cols="25" rows="4" class="form-240px" id="texto"><?php echo dmxSetValue("", "texto") ?></textarea>
            <?php $dmxval1->generate_error("form1","texto","requiredcond",",,");$dmxval1->generate_error("form1","texto","allformats",",,");?>
            </span></td>
        </tr>
        <tr>
          <td align="left">&nbsp;</td>
          <td><img src="../ScriptLibrary/captcha/captcha.php" alt="" name="Captcha" width="150" height="60" id="Captcha" /></td>
        </tr>
        <tr>
          <td align="left">&nbsp;</td>
          <td><span class="txt-arial-12-bold">Digite o código da imagem acima:</span></td>
        </tr>
        <tr>
          <td align="left">&nbsp;</td>
          <td>
            <input name="code_captcha" type="text" class="form-110px <?php echo $error; ?>" id="code_captcha" />
         </td>
        </tr>
        <tr>
          <td align="left">&nbsp;</td>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="left">&nbsp;</td>
          <td align="center"><input type="submit" value="Enviar mensagem" />
            <input name="pag" type="hidden" id="pag" value="<?php echo $_GET['pag']; ?>" /></td>
        </tr>
        <?php } ?>
      </table>
      <input type="hidden" name="MM_insert" value="form1" />
      <input name="data" type="hidden" id="data" value="<?php echo date('Y-m-d H:i:s'); ?>" />
      <input name="ip" type="hidden" id="ip" value="<?php echo getenv("REMOTE_ADDR"); ?>" />
      <?php $dmxval1->show_bot_check_error(); ?>
    </form></td>
  </tr>
</table>
</body>
</html>