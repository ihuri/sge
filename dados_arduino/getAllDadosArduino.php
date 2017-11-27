<?php 
	require_once("../funcoes/conexao.php");

	//$objDadosArduino = new DadosArduino();
	//$objDadosArduino->pesquisaTodosOsDadosArduino();

	$table = array();
	$table['cols'] = array(
				array('label'=>'Hora','type'=>'string'),
			    array('label'=>'Consumo em Watts','type'=>'number')
	);
	$rows = array();
	

	$resultado = mysql_query("SELECT DATE_FORMAT(EVENTO,'%d de %M') AS dia, DATE_FORMAT(EVENTO,'%H:%i') AS hora, potencia FROM dados_arduino WHERE DATE_FORMAT(EVENTO,'%d') = (EXTRACT(DAY FROM CURDATE())) AND DATE_FORMAT(EVENTO,'%m') = (EXTRACT(MONTH FROM CURDATE()))
");


		$dadosArduino = array();
		while($linha =mysql_fetch_array($resultado, MYSQL_ASSOC)){
			//$dadosArduino[$linha['hora']] = $linha['potencia'];
			
			$hora = $linha['hora'];
			$potencia = $linha['potencia'];
			$temp = array();
			$temp[] = array('v'=>$hora);
			$temp[] = array('v'=>$potencia);
			$rows[] = array('c'=>$temp);
			
		}
		$table['rows'] = $rows; 
		$jsonTable =  json_encode($table);
		//echo json_encode($dadosArduino);# code...
	
	
	echo $jsonTable;
	
?>
