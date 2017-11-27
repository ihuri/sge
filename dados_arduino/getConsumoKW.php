<?php 
	require_once("../funcoes/conexao.php");

	//$objDadosArduino = new DadosArduino();
	//$objDadosArduino->pesquisaTodosOsDadosArduino();


    $dia = date('d');

	$table = array();
	$table['cols'] = array(
				array('label'=>'Dia','type'=>'string'),
			    array('label'=>'Kw','type'=>'number'),
	
	);
	$rows = array();
	
    if($dia > 7){
	    $resultado = mysql_query("SELECT kwh as kw, date_format(evento,'%d de %M') as dia from dados_arduino a inner join(SELECT max(evento) as ultimo_registro from dados_arduino group by date(evento) DESC limit 8) as b on b.ultimo_registro = a.evento WHERE evento BETWEEN CURRENT_DATE()-8 AND CURRENT_DATE()");
	    
		$dadosArduino = array();
		$KwhAnterio = 0;
		while($linha =mysql_fetch_array($resultado, MYSQL_ASSOC)){
			//$dadosArduino[$linha['hora']] = $linha['potencia'];
			
			if($KwhAnterio > 0){
			    $dia = $linha['dia'];
			    $kw = $linha['kw'];
			    $kwd = $kw - $KwhAnterio; 
			    $temp = array();
			    $temp[] = array('v'=>$dia);
			    $temp[] = array('v'=>$kwd);
			    $rows[] = array('c'=>$temp);
			}
			$KwhAnterio = $linha['kw'];
		}
		$table['rows'] = $rows; 
		$jsonTable =  json_encode($table);
		//echo json_encode($dadosArduino);# code...
	
	
	echo $jsonTable;
    }
    else{
        echo "deu certo";
    }
	