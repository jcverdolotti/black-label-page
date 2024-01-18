<?php
	namespace App\Models;
	use \PDO;

	class Db {
		private $dbHost = "localhost";
		private $dbUser = "root";
		private $dbPass = "";
		private $dbName = "juegos_php";

		public function conectar(){
			$dsn = "mysql:dbname=$this->dbName;host=$this->dbHost";
		
			try {
				$DB = new PDO($dsn, $this->dbUser, $this->dbPass);
				$DB-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return $DB;
			} catch (\PDOException $e){
				echo 'Fallo la conexion';
			}
		
		
		}
	
	
	}
?>