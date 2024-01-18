<?php

	use App\Models\Db;


	function YaExisteElNombre($tabla, $nombre){
		$existe = false;
		try{

			$db = new Db();
	        $db = $db->conectar();

	        $sql = "SELECT nombre FROM $tabla WHERE nombre = :nombre";
	        $stmt = $db->prepare($sql);
	        $stmt->bindParam("nombre", $nombre);  
	        $stmt->execute();
	        $arrayGeneros = $stmt->fetchAll(); 

	        if($arrayGeneros){                         
	            $existe = true;

	        }
	        return $existe;

        } catch(PDOException $e) {
	        $GLOBALS["response"]->getBody()->write(json_encode($e->getMessage()));
	        return $GLOBALS["response"]->withHeader('content-type','aplication/json')->withStatus(404);
    	}
	}
?>