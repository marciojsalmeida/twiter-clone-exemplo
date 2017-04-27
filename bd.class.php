<?php
	class bd {
		//host
		private $host = 'localhost';
		//usuario
		private $user = 'root';
		//senha
		private $password = 'root';
		//banco de dados
		private $database = 'twitter_clone';

		public function conecta_mysql(){
			$con = mysql_connect($this->host, $this->user, $this->password) or die("Erro ao conectar ao servidor: ".mysql_error());
			mysql_select_db($this->database) or die("Erro ao selecionar o banco de dados: ".mysql_error());
			mysql_query("SET NAMES 'utf8'");
			mysql_query("SET character_set_connection=utf8");
			mysql_query("SET character_set_client=utf8");
			mysql_query("SET character_set_results=utf8");

			return $con;
		}


	}
?>