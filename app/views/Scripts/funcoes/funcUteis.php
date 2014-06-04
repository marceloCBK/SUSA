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
if (!function_exists("diffDate")) {
	function diffDate($d1, $d2, $type='', $sep='-') {
		
		$d1 = explode($sep, $d1);
		$d2 = explode($sep, $d2);
	
		switch ($type) {
			case 'A':
				$x = 31536000;
				break;
			case 'M':
				$x = 2592000;
				break;
			case 'D':
				$x = 86400;
				break;
			case 'H':
				$x = 3600;
				break;
			case 'MI':
				$x = 60;
				break;
			default:
				$x = 1;
		}
		
		return floor( ( ( mktime(0, 0, 0, $d2[1], $d2[2], $d2[0]) - mktime(0, 0, 0, $d1[1], $d1[2], $d1[0] ) ) / $x ) );
	}
}

if (!function_exists("showError")) {
	function showError($errorInput, $erroVar) {
		$text = '<span id="error_'.$errorInput.'" class="txt-arial-11-vermelho"><br />'.$erroVar[$errorInput].'</span>';
		return $text;
	}
}
if (!function_exists("showValue")) {
	function showValue($value, $fSize='11px', $return="Não informado") {
		return (empty($value) || $value == '0000-00-00' || $value == '0000-00-00 00:00:00') ? "<span style=\"font-size:$fSize\">".$return."</span>" : $value;
	}
}

if (!function_exists("showPost")) {
	function showPost($post, $select=""){
		
		if(!empty($select)) 
		{
			if($_POST[$post] == $select) $return = " selected=\"selected\"";
		}
		else
		{
			$return = $_POST[$post];
		}
		return $return;
	}
}

if (!function_exists("showGet")) {
	function showGet($get, $select=""){
		
		if(!empty($select))
		{
			if($_GET[$get] == $select) $return = " selected=\"selected\"";
		}
		else
		{
			$return = $_GET[$get];
		}
		return $return;
	}
}

if (!function_exists("showDateBr")) {
	function showDateBr($dataForm, $separador="") {
		if(!empty($dataForm) && $dataForm != "0000-00-00") {
			if(empty($separador)) $separador = "/";
			if(!empty($dataForm)) {
				list($year, $month, $day) = explode("-", $dataForm);
				$dataRetorno = $day.$separador.$month.$separador.$year;
			} else {
				$dataRetorno = "";
			}	
		} else {
			$dataRetorno = "";
		}
		return $dataRetorno;
	}
}

if (!function_exists("showDateTimeBr")) {
	function showDateTimeBr($dataForm, $showTime=0, $separador="") {
		if(!empty($dataForm) && $dataForm != "0000-00-00") {
			if(empty($separador)) $separador = "/";
			if(!empty($dataForm)) {
				//list($year, $month, $day) = explode("-", $dataForm);
				$year = substr($dataForm, 0, 4);
				$month = substr($dataForm, 5, 2);
				$day = substr($dataForm, 8, 2);
				$time = substr($dataForm, 11, 5);
				$dataRetorno = $day.$separador.$month.$separador.$year." ";
				
				if($showTime == 1 && $time != "00:00") $dataRetorno.= $time;
				
			} else {
				$dataRetorno = "";
			}	
		} else {
			$dataRetorno = "";
		}
		return $dataRetorno;
	}
}

if (!function_exists("showTime")) {
	function showTime($time, $tipo=0) {
		$timeEx = explode(":", $time);	
		if($tipo == 0) {
			$timeRetorno = $timeEx[0].":".$timeEx[1]; 	
		}
		if($tipo == 1) {
			$timeRetorno = $timeEx[0]."hrs ".$timeEx[1]."min"; 	
		}
		return $timeRetorno;
	}
}

if (!function_exists("dateBanco")) {
	function dateBanco($dataForm) {
		if(!empty($dataForm)) {
			list($dia, $mes, $ano) = explode("/", $dataForm);
			$dataRetorno = $ano."-".$mes."-".$dia;
		} else {
			$dataRetorno = "";
		}	
		return $dataRetorno;
	}
}

if (!function_exists("numDiaSemana")) {
	function numDiaSemana($num) {
		if($num == 1){
			return $dia = 'Domingo';
		}
		if($num == 2){
			return $dia = 'Segunda';
		}
		if($num == 3){
			return $dia = 'Ter&ccedil;a';
		}
		if($num == 4){
			return $dia = 'Quarta';
		}
		if($num == 5){
			return $dia = 'Quinta';
		}
		if($num == 6){
			return $dia = 'Sexta';
		}
		if($num == 7){
			return $dia = 'S&aacute;bado';
		}
	}
}

if (!function_exists("textDiaSemana")) {
	function textDiaSemana($text) {
		if($text == 'DOMINGO'){
			return $dia = 1;
		}
		if($text == 'SEGUNDA-FEIRA'){
			return $dia = 2;
		}
		if($text == 'TERÇA-FEIRA'){
			return $dia = 3;
		}
		if($text == 'QUARTA-FEIRA'){
			return $dia = 4;
		}
		if($text == 'QUINTA-FEIRA'){
			return $dia = 5;
		}
		if($text == 'SEXTA-FEIRA'){
			return $dia = 6;
		}
		if($text == 'SÁBADO'){
			return $dia = 7;
		}
	}
}
		
if (!function_exists("traducaoDia")) {
	function traducaoDia($text) {
		if($text == 'Sunday') {
			return $dia = 'Domingo';
		}
		if($text == 'Monday') {
			return $dia = 'Segunda-Feira';
		}
		if($text == 'Tuesday') {
			return $dia = 'Ter&ccedil;a-feira';
		}
		if($text == 'Wednesday') {
			return $dia = 'Quarta-feira';
		}
		if($text == 'Thursday') {
			return $dia = 'Quinta-feira';
		}
		if($text == 'Friday') {
			return $dia = 'Sexta-feira';
		}
		if($text == 'Saturday') {
			return $dia = 'S&acute;bado';
		}
	}
}

if (!function_exists("traducaoMes")) {
	function traducaoMes($text) {
		if($text == 'January') {
			return $mes = 'Janeiro';
		}
		if($text == 'February') {
			return $mes = 'Fevereiro' ;
		}
		if($text == 'March') {
			return $mes = 'Mar&ccedil;o';
		} 
		if($text == 'April') {
			return $mes = 'Abril';
		}
		if($text == 'May') {
			return $mes = 'Maio';
		}
		if($text == 'June') {
			return $mes = 'Junho';
		}
		if($text == 'July') {
			return $mes = 'Julho';
		}
		if($text == 'August') {
			return $mes = 'Agosto';
		}
		if($text == 'September') {
			return $mes = 'Setembro';
		}
		if($text == 'October') {
			return $mes = 'Outubro';
		}
		if($text == 'November') {
			return $mes = 'Novembro';
		}
		if($text == 'December') {
			return $mes = 'Dezembro';
		}
	}
}

if (!function_exists("numMes")) {	
	function numMes($num) {
		if($num == 1) {
			return $mes = 'Janeiro';
		}
		if($num == 2) {
			return $mes = 'Fevereiro' ;
		}
		if($num == 3) {
			return $mes = 'Mar&ccedil;o';
		} 
		if($num == 4) {
			return $mes = 'Abril';
		}
		if($num == 5) {
			return $mes = 'Maio';
		}
		if($num == 6) {
			return $mes = 'Junho';
		}
		if($num == 7) {
			return $mes = 'Julho';
		}
		if($num == 8) {
			return $mes = 'Agosto';
		}
		if($num == 9) {
			return $mes = 'Setembro';
		}
		if($num == 10) {
			return $mes = 'Outubro';
		}
		if($num == 11) {
			return $mes = 'Novembro';
		}
		if($num == 12) {
			return $mes = 'Dezembro';
		}
	}
}

if (!function_exists("mesShort")) {	
	function mesShort($num) {
		if($num == 1) {
			return $mes = 'JAN';
		}
		if($num == 2) {
			return $mes = 'FEV' ;
		}
		if($num == 3) {
			return $mes = 'MAR';
		} 
		if($num == 4) {
			return $mes = 'ABR';
		}
		if($num == 5) {
			return $mes = 'MAI';
		}
		if($num == 6) {
			return $mes = 'JUN';
		}
		if($num == 7) {
			return $mes = 'JUL';
		}
		if($num == 8) {
			return $mes = 'AGO';
		}
		if($num == 9) {
			return $mes = 'SET';
		}
		if($num == 10) {
			return $mes = 'OUT';
		}
		if($num == 11) {
			return $mes = 'NOV';
		}
		if($num == 12) {
			return $mes = 'DEZ';
		}
	}
}


// passar data modelo americano - YYYY-MM-DD
// utiliza funcoes acima
if (!function_exists("extrairDiaSemana")) {
	function diaSemanaData($data){
		
		$w = date('w', strtotime($data));
		return numDiaSemana($w+1);
	}
}

//dia semana reduzido
if (!function_exists("dayWeekShort")) {
	function dayWeekShort($number) {
		switch($number) {
			case 1: return "Dom"; break;
			case 2: return "Seg"; break;
			case 3: return "Ter"; break;
			case 4: return "Qua"; break;
			case 5: return "Qui"; break;
			case 6: return "Sex"; break;
			case 7: return "Sab"; break;
			default: return "Day not exist!"; break;
		}
	}
}

if (!function_exists("checkData")) {
	function checkData($mydate) { 
		list($dd,$mm,$yy)=explode("/",$mydate); 
		if (is_numeric($yy) && is_numeric($mm) && is_numeric($dd)) { 
			return checkdate($mm,$dd,$yy); 
		} 
		return false;            
	} 
}
if (!function_exists("addDayIntoDate")) {
	function addDayIntoDate($date, $days) {
		 $thisyear = substr ( $date, 0, 4 );
		 $thismonth = substr ( $date, 5, 2 );
		 $thisday =  substr ( $date, 8, 2 );
		 $nextdate = mktime ( 0, 0, 0, $thismonth, $thisday + $days, $thisyear );
		 return strftime("%Y-%m-%d", $nextdate);
	}
}

if (!function_exists("subDayIntoDate")) {
	function subDayIntoDate($date,$days) {
		 $thisyear = substr ( $date, 0, 4 );
		 $thismonth = substr ( $date, 5, 2 );
		 $thisday =  substr ( $date, 8, 2 );
		 $nextdate = mktime ( 0, 0, 0, $thismonth, $thisday - $days, $thisyear );
		 return strftime("%Y-%m-%d", $nextdate);
	}
}

if (!function_exists("decimalBanco")) {
	function decimalBanco($valorForm) {
		if(!empty($valorForm)) {
			$valorRetorno = preg_replace("/\./", "", $valorForm);
			$valorRetorno = preg_replace("/\,/", ".", $valorRetorno);
		} else {
			$valorRetorno = "";
		}	
		return $valorRetorno;
	}
}

//SQL
if (!function_exists("getQuery")) {
	function getQuery($tabela, $campos="", $sentenca="") {
		$clausula_sql = "SELECT ";
		// future campos select
		
		if(!empty($campos)) 
			$clausula_sql .= $campos;
		else
			$clausula_sql .= "*";
		
		$clausula_sql .= " FROM ".$tabela;		 
		
		if(!empty($sentenca)) $clausula_sql .= " WHERE ".$sentenca.";";
		return $clausula_sql; 
	}
}

// LIMITADOR DE CARACTER
if (!function_exists("limitCaracter")) {
	function limitCaracter($text, $vMax, $TextSufix = '...') {
		if (strlen($text) > $vMax) {					
			$return = substr($text, 0, $vMax - 3).$TextSufix; 
		} else { 
			$return = $text; 
		}
		return $return;
	}
}

if (!function_exists("filtroTexto")) {
	function filtroTexto($texto){
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
}
		
		
//FILTRO IP
if (!function_exists("filtroIpp")) {
	function filtroIpp($ipp){
		$filtro = array (
							"80.254.12.14" => "xxx"
						);
		foreach ($filtro as $errado => $certo){
			$ipp = preg_replace ("/".$errado."/i", $certo, $ipp);
			}
		return $ipp;
	}
}

/*if (!function_exists("imgResize")) {
	function imgResize($localImg, $maxWidth=100, $maxHeight=100) {
		list($width, $height, $type, $attr) = getimagesize($localImg); //caminho da imagem
		
		//$maxWidth = 190; $maxHeight = 120;
		if ($width <= $height) { 
			$imgResize = 'width="'.$maxWidth.'"'; 
		}//if ($height >=$width*0.64)
		else { 
			$imgResize = 'height="'.$maxHeight.'"'; 
		}
		return($imgResize);
	}
}*/

//RESIMENSIONAMENTO DE IMAGENS DE VITIRNE
if (!function_exists("imgResize")) {
	function imgResize($localImg, $maxWidth=100, $maxHeight=100, $AutoCenter=false) {
		list($width, $height, $type, $attr) = getimagesize($localImg); //caminho da imagem
		
		if ($width <= $height) { //define qual dos lados é menor
			$per = $maxWidth / $maxHeight; //descobre a proporçao do local da imagem
			if (($width <=$height*$per)&&(!$AutoCenter)){
				$imgResize = 'width="'.$maxWidth.'"'; 
			} else {$imgResize = 'height="'.$maxHeight.'"';}
		}//if ($height >=$width*0.64)
		else { 
			$per = $maxHeight / $maxWidth; //descobre a proporçao do local da imagem
			if (($height <=$width*$per)&&(!$AutoCenter)){		
				$imgResize = 'height="'.$maxHeight.'"'; 
			} else {$imgResize = 'width="'.$maxWidth.'"'; }			
		}
		return($imgResize);
	}
}

//RESIMENSIONAMENTO DE IMAGENS DE VITIRNE (EXPONSIVO 2)
if (!function_exists("imgResizeEx")) {
	function imgResizeEx($localImg, $maxWidth=100, $maxHeight=100, $AutoCenter=false) {
		list($width, $height, $type, $attr) = getimagesize($localImg); //caminho da imagem 
		
		if ($width <= $height) { //define qual dos lados é menor
			$per = $maxWidth / $maxHeight; //descobre a proporçao do local da imagem
			if (($width <=$height*$per)&&(!$AutoCenter)){
				$imgResize = 'width="100%"'; 
			} else {$imgResize = 'height="100%"';}
		}//if ($height >=$width*0.64)
		else { 
			$per = $maxHeight / $maxWidth; //descobre a proporçao do local da imagem
			if (($height <=$width*$per)&&(!$AutoCenter)){		
				$imgResize = 'height="100%"'; 
			} else {$imgResize = 'width="100%"'; }			
		}
		return($imgResize);
	}
}

//RESIMENSIONAMENTO DE IMAGENS DE VITIRNE (EXPONSIVO) - EM TESTE
/*if (!function_exists("imgResizeEx")) {
	function imgResizeEx($localImg, $perDiff=100) {
		list($width, $height, $type, $attr) = getimagesize($localImg); //caminho da imagem
		
		$perDiff = $perDiff/100;
		if ($width <= $height) { //define qual dos lados é menor
			$per = $width / $height; //descobre a proporçao real da imagem
			$perReverse = (100*(($per-1)*(-1)))+100; //inverte a porcentagem ex:(if ($per == 0.6) {$perReverse = 0.4}) e acrecenta valor em width ex: width=100%+40%
			if ($width <= $height*$perDiff){//verifica se Width é menor que a proporçao limite de Height	
				$imgResize = 'width="100%"'; 
			} else {$imgResize = 'width="'.$perReverse.'%"';}
		}//if ($height >=$width*0.64)
		else { 
			$per = $height / $width; //descobre a proporçao real da imagem
			$perReverse = (100*(($per-1)*(-1)))+100; //inverte a porcentagem ex:(if ($per == 0.6) {$perReverse = 0.4}) e acrecenta valor em width ex: width=100%+40%
			if ($height <= $width*$perDiff){ //verifica se Height é menor que a proporçao limite de Width	
				$imgResize = 'width="'.$perReverse.'%"'; 
			} else {$imgResize = 'width="100%"'; }			
		}
		return($imgResize);
	}
}*/

//SUBSTITUIR UM TRECHO (STRING) DENTRO DE UMA STRING
if (!function_exists("StrStretchReplace")) {
	function StrStretchReplace($String, $BuscarStart1, $BuscarEnd, $Alt) {
		//$Alt = 'EXEMPLO'; //ALTERAÇÃO
		//$BuscarStart='EXEMPLO'; //BUSCA PONTO INICIAL DA ALTERAÇÃO
		if(!is_array($BuscarStart1)){$BuscarStart[]=$BuscarStart1;}else{$BuscarStart=$BuscarStart1;} 
		foreach($BuscarStart as $Key => $Val){
			
			if(empty($BuscarEnd[$Key])){$KMinus++;$KeyEnd=$Key-$KMinus;}else{$KeyEnd=$Key;}	//EControl => SE $BuscarEnd FOR UM ARRAY COMO $BuscarStart $BuscarEnd TIVER MENOS CAMPOS QUE $BuscarStart = $BuscarEnd USARÁ O ULTIMO CAMPO VÁLIDO DE SI MESMO
			if(empty($Alt[$Key])){$KMinusAlt++;$KeyAlt=$Key-$KMinusAlt;}else{$KeyAlt=$Key;}		//EControl => SE $Alt FOR UM ARRAY COMO $BuscarStart $Alt TIVER MENOS CAMPOS QUE $BuscarStart = $Alt USARÁ O ULTIMO CAMPO VÁLIDO DE SI MESMO
			
			$Pos1=strpos($String, $Val); //POSIÇÃO INICIAL DA ALTERAÇÃO
			$Pos2=strlen($Val); //NUMERO DE CHARACTERES BUSCA
			$Pos3=strpos( //BUSCA O PONTO ONDE SE DEVE PARAR DE ALTERAR E DEFINE O NUMERO DE CHARACTERES A SE ALTERAR
					substr( //SELECIONA TEXTO "A PARTIR" DA POSIÇÃO INICIAL DA ALTERAÇÃO
							$String,
							strpos($String, $Val) + $Pos2,
							strlen($String)
					),
					(is_array($BuscarEnd)?$BuscarEnd[$KeyEnd]:$BuscarEnd) //POSIÇÃO ONDE SE DEVE PARAR DE ALTERAR "A PARTIR" DA POSIÇÃO INICIAL DA ALTERAÇÃO
				);
			$String = substr_replace($String,(is_array($Alt)?$Alt[$KeyAlt]:$Alt) ,$Pos1+$Pos2,($Pos3));
		}
		
		return($String);
	}
}


//CONTA A INSIDÊNCIA DE CADA PALAVRA DE UMA STRING
if (!function_exists("CountWords")) {
	function CountWords($Words, $WordBan=NULL) {
		$WordList = explode(' ', $Words);
		foreach($WordList as $key => $value){
			$WordList[$key] = trim($WordList[$key]);
		}
		
		if (empty($WordBan)){
			$WordBan = array(
				 'de',
				 'do',
				 'da',
				 'e',
				 'o',
				 'a',
				 'os',
				 'as',
				 'se',
				 'que',
				 'qual',
				 'quais'
				);
		}
		
		$WordListDist = array('NULL');
		foreach($WordList as $key => $value){
			if (in_array(strtolower($value), array_map('strtolower', $WordBan))){
				continue;
			} else {
				if (in_array($value, $WordListDist)){ //VERIFICA PALAVRA REPETIDA
					
					foreach($WordListCount as $key0 => $value0){
						if ($value == $value0['word']) {$WordListCount[$key0]['count'] += 1; $i+=1; continue;} //ACRESCENTA +1 AO CONTADOR DA PALAVRA SE ELA FOR REPETIDA
					}
					
				} else {
					$WordListDist[]		= $value;
					$WordListCount[]	= array('word'=>$value, 'count'=> 1);
				}
			}
		}
		
		//ORDENA LISTA PELO MAIOR QUANTIDADE DE REPETIÇOES DA PALAVRA -->
		if (!function_exists("SortFunc")) {
			function SortFunc($a, $b){   
				if ($a['count'] == $b['count']) {
					return 0;
				}
				return ($a['count'] > $b['count']) ? -1 : 1;
			}
		}
		usort($WordListCount, "SortFunc");
		//ORDENA LISTA PELO MAIOR QUANTIDADE DE REPETIÇOES DA PALAVRA <--
		
		//print_r($WordList);
		print_r($WordListCount);
		//echo $i;
		return $WordListCount;
	}
}
?>