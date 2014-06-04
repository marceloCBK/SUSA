<?php
function getBase() {
	if(preg_match("/srv-local/", $_SERVER["SERVER_NAME"])) {
		$startUrl = strlen( $_SERVER["DOCUMENT_ROOT"] );
        $excludeUrl = substr( $_SERVER["SCRIPT_FILENAME"], $startUrl);
		$baseExpl = explode("/", $excludeUrl);
		$baseUrl = "/".$baseExpl[1]."/WWW/";
	} else {
	}
	return $baseUrl;
}

function urlFriends($id, $categoria, $title) {
	$seoPatterns = array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/','/quot/');
	$seoReplace = array('', '-', '', '');
	
	// id no inicio
	$categoria = (!empty($categoria)) ? "/".$categoria."/" : "";
	$seoName = $categoria.$id."-".preg_replace($seoPatterns, $seoReplace, strip_tags(removeAcento($title)));
	
	// id no final
	//$seoName = "/articles/".$id."-".preg_replace($seoPatterns,$seoReplace,$title)."-".$id;
	
	return $seoName;
}

function seoText($input, $substitui='-') {
    //Colocar em minúsculas, remover a pontuação
    $resultado = trim(ereg_replace(' +',' ',preg_replace('/[^a-zA-Z0-9\s]/','',strtolower($input))));

    //Remover as palavras que não ajudam no SEO
    //Coloco as palavras por defeito no remover_palavras(), assim eu não esse array
    //if($remover_palavras) { $resultado = remover_palavras($resultado,$substitui,$array_palavras); }
 
    //Converte os espaços para o que o utilizador quiser
    //Normalmente um hífen ou um underscore
    return str_replace(' ', $substitui, $resultado);
}

function removeAcento($texto){
	$trocarIsso = array('à','á','â','ã','ä','å','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ù','ü','ú','ÿ','À','Á','Â','Ã','Ä','Å','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ñ','Ò','Ó','Ô','Õ','Ö','O','Ù','Ü','Ú','Ÿ',);
	$porIsso = array('a','a','a','a','a','a','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','u','u','u','y','A','A','A','A','A','A','C','E','E','E','E','I','I','I','I','N','O','O','O','O','O','0','U','U','U','Y',);
	$titletext = str_replace($trocarIsso, $porIsso, $texto);
	return $titletext;
}


/*
function get_seo_id($seo_title){
  $id=false;
  $parts = explode("-", $seo_title);
  
  //pega id no inicio
  if(preg_match('([0-9]+)', $seo_title, $matches) ) {
	  print_r
  }
  
  /* pega id no final da frase
  if(count($parts) > 1){
    $seo_id = $parts[count($parts)-1];
    if((string) $seo_id == (string)(int) $seo_id){
      $id=$seo_id;
    }
  } 
  return $id;
}
*/
?>