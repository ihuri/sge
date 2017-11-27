<?php
$url = file_get_contents('https://www.aeseletropaulo.com.br/Paginas/aes-eletropaulo.aspx');
$bd_verde = "/Verde/s";
$bd_amarela = "/Amarela/s";
$bd_vermelha = "/Vermelha/s";
if(preg_match_all($bd_verde, $url, $conteudo)){
	echo "Bandeira Verde encontrada!";
}else if(preg_match_all($bd_amarela, $url, $conteudo)){
	echo "Bandeira Amarela encontrada!";
}else if(preg_match_all($bd_vermelha, $url, $conteudo)){
	echo "Bandeira Vermelha encontrada!";
}else{
	echo "ERROR - Nenhuma Bandeira encontrada!";
}
?>