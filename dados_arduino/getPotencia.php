<?php 
	require_once("../funcoes/conexao.php");

	//$objDadosArduino = new DadosArduino();
	//$objDadosArduino->pesquisaTodosOsDadosArduino();

	$table = array();
	$table['cols'] = array(
			    array('label'=>'Watts','type'=>'number')
	);
	$rows = array();
	

	$resultado = mysql_query("SELECT potencia FROM dados_arduino ORDER BY id DESC LIMIT 1");


		$dadosArduino = array();
		while($linha =mysql_fetch_array($resultado, MYSQL_ASSOC)){
			//$dadosArduino[$linha['hora']] = $linha['potencia'];
			
			$potencia = $linha['potencia'];
			$temp = array();
			$temp[] = array('v'=>$potencia);
			$rows[] = array('c'=>$temp);
			
		}
		$table['rows'] = $rows; 
		$jsonTable =  json_encode($table);
		//echo json_encode($dadosArduino);# code...
	
	
	echo $jsonTable;
	
?>