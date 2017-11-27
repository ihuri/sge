<?php
	//conexao com o banco de dados, ou seja fazendo uma variavel que recebe o login no MySQL (local,usuario,senha)
	$usuario = "root";
	$senha  ="programa";
	$host = "localhost";
	$conexao = mysql_connect($host,$usuario,$senha);
	//selecionando a base de dados e passando que contem as informações do banco
	$seleciona_bd = mysql_select_db('sge', $conexao);
?>