<?php

session_start();
if(!isset($_SESSION['usuario'])){
		header("Location: index.php?erro=1");
	}

require_once('bd.class.php');

$id_usuario = $_SESSION['id_usuario'];
$nome = $_POST['txt_nome'];

     $objBd = new bd();
	 $objBd->conecta_mysql();

	 $sql = "SELECT u.*, us.id_usuario_seguidor FROM usuarios AS u ";
	 $sql.= "LEFT JOIN usuarios_seguidores AS us ON(u.id = us.seguindo_id_usuario AND us.id_usuario = $id_usuario) ";
	 $sql.= "WHERE u.usuario like '%$nome%' AND u.id <> $id_usuario ";
	 

	$resultado_id =  mysql_query($sql);

	if($resultado_id){

		while($pessoa = mysql_fetch_array($resultado_id)){

			$esta_seguindo_usuario_sn = isset($pessoa['id_usuario_seguidor']) && !empty($pessoa['id_usuario_seguidor']) ? 'S' : 'N' ;

			echo '<a href="#"  class="list-group-item">';
			echo '<strong>'.$pessoa['usuario'].'</strong><small> - '.$pessoa['email'].'</small>';
			echo '<p class="list-group-item-text pull-right">';

			$btn_seguir_display = 'block';
			$btn_deixar_seguir_display = 'block';
			if($esta_seguindo_usuario_sn == 'N'){
				$btn_deixar_seguir_display = 'none';
			} else {
				$btn_seguir_display = 'none';
			}

			echo '<button type="button" class="btn btn-default btn_seguir" id="seguir_'.$pessoa['id'].'" data-id_usuario="'.$pessoa['id'].'" style="display:'.$btn_seguir_display.'">Seguir</button>';
			echo '<button type="button" class="btn btn-primary btn_deixar_seguir" id="deixar_seguir_'.$pessoa['id'].'" data-id_usuario="'.$pessoa['id'].'" style="display:'.$btn_deixar_seguir_display.'">Deixar de seguir</button>';
			echo '</p>';
			echo '<div class="clearfix"></div>';
			echo '</a>';
		}

	} else {
		echo 'erro na execução da consulta.';
	}
		

	 
?>