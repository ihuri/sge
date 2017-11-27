<?php
	require("../funcoes/conexao.php");
	require("../funcoes/funcoes.php");
	//require("../funcoes/otimiza.php");
	$irms = $_GET['irms'];
	$potencia = $_GET['potencia'];
	$tempo = $_GET['tempo'];

	//j = potência x tempo
	//$j = $potencia * $tempo;

	//1J = 2.777778·10-7kWh = (1/3600000)kWh
	//$atualKwh = $j / 3600000;

    //Kw = W/1000
    $kw = $potencia / 1000;

    //1h = 3600
    //h = quantidadesegundos/3600
    $t = $tempo / 3600;

    //kwh = kw * t
    $atualKwh = $kw * $t;
 
    
	$resultado = mysql_query("SELECT kwh FROM `dados_arduino` ORDER BY id DESC LIMIT 0,1");
	$ultimoKwh;
    while($linha =mysql_fetch_array($resultado, MYSQL_ASSOC))
    {
    	  $ultimoKwh = floatval($linha["kwh"]);
   	}

 	$novoKwh = $ultimoKwh + $atualKwh;

	$sql_insert = "insert into dados_arduino (irms,potencia,tempo_s,kwh) values (".$irms.",".$potencia.",".$tempo.",".$novoKwh.")";
    //$sql_insert = "insert into dados_arduino (irms,potencia,tempo_s,joules,kwh) values (".$irms.",".$potencia.",".$tempo.",".$j.",".$novoKwh.")";
	mysql_query($sql_insert);

	if ($sql_insert) {
		echo "DADOS 1 - Salvo com successo!";
	}
	else{
		echo "DADOS 1 - Ocorreu um erro";
	}

	
//salvar dados da tabela dados_conta
	upDados_conta($novoKwh);
	otimizaBanco();
	atualizaBandeira();
?>