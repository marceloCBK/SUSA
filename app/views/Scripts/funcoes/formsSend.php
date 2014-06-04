<?php
	session_start();	
	$root = $_SERVER["DOCUMENT_ROOT"];
	$error = 'Não Houve Erros!';
	
	//CATCH ERROS -->
	function globalErrorHandler($errno, $errstr, $errfile, $errline, $errcontext) {
		global $error;
		global $x;
		switch ($errno) {
			case E_NOTICE:
			case E_USER_NOTICE:
				$errors = "Notice";
				break;
			case E_WARNING:
			case E_USER_WARNING:
				$errors = "Warning";
				break;
			case E_ERROR:
			case E_USER_ERROR:
				$errors = "Fatal Error";
				break;
			default:
				$errors = "Unknown Error";
				break;
		}
		//$x+=1;
		//echo $error.$x.' -- ';
		error_log($error = sprintf("PHP %s:  %s in %s on line %d", $errors, $errstr, $errfile, $errline/*,implode('--',$errcontext) ([%s])*/));
		//$error = sprintf("PHP %s:  %s in %s on line %d", $errors, $errstr, $errfile, $errline);
		if((($errors == 'Fatal Error') || ($errors == 'Warning')) && empty($x) ){
			$x=1;
			$responseId = 2;
			$message	= 'Ops! houve um problema, por favor tente mais tarde.';
			echo json_encode(array('responseId'=>$responseId, 'message' => $message, 'response' => $response, 'error'=> $error ));	
		}
		//echo $error;
		return $error;
	}
	
	set_error_handler("globalErrorHandler",-1 & ~E_NOTICE & ~E_USER_NOTICE);
	error_reporting(0);
	//CATCH ERROS <--
	
	//header('Content-Type: text/html; charset=utf-8');
	//require_once('func_getSQLValueString.php');
	
	if (!function_exists("GetSQLValueString")) {
		function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
		{
		  if (PHP_VERSION < 6) {
			$theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
		  }
		 // $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);
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
	
	require_once($root.'/Connections/conn.php');
	//require_once($root.'/Scripts/funcoes/funcUteis.php');
	require_once($root.'/Scripts/recaptcha-php-1.11/recaptchalib.php'); //Codigo do Captcha - Parte 2	
	
    $publickey = "6LfVXdkSAAAAANov0SH4lDHqI7hkjdMBmnmjZR6Y";
	$privatekey = "6LfVXdkSAAAAAPknPRxeK6bWiPkAbuKAg0x7BErf";
	
	if(!$db) {//if(!$db) {
		$responseId	= 0; 
		$message	= 'Houve um <strong>erro ao enviar sua Mensagem</strong>, tente mais tarde!';
		$response	= 'Não foi possível conectar com o BD';
	} else {
		if ($_POST["recaptcha_response_field"]) {
        	
			$resp = recaptcha_check_answer ($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]); //Codigo do Captcha - Parte 3
			
			 if ($resp->is_valid) {
				if(!empty($_POST['contactName'])) 	$var[]= $contactName 	= GetSQLValueString($_POST['contactName']	, "text");
				if(!empty($_POST['contactEmail'])) 	$var[]= $contactEmail 	= GetSQLValueString($_POST['contactEmail']	, "text");			
				if(!empty($_POST['contactFone'])) 	$var[]= $contactFone 	= GetSQLValueString($_POST['contactFone']	, "text");			
				if(!empty($_POST['contactDesc'])) 	$var[]= $contactDesc 	= GetSQLValueString($_POST['contactDesc']	, "text");		
				if(!empty($_POST['contactCid'])) 	$var[]= $contactCid 	= GetSQLValueString($_POST['contactCid']	, "int");		
				if(!empty($_POST['contactEst'])) 	$var[]= $contactEst 	= GetSQLValueString($_POST['contactEst']	, "int");		
				if(!empty($_POST['contactFace'])) 	$var[]= $contactFace 	= GetSQLValueString($_POST['contactFace']	, "text");		
				if(!empty($_POST['contactInst'])) 	$var[]= $contactInst 	= GetSQLValueString($_POST['contactInst']	, "text");
				
				if(!empty($_SESSION['contactSendMail'])) {
		
					include($root."/Scripts/phpmailer/class.phpmailer.php");
					
					$var[]= $siteName = $_SESSION["siteNome"];
					$var[]= $siteUrl  = $_SESSION["siteUrl"];
					$var[]= $nomeCont  = ($_SESSION['nomeCont'])?$_SESSION['nomeCont']:'CONTATO';
					$prefUrl  = 'http://www.';
					
					$texto  = 'Você recebeu um novo "'.$nomeCont.'" através do site '.$siteName;
					$texto .= "<br>";
					$texto .= "<br>";
					$texto .= "<b>Dados do contato:</b>";
					$texto .= "<br>";
					$texto .= "<br>";
					
					if($contactName)		$texto .= "<br><b>Nome:</b> "		.trim($contactName,"'");
					if($contactEmail)		$texto .= "<br><b>E-mail:</b> "		.trim($contactEmail,"'");
					if($contactFone)		$texto .= "<br><b>Fone:</b> "		.trim($contactFone,"'");
					if($contactCid)			$texto .= "<br><b>Cidade:</b> "		.$row_rsCID['nome_cid'];
					if($contactEst)			$texto .= "<br><b>Estado:</b> "		.$row_rsEST['nome_est'];
					if($contactFace)		$texto .= "<br><b>Facebook:</b> "	.trim($contactFace,"'");
					if($contactInst)		$texto .= "<br><b>Instagram:</b> "	.trim($contactInst,"'");
									
					$texto .= "<br>";
					$var[]=$texto .= "<br>";
					if ($_SESSION["contactTableCat"] != 100) {
						$texto .= "* Você pode encontrar uma cópia deste contato no administrador do seu site. <a href=\"".$prefUrl.$siteUrl."/admin\">Clique aqui</a> para entrar no administrador";
					}
					$ESender = "no-reply@cbksites.com.br";
					
					$mail = new PHPMailer();
					//$mail->SetLanguage("br", $var[]=$root."/Scripts/phpmailer/");
					//$mail->Port  = "587"; 			
					//$mail->SMTPSecure = "ssl"; // Tipo de comunicação segura - ssl - segura - tls
					$mail->IsSMTP();
					//$mail->Host     = "mail.".$siteUrl;  // Endereço do servidor SMTP
					$mail->Host     = ($var[]="cbkmail.com");  // Endereço do servidor SMTP
					$mail->SMTPAuth = true; // Requer autenticação?
					//$mail->Username = "no-reply@".$siteUrl; // Usuário SMTP
					$mail->Username = ($var[]=$ESender); // Usuário SMTP
					$mail->Password = ($var[]="wxK#QblxVLgS"); // Senha do usuário SMTP
					$mail->IsHTML(true);
					
					//$mail->From     = ($var[]=$contactEmail); // E-mail do remetente
					$mail->From     = ($var[]=$ESender); // E-mail do remetente
					$mail->FromName = utf8_decode($siteName); // Nome do remetente
					$mail->addReplyTo(trim($contactEmail, "'")			, utf8_decode($contactName)); // E-mail do remetente
					//$mail->AddReplyTo('diego@cbkdigital.com.br'	, 'Diego da Fonseca');
					
					$mail->AddAddress($_SESSION['contactSendMail']); // E-mail do destinatário
					//$mail->AddAddress($var[]="marcelo@cbkdigital.com.br"); // E-mail do destinatário
					$mail->AddBCC("marcelo@cbkdigital.com.br"); // E-mail do destinatário
					$mail->Subject = utf8_decode("Contato através do site ".$siteName);
					$mail->Body    = $texto;
					
					$send = $mail->Send();	
					
				}
				
				if($_SESSION['contactTableSave'] == 1) {
					if($_SESSION['contactTableCat'] > 0) {						
						$SqlColAx = array(
										array("id_cat_for"		,""			, $_SESSION['contactTableCat']),
										array("id_sct_for"		,""			, $_SESSION['id_sct']),
										array("id_ssc_for"		,""			, $_SESSION['id_ssc']),
										array("nome_for"		,"'"		, $contactName),
										array("email_for"		,"'"		, $contactEmail),
										array("mensagem_for"	,"'"		, $contactDesc),
										array("id_cid_for"		,""			, $contactCid),
										array("id_est_for"		,""			, $contactEst),
										array("coringa_1_for"	,"'"		, $contactFace),
										array("coringa_2_for"	,"'"		, $contactInst),
										);//CAMPOS DO INSERT
						foreach($SqlColAx as $Col){
							if(empty($Col[2])) continue;//REMOVE CAMPOS VAZIOS <<<<<<-------
							$A[]=$Col[0]; 
							$B[]=$Col[1]; 
							$C[]=$Col[2];
							//$C[]=$Col[1].$Col[2].$Col[1];
						} //ORGANIZA ARRAY PARA IMPLODE
						$SqlCol = array($A, $B, $C);
						
						$query = sprintf("INSERT INTO formularios_for (".implode(", ",$SqlCol[0]).") VALUES (".(implode(", ",$SqlCol[2])).")"); 
						$result = $db->query($query);
					} // tableCat			
				} // tableSave								
				
				if($result || $send) {
					$responseId	= 1; 
					$message	= '<strong>Contato</strong> enviado com <strong>sucesso</strong>';
					$response	= "[result: ($result)] [send: ($send)]";/* [query: ('.$query.')]*/
				} else {
					$responseId	= 2; 
					$message	= 'Houve um <strong>erro ao enviar seu contato</strong>, tente mais tarde!';
					$response	= "[result: ($result)] [send: ($send)]";/* [query: ('.$query.')]*/
					$var[]=$mail->ErrorInfo;
				}
				 
			 } else {
				$responseId	= 2; 
				$message	= '<strong>Código imagem está incorreto</strong>, tente novamente';
				$response	= '(2)';
			 }
			
		} else {
			$responseId	= 2; 
			$message	= 'Favor preencher o <strong>código da imagem</strong>';
			$response	= '(3)';
		}		
	}
	
	//if (empty($error)) {
		echo json_encode(array(
							'responseId'=>$responseId, 
							'message' => $message, 
							'response' => $response, 
							//$var, 
							//'ses'=> $_SESSION, 
							'merror'=>$mail->ErrorInfo,
							'error'=> $error ));	
	//}
?>