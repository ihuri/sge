<?php 
	require_once("../funcoes/conexao.php");

	//$objDadosArduino = new DadosArduino();
	//$objDadosArduino->pesquisaTodosOsDadosArduino();


	$table = array();
	$table['cols'] = array(
				array('label'=>'Mes','type'=>'string'),
			    array('label'=>'Kw','type'=>'number'),
	
	);
	$rows = array();

	    $resultado = mysql_query("SELECT kwh, date_format(evento, '%M') as mes, max(evento) as ultimo_registro from dados_arduino where DATE_FORMAT(EVENTO,'%d') = 1 group by date(evento)");
	    
		$dadosArduino = array();
		$KwhAnterio = 0;
		while($linha =mysql_fetch_array($resultado, MYSQL_ASSOC)){
			//$dadosArduino[$linha['hora']] = $linha['potencia'];
			
			if($KwhAnterio > 0){
			    $mes = $linha['mes'];
			    $kw = $linha['kwh'];
			    $kwd = $kw - $KwhAnterio; 
			    $temp = array();
			    $temp[] = array('v'=>$mes);
			    $temp[] = array('v'=>$kwd);
			    $rows[] = array('c'=>$temp);
			}
			$KwhAnterio = $linha['kwh'];
		}
		$table['rows'] = $rows; 
		$jsonTable =  json_encode($table);
		//echo json_encode($dadosArduino);# code...
	
	
	echo $jsonTable;
    

	