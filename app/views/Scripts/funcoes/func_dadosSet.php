<?php
	session_start();
	require_once('../../Connections/connOO.php');
	//require_once('getSQLValueString.php');
	
	//usleep(500000);
		
	if(!$db) {
		// If there is an error, show this message.
		echo "Houve um <strong>erro ao enviar seu comentário</strong>, tente novamente mais tarde! (0)";
	} else {
		
		if($_POST['tipoSet'] == "news") {
			if($_POST['newsTipo'] == 1) {
				//$query = sprintf("INSERT INTO newsletter_new (id_cat_new, email_new) VALUES (136, %s)", GetSQLValueString($_POST['newsEmail'], "text"));
				$query = sprintf("INSERT INTO newsletter_new (id_cat_new, email_new) VALUES (136, '%s')", $_POST['newsEmail']);
				$msgOk = "<strong>E-mail cadastrado com sucesso.</strong> <br />Em breve você irá receber novidades do site Rondônia in Foco.";
			} 
			if($_POST['newsTipo'] == 0) {
				//$query = sprintf("UPDATE newsletter_new SET status_new = 0 WHERE email_new = %s", GetSQLValueString($_POST['newsEmail'], "text"));
				$query = sprintf("UPDATE newsletter_new SET status_new = 0 WHERE email_new = '%s'", $_POST['newsEmail']);
				$msgOk = "<strong>E-mail removido com sucesso.</strong>";
			}
			
		}
		
		if($_POST['tipoSet'] == "enquete") {
			$query = sprintf("INSERT INTO enquetes_votos_evt (id_eqt_evt, id_eop_evt) VALUES (%s, '%s')", $_POST['id_eqt'], $_POST['enquetesOpcao']);
			$msgOk = "<strong>Obrigado por votar em nossa enquete.</strong><script>";
			$_SESSION['enquetesVotacao'] = 1;
		}
		
		if($_POST['tipoSet'] == "mural") {
			$query = sprintf("INSERT INTO muralderecados_mur (nome_mur, email_mur, fone_mur, texto_mur, ip_mur, status_mur) VALUES ('%s', '%s', '%s', '%s', '%s', '0')", $_POST['muralName'], $_POST['muralEmail'], $_POST['muralFone'], $_POST['muralMsg'], $_SERVER['REMOTE_ADDR']);
			$msgOk = "<strong>Obrigado por postar em nosso mural. <br />Sua mensagem passará por uma análise antes de ser publicada.</strong><script>";
		}
		
		
		if(!empty($query)) {
			if($db->query($query)) {
				// true
				echo $msgOk;
			} else {
				// false
				echo "Houve um <strong>erro ao salvar sua solicitação</strong>, tente novamente mais tarde! (1)";
			}
		} else  {
			echo "Parâmetros não enviados, contate o administrador do site.";
		}
	}
?>