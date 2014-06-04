
<?php
	//Paginacao('pageNum_rsCur', $totalRows_rsCur, $maxRows_rsCur, $pageNum_rsCur, $queryString_rsCur);
	function Paginacao($nome_rs, $total_rows, $max_rows, $page, $url='') { 
	
		$quant_pg = ceil($total_rows/$max_rows);
		$quant_pg++;
		
		// Verifica se esta na primeira página, se nao estiver ele libera o link para anterior
   		if ( $page > 0 ) {
        	
			echo "<a href=".$PHP_SELF."?".$nome_rs."=".( $page - 1 ).$url." class='pgoff'>&laquo; Anterior</a>";
    	
		} /*else {
        	
			echo "<font>&laquo; Anterior</font>";
    	}*/
		
		// Aqui começa a alteração
		// faz o controle da quantidade de paginas irá mostrar em números na paginação
		if ( ( $page - 3 ) < 1 ){
			
			$ant = 1;
			
		} else {
		
			$ant = $page - 3;
			
		}
		
		if ( ( $page + 6 ) > $quant_pg ) {
			
			$pos = $quant_pg;
		
		} else {
		
		$pos = $page + 6;
		
		}
		
		
		// Faz aparecer os numeros das página entre o ANTERIOR e PROXIMO
		for( $i_pg = $ant; $i_pg < $pos; $i_pg++ ) {
		// Aqui termina a alteração
			// Verifica se a página que o navegante esta e retira o link do número para identificar visualmente
			if ( $page == ( $i_pg - 1 ) ) {
				
				echo "&nbsp;<span class='pag-princ'>[$i_pg]</span>&nbsp;";
				
			} else {
				
				$i_pg2 = $i_pg-1;
				echo "&nbsp;<a href=".$PHP_SELF."?".$nome_rs."=$i_pg2".$url." class='pgoff' >$i_pg</a>&nbsp;";
				
			}
		}
		
		
		// Verifica se esta na ultima página, se nao estiver ele libera o link para próxima
		if ( ( $page + 2 ) < $quant_pg ) {
			
			echo "<a href=".$PHP_SELF."?".$nome_rs."=".( $page + 1 ).$url." class='pgoff' >Pr&oacute;ximo &raquo;</a>";
			
		} /*else {
			
			echo "<font> Próximo &raquo;</font>";
			
		}*/
	
	}
?>

