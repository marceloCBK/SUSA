<?php
	session_start();
	//require_once('getSQLValueString.php');
	require_once('../../Connections/connOO.php');
	require_once('../recaptcha-php-1.11/recaptchalib.php');
	
    $publickey = "6LfVXdkSAAAAANov0SH4lDHqI7hkjdMBmnmjZR6Y";
	$privatekey = "6LfVXdkSAAAAAPknPRxeK6bWiPkAbuKAg0x7BErf";
	
	if(!$db) {
		// If there is an error, show this message.
		echo "0|Houve um <strong>erro ao enviar seu comentário</strong>, tente mais tarde! (0)";
	} else {
		
		if ($_POST["recaptcha_response_field"]) {
        	
			$resp = recaptcha_check_answer ($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
			
			 if ($resp->is_valid) {
				 $query = sprintf("INSERT INTO conteudos_comentarios_cco (id_cat_cco, id_fk_cco, nome_cco, msg_cco, ip_cco) VALUES (%s, %s, '%s', '%s', '%s')", $_POST['commentCat'], $_POST['commentCon'], $_POST['commentName'], $_POST['commentMsg'], $_POST['commentIp']);
				if($db->query($query)) {
					// true
					echo "1|<strong>Comentário</strong> enviado com <strong>sucesso</strong>.<br />Seu <strong>comentário</strong> irá passar por uma <strong>análise</strong> para <strong>aprovação</strong>.";
				} else {
					// false
					echo "0|Houve um <strong>erro ao enviar seu comentário</strong>, tente mais tarde! (1)";
				}
				 
			 } else {
				 echo "2|<strong>Código imagem está incorreto</strong>, tente novamente.";
			 }
			
		} else {
			echo "2|Favor preencher o <strong>código da imagem</strong>.";
		}
				
		
																		
		
		
	
	}
?>