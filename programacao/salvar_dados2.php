<?php
	require("../funcoes/conexao.php");
	require("../funcoes/funcoes.php");
	//require("../funcoes/otimiza.php");
	$irms = $_GET['irms'];
	$potencia = $_GET['potencia'];
	$tempo = $_GET['tempo'];

	if($potencia > 32){
		//j = potência x tempo
		$j = $potencia * $tempo;

		//1J = 2.777778·10-7kWh = (1/3600000)kWh
		$atualKwh = $j / 3600000;

		$resultado = mysql_query("SELECT kwh FROM `dados_sensor2` ORDER BY id DESC LIMIT 0,1");
		$ultimoKwh;
    	while($linha =mysql_fetch_array($resultado, MYSQL_ASSOC))
    	{
    	 	 $ultimoKwh = floatval($linha["kwh"]);
   		}

 		$novoKwh = $ultimoKwh + $atualKwh;

		$sql_insert = "insert into dados_sensor2 (irms,potencia,tempo_s,joules,kwh) values (".$irms.",".$potencia.",".$tempo.",".$j.",".$novoKwh.")";

		mysql_query($sql_insert);

		if ($sql_insert) {
			echo "Salvo com successo!";
		}
		else{
		echo "Ocorreu um erro";
		}

		//salvar dados da tabela dados_conta
		upDados_conta($novoKwh);
		otimizaBanco();
		atualizaBandeira();
}
?>