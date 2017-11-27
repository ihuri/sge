<?php
require_once ("conexao.php");

//função geral responsavel por otmizar a velocidade do banco
function otimizaBanco(){
	/*if(mes("anterior") >= 1 && mes("anterior") < mes("atual")){
		upDados_mes();
		delDados_arduino();
	}
*/
}


//função que deleta o banco deixando apenas a ultima linha. 
function delDados_arduino(){
	$id_atual = maxId("dados_arduino");
	$del = mysql_query("DELETE FROM dados_arduino WHERE id < '$id_atual'");
	if(mysql_affected_rows() > 0){
	 // echo "Sucesso: Deletados corretamente!";
	}else{
	  // echo "Aviso: Não foi deletados!";
	}	
}

//função que retorna o mes atual ou o mes anterior
function mes($dado){
	$mes;
	$resultado = mysql_query("SELECT (DATE_FORMAT(CURRENT_DATE(),'%m')-1) AS mesAnterior, DATE_FORMAT(evento, '%m') as mesAtual from dados_arduino ORDER BY id DESC LIMIT 0,1");
	while($linha =mysql_fetch_array($resultado, MYSQL_ASSOC))
	{	
		if ($dado == "anterior") {
			$mes = intval($linha["mesAnterior"]);
		}
		if ($dado == "atual") {
			$mes = intval($linha["mesAtual"]);
		}

	}
	return $mes;
}

//função par Salvar dados na tabela dados_mes
function upDados_mes(){
	$kw = kwh();
	$gasto = vlKw($kw);
	$insert = "insert into dados_mes (kw, gasto_atual) values (".$kw.",".$gasto.")";

	mysql_query($insert);

	if ($insert) {
		echo "<br>Salvo com successo!<br>";
	}
	else{
		echo "<br>Ocorreu um erro<br>";
	}

}

//função par Salvar dados na tabela dados_semana
function upDados_semana(){
	$kw = kwh();
	$gasto = vlKw($kw);
	$insert = "insert into dados_semana (kw, gasto_atual) values (".$kw.",".$gasto.")";

	mysql_query($insert);

	if ($insert) {
		echo "<br>Salvo com successo!<br>";
	}
	else{
		echo "<br>Ocorreu um erro<br>";
	}

}
//função que retorna a meta em porcentagem
function meta_p(){
        $meta = perfil("meta_mensal");
        
        $vl_atual = valor_h();
        $vl_mes;
        //$resultado = mysql_query("SELECT floor((atual_vl/'$meta')*100) as porcentagem FROM dados_conta ORDER BY id DESC LIMIT 0,1");
        $resultado = mysql_query("select min(id) as id_mes, atual_vl from dados_conta where DATE_FORMAT(EVENTO,'%d') = 1 AND DATE_FORMAT(EVENTO,'%m') = (EXTRACT(MONTH FROM CURDATE()))");
        //passando os dados para um array
        $meta_array = array();
    	while($linha =mysql_fetch_array($resultado, MYSQL_ASSOC))
	    {
	    	$vl_mes = floatval($linha["atual_vl"]);
    
    	}
        return round((($vl_atual - $vl_mes)/$meta)*100, 0);
}
//função que retorna o atual kwh
function kwh(){
	$kwh;
	$resultado = mysql_query("SELECT kwh FROM dados_arduino ORDER BY id DESC LIMIT 0,1");
	while($linha =mysql_fetch_array($resultado, MYSQL_ASSOC))
	{
		$kwh = floatval($linha["kwh"]);

	}
	return $kwh;
}
//função que retorna quanto já foi gasto no dia anterior
function diaAnterior_kwh(){
    $kwh = array();
	
    $resultado = mysql_query("SELECT kwh, max(evento) as data from dados_arduino group by date(evento) DESC limit 3");
    
	while($linha =mysql_fetch_array($resultado, MYSQL_ASSOC)){
	    $kwh[] = $linha['kwh'];
    }
	
	$gasto = $kwh[1];
	return $gasto;
}
//função que retorna quanto foi gasto no dia anterior
function gastoDiaAnterior_kwh(){
    $kwh = array();
	
    $resultado = mysql_query("SELECT kwh, max(evento) as data from dados_arduino group by date(evento) DESC limit 3");
    
	while($linha =mysql_fetch_array($resultado, MYSQL_ASSOC)){
	    $kwh[] = $linha['kwh'];
    }
	
	$kwh_gasto = $kwh[1] - $kwh[2];
	return $kwh_gasto;
}
//função que retorna o kwh do dia 1 do mes atual
function d01_kwh(){
	$kwh;
	$resultado = mysql_query("SELECT kwh FROM dados_arduino WHERE date_format(evento, '%d') = 1 ORDER BY id DESC LIMIT 0,1");
	while($linha =mysql_fetch_array($resultado, MYSQL_ASSOC))
	{
		$kwh = floatval($linha["kwh"]);

	}
	return $kwh;
}
//função que retorna a atual Potencia
function at_potencia(){
	$at_p;
	$resultado = mysql_query("SELECT kwh FROM dados_arduino ORDER BY id DESC LIMIT 0,1");
	while($linha =mysql_fetch_array($resultado, MYSQL_ASSOC))
	{
		$at_p = floatval($linha["kwh"]);

	}
	return $at_p;
}
//função que retorna o atual gasto em R$
function valor_h(){
	$valor_h;
	$resultado = mysql_query("SELECT atual_vl FROM dados_conta ORDER BY id DESC LIMIT 0,1");
	while($linha =mysql_fetch_array($resultado, MYSQL_ASSOC))
	{
		$valor_h = floatval($linha["atual_vl"]);

	}
	return $valor_h;
}
function valor_m(){
	$valor_m;
	$resultado = mysql_query("SELECT round(atual_vl,2) as reais FROM dados_conta WHERE date_format(evento,'%d') = 1 ORDER BY id DESC LIMIT 1");
	while($linha =mysql_fetch_array($resultado, MYSQL_ASSOC))
	{
		$valor_m = floatval($linha["reais"]);

	}
	return $valor_m;
}
//função que retorna o ultimo ID da tabela que é passada no parametro 
function maxId($nome_tabela){
	$id_arduino;
	$id_conta;
	$result = mysql_query("SELECT max(id) as m from dados_arduino");
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		$id_arduino = intval($row["m"]);
	}
	$result1 = mysql_query("SELECT max(id) as m from dados_conta");
	while($row = mysql_fetch_array($result1, MYSQL_ASSOC))
	{
		$id_conta = intval($row["m"]);
	}
	if($nome_tabela == "dados_arduino"){return $id_arduino;}
	if($nome_tabela == "dados_conta"){return $id_conta;}
}
//função que retorna o primeiro ID da tabela que é passada no parametro
function minId($nome_tabela){
	$id_arduino;
	$id_conta;
	$result2 = mysql_query("SELECT min(id) as m from dados_arduino");
	while($row = mysql_fetch_array($result2, MYSQL_ASSOC))
	{
		$id_arduino = intval($row["m"]);
	}
	$result3 = mysql_query("SELECT min(id) as m from dados_conta");
	while($row = mysql_fetch_array($result3, MYSQL_ASSOC))
	{
		$id_conta = intval($row["m"]);
	}
	if($nome_tabela == "dados_arduino"){return $id_arduino;}
	if($nome_tabela == "dados_conta"){return $id_conta;}
}

//salva os dados na tabela dados_conta
function upDados_conta($kwh){
	$vl_tu = valorTarifa("tu") * $kwh;
	$vl_te = valorTarifa("te") * $kwh;
	$vl_bandeira = valorBandeira() * $kwh;
	$vl_total = $vl_bandeira + $vl_te + $vl_tu;
	echo "<br>'$vl_tu'";
	echo "<br>'$vl_te'";
	echo "<br>'$vl_bandeira'";
	echo "<br>'$vl_total'";
	$insert = "insert into dados_conta (vl_bandeira,vl_te,vl_tu,atual_vl) values (".$vl_bandeira.",".$vl_te.",".$vl_tu.",".$vl_total.")";

	mysql_query($insert);

	if ($insert) {
		echo "<br>Salvo com successo!<br>";
	}
	else{
		echo "<br>Ocorreu um erro<br>";
	}
}

//retorna quanto custa Kw
function vlKw($kw){
	$vlTu = valorTarifa("tu") * $kw;
	$vlTe = valorTarifa("te") * $kw;
	$vlBandeira = valorBandeira() * $kw;
	$vlTotal = $vlBandeira + $vlTe + $vlTu;
	
	return $vlTotal;
}

//recebe valores de configurações do perfil do usuario
function perfil($dado){
	//passando os dados para a suas respectivas variaveis
	$id_user;
	$id_bandeira;
	$id_tarifa;
	$meta_mensal;
	$resultado = mysql_query("SELECT id_user, id_bandeira, id_tarifa, meta_mensal FROM perfil WHERE id = 1");
	while($row =mysql_fetch_array($resultado, MYSQL_ASSOC))
	{
		$id_user = intval($row["id_user"]);
		$id_bandeira = intval($row["id_bandeira"]);
		$id_tarifa = intval($row["id_tarifa"]);
		$meta_mensal = floatval($row["meta_mensal"]);
	}

			//echo "ID USUARIO: ". $id_user . "<br>";
			//echo "ID Tarifa: ". $id_tarifa . "<br>";
			//echo "ID Bandeira: ". $id_bandeira . "<br>";
			//echo "META MENSAL: ". $meta_mensal . "<br>";
			//if($p == "all"){return $id_user, $id_bandeira, $id_tarifa, $meta_mensal;}
	if($dado == "id_user"){return $id_user;}
	if($dado == "id_bandeira"){return $id_bandeira;}
	if($dado == "id_tarifa"){return $id_tarifa;}
	if($dado == "meta_mensal"){return $meta_mensal;}		 	
}
//receber valor da tarifa selecionada
function valorTarifa($dado){
//passando os dados para a suas respectivas variaveis
	$id_tarifa = perfil("id_tarifa");
	$vl_te;
	$vl_tu;
	$resultado = mysql_query("SELECT tu, te FROM tarifa WHERE id = '$id_tarifa'");
	while($linha =mysql_fetch_array($resultado, MYSQL_ASSOC))
	{
		$vl_tu = $linha["tu"];
		$vl_te = $linha["te"];
				  //echo "tu: ". $linha["tu"] . "<br>";
				  //echo "te: ". $linha["te"] . "<br>";
	}
			//echo "Valor tu: ". $tu . "<br>";
			//echo "Valor te: ". $te . "<br>";
	$vl_te = floatval($vl_te);
	$vl_tu = floatval($vl_tu);
	if($dado == "tu"){return $vl_tu;}
	if($dado == "te"){return $vl_te;}
}

//recebe o valor da bandeira selecionada
function valorBandeira(){
			//bandeira
	$id_bandeira = perfil("id_bandeira");
	$vl_bandeira;
	$resultado = mysql_query("SELECT custo FROM bandeiras WHERE id = '$id_bandeira'");
	while($linha =mysql_fetch_array($resultado, MYSQL_ASSOC))
	{
		$vl_bandeira = floatval($linha["custo"]);

	}
			//echo "Valor bandeira: ". $vl_bandeira . "<br>";
	return $vl_bandeira;
}		

//função para buscar qual bandeira que está em vigor no site da eletropaulo
function atualBandeira(){
	$num_id;
	$url = file_get_contents('http://www.aneel.gov.br/tarifas');
	$bd_verde = "/VERDE/s";
	$bd_amarela = "/AMARELA/s";
	$bd_vermelhap1 = "/VERMELHA1/s";
	$bd_vermelhap2 = "/VERMELHA2/s";
	if(preg_match_all($bd_verde, $url, $conteudo)){
		//echo "Bandeira Verde encontrada!";
		$num_id = 1;
	}else if(preg_match_all($bd_amarela, $url, $conteudo)){
		//echo "Bandeira Amarela encontrada!";
		$num_id = 2;
	}else if(preg_match_all($bd_vermelhap1, $url, $conteudo)){
		//echo "Bandeira Vermelha encontrada P1!";
		$num_id = 3;
	}else if(preg_match_all($bd_vermelhap2, $url, $conteudo)){
		//echo "Bandeira Vermelha encontrada P2!";
		$num_id = 4;
	}else{
        echo "ERROR - Nenhuma Bandeira encontrada!";
	}

	$up = mysql_query("UPDATE perfil set id_bandeira = '$num_id' WHERE id = 1");
	if(mysql_affected_rows() > 0){
	 // echo "Sucesso: Atualizado corretamente!";
	}else{
	  // echo "Aviso: Não foi atualizado!";
	}	
}

//função para retornar o ultimo dia do mes

function ultimoDiaMes(){
    $mes = date('m');
    $ano = date('Y');
    $ultimoDiaMes = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);
    
    return $ultimoDiaMes;
}
?>