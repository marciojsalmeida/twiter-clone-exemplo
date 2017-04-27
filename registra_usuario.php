<?php
	 
require_once('bd.class.php');
	 $usuario = $_POST['usuario'];
	 $email = $_POST['email'];
	 $senha = md5($_POST['senha']);
	 $usuario_existe = false;

	 $objBd = new bd();
	 $objBd->conecta_mysql();

	 $sql = "select * from usuarios where usuario = '$usuario' OR email = '$email'";
	 if($resultado_id = mysql_query($sql)){
	 	$dados = mysql_fetch_array($resultado_id);

	 	if(isset($dados['usuario'])){
	 		$usuario_existe = true;
	 	} 

	 }	else {
	 	echo 'Erro ao tentar o registro de usuário e/ou email no banco de dados.';

	 }	

	 if($usuario_existe){
	 	header("Location: inscrevase.php?erro=1");
	 	die();
	 }

	 
	 $sql = "insert into usuarios(usuario, email, senha)values('$usuario', '$email', '$senha')";
	 
	 if(mysql_query($sql)){
	 	header("Location: index.php?registro=1");
	 }	else {
	 	echo 'Erro ao tentar inserir um registro.';
	 }	

?>