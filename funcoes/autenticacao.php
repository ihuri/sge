<?php require("conexao.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Autenticação de Usuario</title>
	<script type="text/javascript">
		function loginsucessfully(){
			setTimeout("window.location='../painel.php'",100);
		}
		function loginfailed(){
			setTimeout("window.location='../index.html'",800);
		}
	</script>
</head>
<body>
<?php
$userName = $_POST['userName'];
$password = $_POST['password'];
$sql = mysql_query("select * from user where name = '$userName'and password = '$password'") or die(mysql_error());
$row = mysql_num_rows($sql);
if($row > 0){
	session_start();
	$_SESSION['userName'] = $_POST['userName'];
	$_SESSION['password'] = $_POST['password'];
	echo "<center>Usuario Autenticado com sucesso! Aguarde um estante.</center>";
	echo "<script>loginsucessfully()</script>";
}
else{
	echo "<center>Usuario invalido! Aguarde um estante.</center>";
	echo "<script>loginfailed()</script>";
}
?>
</body>
</html> 