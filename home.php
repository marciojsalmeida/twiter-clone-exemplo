<?php
	session_start();
	if(!isset($_SESSION['usuario'])){
		header("Location: index.php?erro=1");
	}
	require_once('bd.class.php');
	 $objBd = new bd();
	 $objBd->conecta_mysql();

	 $id_usuario = $_SESSION['id_usuario'];

	//quantidade de tweets
	 $sql = "SELECT COUNT(*) AS qtde_tweets FROM tweet WHERE id_usuario = $id_usuario";

	 $resultado_id = mysql_query($sql);
	 $qtde_tweets = mysql_fetch_array($resultado_id);

	//quantidade de seguidoes
	 $sql = "SELECT COUNT(*) AS qtde_seguidores FROM usuarios_seguidores WHERE seguindo_id_usuario = $id_usuario";

	 $resultado_id = mysql_query($sql);
	 $qtde_seguidores = mysql_fetch_array($resultado_id);
	
?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">

		<title>Twitter clone</title>
		
		<!-- jquery - link cdn -->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

		<!-- bootstrap - link cdn -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

		<script type="text/javascript">
			
			$(document).ready(function(){
				//se o botão foi clicado
				$('#btn_tweet').click(function(){
					//verificar se possui 1 ou mais caracter
					if($('#txt_tweet').val().length > 0){
						
						$.ajax({
							url: 'inclui_tweet.php',
							method: "post",
							data: $('#form_tweet').serialize(),

							success: function(data){
								$('#txt_tweet').val('');
								atualizaTweets();
							}

						});
					}
				});

				function atualizaTweets(){
					//carrega os tweets
					$.ajax({
						url: 'get_tweet.php',
						metodo: 'post',
						success: function(data){
							$('#tweets').html(data);
						}

					});
				}

				atualizaTweets();

			});

		</script>
	
	</head>

	<body>

		<!-- Static navbar -->
	    <nav class="navbar navbar-default navbar-static-top">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <img src="imagens/icone_twitter.png" />
	        </div>
	        
	        <div id="navbar" class="navbar-collapse collapse">
	          <ul class="nav navbar-nav navbar-right">
	            <li><a href="sair.php">Sair</a></li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </nav>


	    <div class="container">

	    	<div class="col-md-3">
	    		<div class="panel panel-default">
	    			<div class="panel-body">
	    				<h4><?=$_SESSION['usuario'] ?></h4>

	    				<hr />
	    				<div class="col-md-6">
	    					TWEETS <br /><?= $qtde_tweets['qtde_tweets'] ?>
	    				</div>
	    				<div class="col-md-6">
	    					SEGUIDORES<br /><?= $qtde_seguidores['qtde_seguidores'] ?>
	    				</div>
	    			</div>
	    		</div>
	    	</div>
	    	<div class="col-md-6">
	    		<div class="panel panel-default">
	    			<div class="panel-body">
	    				<form id="form_tweet">
		    				<div class="input-group">
		    					<input type="text"  class="form-control" id="txt_tweet" name="txt_tweet" placeholder="O que está acontecendo agora?" maxlength="140">
		    					<span class="input-group-btn">
		    						<button class="btn btn-default" id="btn_tweet" type="button">Tweet</button>
		    					</span>
		    				</div>
	    				</form>
	    			</div>
	    		</div>
	    		<div id="tweets" class="list-group">
	    			
	    		</div>
	    	</div>

			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-body">
						<h4><a href="procurar_pessoas.php">Procurar por pessoas</a></h4>
					</div>
				</div>

			</div>

			<div class="clearfix"></div>

		</div>


	    </div>
	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	</body>
</html>