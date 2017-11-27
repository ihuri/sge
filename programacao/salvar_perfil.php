<?php
require ("../funcoes/conexao.php");

//$id_bandeira = $_POST["id_bandeira"];
$id_tarifa = $_POST["id_tarifa"];
$meta_mensal = $_POST["meta_mensal"];
$id_perfil = 1;
$cmd = "SELECT COUNT(id) FROM perfil";
$perfis = mysql_query($cmd);

//conta o total de itens
$total = mysql_num_rows($perfis);

if($total == 0){
	$sql_insert = "insert into perfil (id_tarifa,meta_mensal) values (".$id_tarifa.",".$meta_mensal.")";
	//$sql_insert = "insert into perfil (id_bandeira,id_tarifa,meta_mensal) values (".$id_bandeira.",".$id_tarifa.",".$meta_mensal.")";
	
		mysql_query($sql_insert);
	
		if ($sql_insert) {
			echo "Salvo com successo!";
		}
		else{
			echo "Ocorreu um erro";
		}
}
else{
	$up = mysql_query("UPDATE perfil SET id_tarifa='$id_tarifa', meta_mensal= '$meta_mensal' WHERE id='$id_perfil'");
	//$up = mysql_query("UPDATE perfil SET id_bandeira='$id_bandeira', id_tarifa='$id_tarifa', meta_mensal= '$meta_mensal' WHERE id='$id_perfil'");
	 
	if(mysql_affected_rows() > 0){
	  echo "Sucesso: Atualizado corretamente!";
	}else{
	  echo "Aviso: Não foi atualizado!";
	}	
}
?>