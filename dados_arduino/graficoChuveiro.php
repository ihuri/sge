<?php
	function f($v, $n) {
		if ($n <= 0) return 1;
		else
		return $v[$n-1] * f($v, $n-2) + 1;
	}
	$a = array(0,1,2,3);
	print (f($a, 4));
/*
$potencia = 50;
$tempo = 1;

//$e = ($potencia * $tempo) / 1000;
$e = 0.0337998;

$te = 0.27263;
$tu = 0.21531;
$bd = 0.05;

$reais = (($te * $e) + ($tu * $e) + ($bd * $e));
echo "<br>";

echo $reais; 

echo "<br>";




$dia = date('d');
$diaRestante = ultimoDiaMes() - $dia;

$valorGasto = diaAnterior_kwh() - d01_kwh();

$previsao = (gastoDiaAnterior_kwh() * $diaRestante) + $valorGasto;

echo $previsao; 
//echo $dia ." - ". ultimoDiaMes() ." = ". $diaRestante;



$dia = date('d');
$mes = date('m');
$ano = date('Y');
$diasMes = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);
$semanasMes = round($diasMes/7, 0);


// Array com os dias da semana
$diasemana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado');

// Aqui podemos usar a data atual ou qualquer outra data no formato Ano-mês-dia (2014-02-28)
$data = date('2017-11-01');

// Varivel que recebe o dia da semana (0 = Domingo, 1 = Segunda ...)
$diasemana_numero = date('w', strtotime($data));

// Exibe o dia da semana com o Array
echo $diasemana[$diasemana_numero];
echo $diasemana_numero;

*/


?>

