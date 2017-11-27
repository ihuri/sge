<?php 
    require_once("../funcoes/conexao.php");
    $dia = date('d');

	$kwh = array();
	
    $resultado = mysql_query("SELECT kwh, max(evento) as data from dados_arduino group by date(evento) DESC limit 3");
    
	while($linha =mysql_fetch_array($resultado, MYSQL_ASSOC)){
		$kwh[] = $linha['kwh'];
	}
	
	$kwh_gasto = $kwh[1] - $kwh[2];
	$kwh_previsão = round(($kwh_gasto * 6 ) + kwh_gasto, 0);
	echo $kwh_previsão;

?>