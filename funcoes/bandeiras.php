<?php
//função para buscar qual bandeira que está em vigor no site da eletropaulo
	$num_id;
	$url = file_get_contents('http://www.aneel.gov.br/tarifas');
	$bd_verde = "/Verde/s";
	$bd_amarela = "/Amarela/s";
	$bd_vermelhap1 = "/Vermelha/s";
	$bd_vermelhap2 = "/VERMELHA2/s";
	if(preg_match_all($bd_verde, $url, $conteudo)){
		echo "Bandeira Verde encontrada!";
		$num_id = 1;
	}else if(preg_match_all($bd_amarela, $url, $conteudo)){
		echo "Bandeira Amarela encontrada!";
		$num_id = 2;
	}else if(preg_match_all($bd_vermelhap1, $url, $conteudo)){
		echo "Bandeira Vermelha encontrada P1!";
		$num_id = 3;
	}else if(preg_match_all($bd_vermelhap2, $url, $conteudo)){
		echo "Bandeira Vermelha encontrada P2!";
		$num_id = 4;
	}else{
        echo "ERROR - Nenhuma Bandeira encontrada!";
	}
/*
	$up = mysql_query("UPDATE perfil set id_bandeira = '$num_id' WHERE id = 1");
	if(mysql_affected_rows() > 0){
	 // echo "Sucesso: Atualizado corretamente!";
	}else{
	  // echo "Aviso: Não foi atualizado!";
	}	
*/	

?>