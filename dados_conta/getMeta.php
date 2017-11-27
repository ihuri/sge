<?php 
	require_once("../funcoes/conexao.php");
	require("../funcoes/funcoes.php");

	//$objDadosArduino = new DadosArduino();
	//$objDadosArduino->pesquisaTodosOsDadosArduino();
    

	    $coluna1 = array('label'=>'Meta', 'type' => 'string');
        $coluna2 = array('label'=>'Porcentagem', 'type' => 'number');
        
    $colunas = array($coluna1, $coluna2);
    
	    $objeto1Linha1 = array('v'=>'Consumido');
        $objeto2Linha1 = array('v'=>strval(meta_p()));
        $valorLinha1 = array($objeto1Linha1, $objeto2Linha1);
        $linha1 = array('c' => $valorLinha1);
        $objeto1Linha2 = array('v'=>'Livre');
        $objeto2Linha2 = array('v'=>strval(100 - meta_p()));
        $valorLinha2 = array($objeto1Linha2, $objeto2Linha2);
        $linha2 = array('c' => $valorLinha2);
        
    $linhas = array($linha1, $linha2);
    $table = array('cols' => $colunas, 'rows' => $linhas);
			
	    $jsonTable =  json_encode($table);
		//echo json_encode($dadosArduino);# code...
	
	
	echo $jsonTable;
	
?>
