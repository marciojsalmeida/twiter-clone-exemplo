<?php

session_start();
if(!isset($_SESSION['usuario'])){
		header("Location: index.php?erro=1");
	}

require_once('bd.class.php');

$id_usuario = $_SESSION['id_usuario'];

     $objBd = new bd();
	 $objBd->conecta_mysql();

	 $sql = "SELECT t.id_tweet, t.id_usuario, t.tweet, DATE_FORMAT(t.data_inclusao, '%d %b %y %T') AS data_incusao_formatada, u.usuario ";
	 $sql.= "FROM tweet AS t JOIN usuarios AS u ON (t.id_usuario = u.id) ";
	 $sql.="WHERE id_usuario = $id_usuario ";
	 $sql.="OR id_usuario IN (SELECT seguindo_id_usuario FROM usuarios_seguidores WHERE id_usuario = $id_usuario)" ;
	 $sql.="ORDER BY data_inclusao DESC ";
	 
	$resultado_id =  mysql_query($sql);
	if($resultado_id){

		while($tweet = mysql_fetch_array($resultado_id)){

			echo '<a href="#"  class="list-group-item">';
			echo '<h4 class="list-group-item-heading">'.$tweet['usuario']. '<small> - '.$tweet['data_incusao_formatada'].'</small></h4>';
			echo '<p class="list-group-item-text">'.$tweet['tweet'].'</p>';
			echo '</a>';
		}




	} else {
		echo 'erro na execução da consulta.';
	}
		

	 
?>