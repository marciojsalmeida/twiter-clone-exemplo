<?php

session_start();
if(!isset($_SESSION['usuario'])){
		header("Location: index.php?erro=1");
	}

require_once('bd.class.php');

$id_usuario = $_SESSION['id_usuario'];
$tweet = $_POST['txt_tweet'];

     $objBd = new bd();
	 $objBd->conecta_mysql();

	 $sql = "INSERT INTO tweet (id_usuario, tweet) values ('$id_usuario', '$tweet')";
	 
	
	 mysql_query($sql);

	 
?>