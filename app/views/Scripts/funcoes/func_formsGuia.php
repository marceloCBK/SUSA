<?php
	session_start();
	//require_once('getSQLValueString.php');
	require_once('../../Connections/connOO.php');
	usleep(500000);
	
	function random($nNumeros, $nQuant)  { 
		$aRand = array(); 
		for ($i=1; $i<=$nQuant; $i++) { 
			
			$aRand[$i] = $rand = rand(1, 9);
			while (count($aRand) < $nNumeros) 
				if (!in_array($rand, $aRand)) $aRand[] = $rand; else $rand = rand(1, 7);
		} 
		
		$c = $aRand[1];
		$c .= $aRand[2];
		$c .= $aRand[3];
		$c .= $aRand[4];
		$c .= $aRand[5];
		$c .= $aRand[6];
		$c .= $aRand[7];
		
		return $c;
	}
	
	
	if(!$db) {
		// If there is an error, show this message.
		echo "Houve um <strong>erro ao enviar seu dados</strong>, tente mais tarde! (0)";
	} else {
		
		if(!empty($_POST['contactName'])) $contactName = $_POST['contactName'];
		if(!empty($_POST['contactEmail'])) $contactEmail = $_POST['contactEmail'];
		if(!empty($_POST['contactFone'])) $contactFone = $_POST['contactFone'];
		if(!empty($_POST['contactDesc'])) $contactDesc = $_POST['contactDesc'];
		
		
		if(!empty($_POST['guiaRamo'])) $guiaRamo = $_POST['guiaRamo'];
		if(!empty($_POST['guiaTags'])) $guiaTags = $_POST['guiaTags'];
		if(!empty($_POST['guiaEndLog'])) $guiaEndLog = $_POST['guiaEndLog'];
		if(!empty($_POST['guiaEndNome'])) $guiaEndNome = $_POST['guiaEndNome'];
		if(!empty($_POST['guiaEndNum'])) $guiaEndNum = $_POST['guiaEndNum'];
		if(!empty($_POST['guiaEndCompl'])) $guiaEndCompl = $_POST['guiaEndCompl'];
		if(!empty($_POST['guiaEndBairro'])) $guiaEndBairro = $_POST['guiaEndBairro'];
		if(!empty($_POST['guiaEndCep'])) $guiaEndCep = $_POST['guiaEndCep'];
		if(!empty($_POST['guiaEndEst'])) $guiaEndEst = $_POST['guiaEndEst'];
		
		if(!empty($_POST['guiaEndCid'])) $guiaEndCid = $_POST['guiaEndCid'];
				
		
			require("../../includes/phpmailer/class.phpmailer.php");
			
			$siteName = "Rondônia in Foco";
			$siteUrl = "http://www.rondoniainfoco.com.br";
			
			$texto  = "Uma nova empresa se cadastrou no Guia Comercial através do site ".$siteName;
			$texto .= "<br>";
			$texto .= "<br>";
			$texto .= "<b>Dados da empresa:</b>";
			$texto .= "<br>";
			$texto .= "<br>";
			$texto .= "<b>Nome:</b> ".$contactName;
			$texto .= "<br>";
			$texto .= "<b>E-mail:</b> ".$contactEmail;
			$texto .= "<br>";
			$texto .= "<b>Fone:</b> ".$contactFone;
			$texto .= "<br>";
			$texto .= "<b>Mensagem:</b> ".$contactDesc;
			
			$texto .= "<br>";
			$texto .= "<br>";
			$texto .= "* Acesse administrador do seu site para configurar a empresa. <a href=\"".$siteUrl."/admin\">Clique aqui</a> para entrar no administrador";
			
			$mail = new PHPMailer();
			//$mail->SetLanguage("br", "../includes/phpmailer/");
			$mail->SMTP_PORT  = "26"; 			
			//$mail->SMTPSecure = "ssl"; // Tipo de comunicação segura - ssl - segura - tls
			$mail->IsSMTP();
			$mail->Host     = "mail.rondoniainfoco.com.br";  // Endereço do servidor SMTP
			$mail->SMTPAuth = true; // Requer autenticação?
			$mail->Username = "suporte@rondoniainfoco.com.br"; // Usuário SMTP
			$mail->Password = "wxK#QblxVLgS"; // Senha do usuário SMTP
			$mail->IsHTML(true);
			
			$mail->From     = "suporte@rondoniainfoco.com.br"; // E-mail do remetente
			$mail->FromName = "Rondonia in Foco"; // Nome do remetente
			$mail->AddAddress("contato@rondoniainfoco.com.br"); // E-mail do destinatário
			$mail->AddBCC("suporte@cbkdigital.com.br"); // E-mail do destinatário
			$mail->Subject = "Guia Comercial: ".$siteName;
			$mail->Body    = $texto;
			
			$send = $mail->Send();	
		
				
				$query = sprintf("INSERT INTO guia_empresas_emp (id_est_emp, id_cid_emp, id_elt_emp, id_era_emp, nome_emp, telefones_emp, email_emp, descricaosmall_emp, logradouronome_emp, numero_emp, bairro_emp, complemento_emp, cep_emp, tagsbusca_emp, usuarioxlogin_emp, senhaxpass_emp) VALUES (%s, %s, %s, %s, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')", $guiaEndEst, $guiaEndCid, $guiaEndLog, $guiaRamo, $contactName, $contactFone, $contactEmail, $contactDesc, $guiaEndNome, $guiaEndNum, $guiaEndBairro, $guiaEndCompl, $guiaEndCep, $guiaTags, $contactEmail, random(7, 2));
				$result = $db->query($query);
				
				$_SESSION['GUIA_ID'] = $db->insert_id;
												
		if($result || $send) {
			// true
			echo "Aguarde, você será redirecionado para próxima etapa.";
		} else {
			// false
			echo "Houve um <strong>erro ao enviar seu dados</strong>, tente mais tarde! (1)";
		}
	}
?>