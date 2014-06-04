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
	
	require_once($root.'/Connections/conn.php');
	require_once($root.'/Scripts/funcoes/funcUteis.php');
	require_once($root.'/Scripts/recaptcha-php-1.11/recaptchalib.php'); //Codigo do Captcha - Parte 2	
	
    $publickey = "6LfVXdkSAAAAANov0SH4lDHqI7hkjdMBmnmjZR6Y";
	$privatekey = "6LfVXdkSAAAAAPknPRxeK6bWiPkAbuKAg0x7BErf";
	
	if(!$db) {
		$responseId	= 0; 
		$message	= 'Houve um <strong>erro ao enviar sua Mensagem</strong>, tente mais tarde!';
		$response	= 'Não foi possível conectar com o BD';
	} else {
		if ($_POST["recaptcha_response_field"]) {
        	
			$resp = recaptcha_check_answer ($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]); //Codigo do Captcha - Parte 3
			
			 if ($resp->is_valid) {
				/*foreach ($_POST as $key => $val){
					//if(!empty($_POST[$key])) 		$$key 		= "<br><b>".$_SESSION['title'][$key]."</b> ".$_POST[$key];
					$$key = "<br><b>".$_SESSION['title'][$key]."</b> ".((empty($_POST[$key]))	?'Não Informado!'	:$_POST[$key]);
				}*/
						
				if(!empty($_SESSION['contactSendMail'])) {
		
					include($root."/Scripts/phpmailer/class.phpmailer.php");
					
					$siteName = $_SESSION["siteNome"];
					$siteUrl  = $_SESSION["siteUrl"];
					$nomeSCT  = ($_SESSION['nome_sct'])?$_SESSION['nome_sct']:'CONTATO';
					$prefUrl  = 'http://www.';
					
					$texto  = 'Você recebeu um novo "'.$nomeSCT.'" através do site '.$siteName;
					
					foreach ($_POST as $key => $val){
						switch ($key) {
							case 'DPesNome'		: $texto .= '<br /><br /><br /><b>Dados Pessoais'		.'</b><br />';	break;
							case 'Veiculo'		: $texto .= '<br /><br /><br /><b>Outros Bens'			.'</b><br />';	break;
							case 'Empresa'		: $texto .= '<br /><br /><br /><b>Dados Profissionais'	.'</b><br />';	break;
							case 'ConjNome'		: $texto .= '<br /><br /><br /><b>Cônjuge'				.'</b><br />';	break;
							case 'RefNome'		: $texto .= '<br /><br /><br /><b>Referências'			.'</b><br />';	break;
							case 'FinRenda'		: $texto .= '<br /><br /><br /><b>Dados Financeiros'	.'</b><br />';	break;
							case 'DVeiMarca'	: $texto .= '<br /><br /><br /><b>Dados do Veículo'		.'</b><br />';	break;
						}
						if (
							$key == 'cat' ||
							$key == 'recaptcha_challenge_field' ||
							$key == 'recaptcha_response_field' 
							) continue; //ignora $_POST relacionados ao recaptcha
						
						//if(!empty($_POST[$key])) 		$$key 		= "<br><b>".$_SESSION['title'][$key]."</b> ".$_POST[$key];
						$texto .= $$key = "<br><b>".$_SESSION['title'][$key]."</b> ".((!empty($_POST[$key]) && $_POST[$key] != 'null')	?$_POST[$key]	:'Não Informado!');
					}
									
					$texto .= "<br>";
					$texto .= "<br>";
					if ($_SESSION["contactTableCat"] != 100) {
						$texto .= "* Você pode encontrar uma cópia deste contato no administrador do seu site. <a href=\"".$prefUrl.$siteUrl."/admin\">Clique aqui</a> para entrar no administrador";
					}
					
					$mail = new PHPMailer();
					//$mail->SetLanguage("br", "../includes/phpmailer/");
					$mail->SMTP_PORT  = "25"; 			
					//$mail->SMTPSecure = "ssl"; // Tipo de comunicação segura - ssl - segura - tls
					//$mail->IsSMTP();
					$mail->Host     = "mail.".$siteUrl;  // Endereço do servidor SMTP
					$mail->SMTPAuth = true; // Requer autenticação?
					$mail->Username = "no-reply@".$siteUrl; // Usuário SMTP
					$mail->Password = "wxK#QblxVLgS"; // Senha do usuário SMTP
					$mail->IsHTML(true);
					
					$mail->From     = $contactEmail; // E-mail do remetente
					$mail->FromName = utf8_decode($contactName); // Nome do remetente
					//$mail->AddAddress($_SESSION['contactSendMail']); // E-mail do destinatário
					$mail->AddAddress("marcelo@cbkdigital.com.br"); // E-mail do destinatário
					//$mail->AddBCC("suporte@cbkdigital.com.br"); // E-mail do destinatário
					$mail->Subject = utf8_decode("Contato através do site ".$siteName);
					$mail->Body    = $texto;
					
					$send = $mail->Send();	
					
				}					
				
				if($send) {
					$responseId	= 1; 
					$message	= '<strong>Contato</strong> enviado com <strong>sucesso</strong>';
					$response	= "[send: ($send)]";/* [query: ('.$query.')]*/
				} else {
					$responseId	= 2; 
					$message	= 'Houve um <strong>erro ao enviar seu contato</strong>, tente mais tarde!';
					$response	= "[send: ($send)]";/* [query: ('.$query.')]*/
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
		echo json_encode(array('responseId'=>$responseId, 'message' => $message, 'response' => $response, 'error'=> $error, 'texto' => $texto ));	
	//}
?>