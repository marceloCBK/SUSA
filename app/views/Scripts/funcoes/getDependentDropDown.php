<?php
session_start();
	require_once('../../Connections/conn.php');
	//require_once('func_clausulasSQL.class.php'); 
	
	function getSelect($tabela, $campos="", $sentenca="") {
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
	
	
	if(!$db) {
		// If there is an error, show this message.
		echo '0|Houve um problema de conexão com o banco de dados';
	} else {
		
		$valueSelect =  str_replace("\\","",$_POST['valueSelect']);
		$columnValue =  str_replace("\\","",$_POST['columnValue']);
		$columnLabel =  str_replace("\\","",$_POST['columnLabel']);
		$labelNull = str_replace("\\","",$_POST['labelNull']);
		$table =  str_replace("\\","",$_POST['table']);
		
		//$camposSelect = $_POST['camposSelect']; 
		//$camposSelect = preg_replace("/\s+/", "", $_POST['camposSelect']);
		$camposSelect = str_replace("\\","",$_POST['camposSelect']);
		$condicaoWhere =  str_replace("\\","",$_POST['conditionWhere']);
		
		//$sql = new clausulas_sql; 
		$query = getSelect($table, $camposSelect, $condicaoWhere);										
		if($db->query($query)) {
			$result = $db->query($query);
			
			if($result->num_rows == 0) {
				echo '1|<option value="">...</option>';
			} else {
				
				// var montagem
				$mount = "1|";
				$mount.= '<option value="">'.$labelNull.'</option>';
				
				while ($rows = $result->fetch_object()) {
					
					$mount.= '<option value="'.$rows->$columnValue.'" ';
					
					if($valueSelect != 0) {
						if($rows->$columnValue == $valueSelect) $mount.= 'selected="selected"';
					}
					
					$mount.= '>';					
					$mount.= $rows->$columnLabel;
					$mount.= '</option>';
										
					//$mount.= $rows->$columnValue." -> ".$rows->$columnLabel." <br />";
				}
				echo $mount;
			}
		} else {
			echo "0|Erro ao consultar dados!";
		}
	}	
?>