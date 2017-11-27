<?php 
	require_once("../funcoes/conexao.php");

	class DadosArduino
	{
		public function pesquisaTodosOsDadosArduino(){
			
			$resultado = mysql_query("SELECT * FROM dados_arduino");
			while($linha =mysql_fetch_array($resultado, MYSQL_ASSOC)){
				echo "<pre>";
				print_r($linha);
			}
		}
	}

?>