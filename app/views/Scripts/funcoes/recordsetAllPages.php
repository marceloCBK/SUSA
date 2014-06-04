<?php

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
	
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
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
}
/* LATERAL */ 
/*
mysql_select_db($database_conn, $conn);
$query_rsCON = "SELECT * FROM conteudos_con WHERE id_cat_con = 2 AND status_con = 1 AND id_sct_con != 111 AND id_sct_con != 100004 ORDER BY datahora_con DESC";
$rsCON = mysql_query($query_rsCON, $conn) or die(mysql_error());
$row_rsCON = mysql_fetch_assoc($rsCON);
$totalRows_rsCON = mysql_num_rows($rsCON);
*/

mysql_select_db($database_conn, $conn);
$query_rsCON_L = "SELECT * FROM conteudos_con WHERE id_cat_con = 2 AND status_con = 1 AND id_sct_con != 111 AND id_sct_con != 100004 ORDER BY datahora_con DESC LIMIT 4";
$rsCON_L = mysql_query($query_rsCON_L, $conn) or die(mysql_error());
$row_rsCON_L = mysql_fetch_assoc($rsCON_L);
$totalRows_rsCON_L = mysql_num_rows($rsCON_L);

$query_rsATV = "SELECT *, YEAR(data_ini_atv) AS ano, MONTH(data_ini_atv) AS mes FROM agenda_atividades_atv WHERE DATE(data_ini_atv) >= CURDATE() GROUP BY YEAR(data_ini_atv), MONTH(data_ini_atv) ORDER BY data_ini_atv ASC";
$rsATV = mysql_query($query_rsATV, $conn) or die(mysql_error());
$row_rsATV = mysql_fetch_assoc($rsATV);
$totalRows_rsATV = mysql_num_rows($rsATV);

mysql_select_db($database_conn, $conn);
$query_rsDEPARTS = "SELECT id_sct, id_cat, id_con, nome_sct, vitrine_sct FROM (SELECT * FROM  conteudos_categorias_subcat_sct LEFT JOIN conteudos_categorias_cat ON id_cat = id_cat_sct LEFT JOIN conteudos_con ON id_sct_con = id_sct WHERE id_cat_sct = 137 ORDER BY nome_sct, id_con DESC) m  GROUP BY id_sct";
$rsDEPARTS = mysql_query($query_rsDEPARTS, $conn) or die(mysql_error());
$row_rsDEPARTS = mysql_fetch_assoc($rsDEPARTS);
$totalRows_rsDEPARTS = mysql_num_rows($rsDEPARTS);
?>