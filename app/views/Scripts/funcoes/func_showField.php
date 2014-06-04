<?php // INÍCIO FUNÇÃO MOSTRA CAMPO ----------------------------------------------
function mostracampo($tablefield, $cat){
	//pega variavel url
	$colname_rsCCC = "-1";
	if (isset($cat)) {
	  $colname_rsCCC = $cat;
	}
	//cria o array com os dados da tabela  conteudos_categorias)campos_ccc de acordo com o id_cat da URL
	mysql_select_db($_POST["database_conn"], $_POST["conn"]);
	$query_rsCCC = sprintf("SELECT status_ccc, label_ccc, campo_ccc FROM conteudos_categorias_campos_ccc WHERE id_cat_ccc = %s", GetSQLValueString($colname_rsCCC, "int"));
	$rsCCC = mysql_query($query_rsCCC, $_POST["conn"]) or die(mysql_error());
	$row_rsCCC = mysql_fetch_assoc($rsCCC);
	$totalRows_rsCCC = mysql_num_rows($rsCCC);
	//checa se tem informação no array
	if($totalRows_rsCCC > 0){
	//tora a jaca com o do-while para achar os dados desejados
		do{
			foreach ($row_rsCCC as $field => $value){
				if($field == "status_ccc"){ $status = $value;}
				if($value == $tablefield){ break 2; }
			}
		}while($row_rsCCC = mysql_fetch_assoc($rsCCC));
		if($value == $tablefield){
			return $status;
		}else{
			return 0;
		}
	}else{
		echo "O status do campo <b>".$tablefield."</b> não foi definido na configuração desta categoria. <br>";
	}
	mysql_free_result($rsCCC);
} // FIM FUNÇÃO MOSTRA CAMPO ---------------------------------------------- ?>