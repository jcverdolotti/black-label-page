<?php
use App\Models\Db;
require "functions.php";

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
require __DIR__ . '/vendor/autoload.php';
$app = AppFactory::create();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept, Origin, Authorization");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH, OPTIONS");



// ENDPOINT GENEROS -> CREAR
$app->post('/generos', function (Request $request, Response $response, $args) {
    $genero = json_decode($request->getBody());

    if(isset($genero->nombre)){
        $genero = $genero->nombre;
        if(empty($genero)){
            $response->getBody()->write("El campo nombre no puede estar vacio");
            return $response->withStatus(400);
        }
        if(YaExisteElNombre("generos", $genero)){
            $response->getBody()->write("Ya existe un genero con ese nombre");
            return $response->withStatus(200);
        }
    }else{
        $response->getBody()->write("Debe mandar un campo nombre con el nombre del genero a crear");
        return $response->withStatus(400);       
    }

    $sql = 'INSERT INTO generos (nombre) VALUES (:nombre)';

    try {
        $db = new Db();
        $db = $db->conectar();      
        $stmt = $db->prepare($sql);

        $stmt->bindParam("nombre", $genero);  

        $stmt->execute();   

        $response->getBody()->write("El genero $genero se ha creado exitosamente");
        return $response->withStatus(201);

    } catch(PDOException $e) {
        $response->getBody()->write(json_encode($e->getMessage()));
        return $response->withHeader('content-type','aplication/json')->withStatus(404);
    }
});


// ENDPOINT GENEROS -> ACTUALIZAR
$app->put('/generos/{id}', function (Request $request, Response $response, $args) {
    $id = $request->getAttribute('id');
    $genero = json_decode($request->getBody());
    $genero = $genero->nombre;

    if(YaExisteElNombre("generos",$genero)){
        $response->getBody()->write("Ya existe un genero con ese nombre");
        return $response->withStatus(200);

    } else{
        $sql = "UPDATE generos SET nombre = :nombre WHERE id = $id";

        try{
            $db = new Db();
            $db = $db->conectar();
            $stmt = $db->prepare($sql);

            $stmt->bindParam("nombre", $genero);  

            $stmt->execute();  

            if($stmt->rowCount() > 0){
                $response->getBody()->write("Genero actualizado");
                return $response->withStatus(201);

            }else{
                $response->getBody()->write("No existe un genero con ese id");
                return $response->withStatus(200);
            }

        } catch(PDOException $e) {
            $response->getBody()->write(json_encode($e->getMessage()));
            return $response->withHeader('content-type','aplication/json')->withStatus(404);
        }
    }
});


// ENDPOINT GENEROS -> ELIMINAR
$app->delete('/generos/{id}', function (Request $request, Response $response, $args) {
    $id = $request->getAttribute('id');
    $sql = "DELETE FROM generos WHERE id = $id";

    try {
        $db = new Db();
        $db = $db->conectar();
        $resultado = $db->prepare($sql); 
        $resultado->execute();   

        if($resultado->rowCount() > 0){
            $response->getBody()->write("Genero eliminado");
            return $response->withStatus(201);
        }else{
            $response->getBody()->write("No existe un genero con ese id");
            return $response->withStatus(200);
        }

    } catch(PDOException $e) {
        if($e->getCode() == 23000){             //foreign key exception
            $response->getBody()->write("El genero de id $id no se puede eliminar porque se usa en la tabla juegos");
            return $response->withStatus(200);
        } else{
            $response->getBody()->write(json_encode($e->getMessage()));
            return $response->withHeader('content-type','aplication/json')->withStatus(404);
        }
    }
});


// ENDPOINT GENEROS -> LISTAR
$app->get('/generos', function (Request $request, Response $response, $args) {
    $sql = "SELECT * FROM generos";

	try{
		$db = new Db();
        $db = $db->conectar();
		$resultado = $db->prepare($sql); 
        $resultado->execute();       

        if($resultado->rowCount() > 0){             
            $arrayGeneros = $resultado->fetchAll(PDO::FETCH_OBJ);           
            $response->getBody()->write(json_encode($arrayGeneros));
            return $response->withHeader('content-type','aplication/json')->withStatus(200);

        } else{
            $response->getBody()->write("No existen generos en la BD");
            return $response->withStatus(200);
        }

	}catch (PDOException $e){
        $response->getBody()->write(json_encode($e->getMessage()));
        return $response->withHeader('content-type','aplication/json')->withStatus(404);
	}
});


// ENDPOINT PLATAFORMAS -> CREAR
$app->post('/plataformas', function (Request $request, Response $response, $args) {
    $plataforma = json_decode($request->getBody());

    if(isset($plataforma->nombre)){
        $plataforma = $plataforma->nombre;
        if(empty($plataforma)){
            $response->getBody()->write("El campo nombre no puede estar vacio");
            return $response->withStatus(400);
        }
        if(YaExisteElNombre("plataformas", $plataforma)){
            $response->getBody()->write("Ya existe un plataforma con ese nombre");
            return $response->withStatus(200);
        }
    }else{
        $response->getBody()->write("Debe mandar un campo nombre con el nombre del plataforma a crear");
        return $response->withStatus(400);       
    }

        $sql = 'INSERT INTO plataformas (nombre) VALUES (:nombre)';

        try {
            $db = new Db();
            $db = $db->conectar();
            $stmt = $db->prepare($sql);

            $stmt->bindParam("nombre", $plataforma);

            $stmt->execute();   

            $response->getBody()->write("La plataforma $plataforma se ha creado exitosamente");
            return $response->withStatus(201);

        } catch(PDOException $e) {
            $response->getBody()->write(json_encode($e->getMessage()));
            return $response->withHeader('content-type','aplication/json')->withStatus(404);
        }
});


// ENDPOINT PLATAFORMAS -> ACTUALIZAR
$app->put('/plataformas/{id}', function (Request $request, Response $response, $args) {
    $id = $request->getAttribute('id');
    $plataforma = json_decode($request->getBody());
    $plataforma = $plataforma->nombre;

    if(YaExisteElNombre("plataformas",$plataforma)){
        $response->getBody()->write("Ya existe una plataforma con ese nombre");
        return $response->withStatus(200);

    } else{
        $sql = "UPDATE plataformas SET nombre = :nombre WHERE id = $id";

        try{
            $db = new Db();
            $db = $db->conectar();
            $stmt = $db->prepare($sql);

            $stmt->bindParam("nombre", $plataforma);  

            $stmt->execute();  

            if($stmt->rowCount() > 0){
                $response->getBody()->write("Plataforma actualizada");
                return $response->withStatus(201);

            }else{
                $response->getBody()->write("No existe una plataforma con ese id");
                return $response->withStatus(200);
            }

        } catch(PDOException $e) {
            $response->getBody()->write(json_encode($e->getMessage()));
            return $response->withHeader('content-type','aplication/json')->withStatus(404);
        }
    }
});


// ENDPOINT PLATAFORMAS -> ELIMINAR
$app->delete('/plataformas/{id}', function (Request $request, Response $response, $args) {
    $id = $request->getAttribute('id');
    $sql = "DELETE FROM plataformas WHERE id = $id";

    try {
        $db = new Db();
        $db = $db->conectar();
        $resultado = $db->prepare($sql); 
        $resultado->execute();   

        if($resultado->rowCount() > 0){
            $response->getBody()->write("Plataforma eliminada");
            return $response->withStatus(201);
        }else{
            $response->getBody()->write("No existe una plataforma con ese id");
            return $response->withStatus(200);
        }

    } catch(PDOException $e) {
        if($e->getCode() == 23000){             //foreign key exception
            $response->getBody()->write("La plataforma de id $id no se puede eliminar porque se usa en la tabla juegos");
            return $response->withStatus(200);
        } else{
            $response->getBody()->write(json_encode($e->getMessage()));
            return $response->withHeader('content-type','aplication/json')->withStatus(404);
        }
    }
});


// ENDPOINT PLATAFORMA -> LISTAR
$app->get('/plataformas', function (Request $request, Response $response, $args) {
    $sql = "SELECT * FROM plataformas";

	try{
		$db = new Db();
        $db = $db->conectar();
		$resultado = $db->prepare($sql); 
        $resultado->execute();    

        if($resultado->rowCount() > 0){             
            $arrayPlataformas = $resultado->fetchAll(PDO::FETCH_OBJ);           
            $response->getBody()->write(json_encode($arrayPlataformas));
            return $response->withHeader('content-type','aplication/json')->withStatus(200);

        } else{
            $response->getBody()->write("No existen plataformas en la BD");
            return $response->withStatus(404);
        }

	}catch (PDOException $e){
        $response->getBody()->write(json_encode($e->getMessage()));
        return $response->withHeader('content-type','aplication/json')->withStatus(404);
	}
});


// ENDPOINT JUEGOS -> CREAR
$app->post('/juegos', function (Request $request, Response $response, $args) {
    $params = json_decode($request->getBody());

    if(isset($params->nombre)){
        $nombre = $params->nombre;
        if(empty($nombre)){
            $response->getBody()->write("El campo nombre no puede estar vacio");
            return $response->withStatus(200);
        }
        // si el juego ya existe no lo agrego
        if(YaExisteElNombre("juegos", $nombre)){
            $response->getBody()->write("Ya existe un juego con ese nombre");
            return $response->withStatus(409);
        }
    } else{
        $response->getBody()->write("Falta el campo nombre");
        return $response->withStatus(200);  
    }

    if(isset($params->imagen)){    
        $imagen = $params->imagen;
        if(empty($imagen)){
            $response->getBody()->write("El campo imagen no puede estar vacio");
            return $response->withStatus(200);
        }
    } else{
        $response->getBody()->write("Falta el campo imagen");
        return $response->withStatus(200);  
    }

    if(isset($params->tipoImagen)){    
        $tipoImagen = $params->tipoImagen;
        if (!(($tipoImagen == 'image/jpeg') || ($tipoImagen == 'image/jpg') || ($tipoImagen == 'image/png'))){ 
            $response->getBody()->write("El tipo de imagen es incorrecto");
            return $response->withStatus(200);         
        }
    } else{
        $response->getBody()->write("Falta el campo tipo imagen");
        return $response->withStatus(200);  
    }

    if(isset($params->descripcion)){
        $descripcion = $params->descripcion;
        if (strlen($descripcion) > 255 ) {
            $response->getBody()->write("No se admiten mas de 255 caracteres para la descripcion");
            return $response->withStatus(200); 
        }
    } else{
        $descripcion = "";  // si no manda el campo descripcion asumimos que quiere una descripcion vacia
    }

    if(isset($params->url)){
        $url = $params->url;
        if (strlen($url) > 80 ) {
            $response->getBody()->write("No se admiten mas de 80 caracteres para el url");
            return $response->withStatus(200); 
        }
    } else{
        $url = "";  // si no manda el campo url asumimos que quiere una url vacia
    }

    if(isset($params->genero)){
        $genero = $params->genero;
        if(empty($genero)){
            $response->getBody()->write("El campo genero no puede estar vacio");
            return $response->withStatus(200);
        }
    } else{
        $response->getBody()->write("Falta el campo genero");
        return $response->withStatus(200); 
    }

    if(isset($params->plataforma)){
        $plataforma = $params->plataforma;
        if(empty($plataforma)){
            $response->getBody()->write("El campo plataforma no puede estar vacio");
            return $response->withStatus(200);
        }
    } else{
        $response->getBody()->write("Falta el campo plataforma");
        return $response->withStatus(200);
    }
    
    try {
        $sql = "INSERT INTO juegos (id, nombre, imagen, tipo_imagen, descripcion, url, id_genero, id_plataforma)
                VALUES (NULL, :nombre, :imagen, :tipoImagen, :descripcion, :url, :genero, :plataforma)";  

        $db = new Db();
        $db = $db->conectar();
        $stmt = $db->prepare($sql);

        $stmt->bindParam("nombre", $nombre);  
        $stmt->bindParam("imagen", $imagen);  
        $stmt->bindParam("tipoImagen", $tipoImagen);  
        $stmt->bindParam("descripcion", $descripcion);  
        $stmt->bindParam("url", $url);  
        $stmt->bindParam("genero", $genero);  
        $stmt->bindParam("plataforma", $plataforma);  

        $stmt->execute();  

        $response->getBody()->write("JUEGO AGREGADO");
        return $response->withStatus(201);

    } catch(PDOException $e) {
        $response->getBody()->write(json_encode($e->getMessage()));
        return $response->withHeader('content-type','aplication/json')->withStatus(404);
    }
});


// ENDPOINT JUEGOS -> ACTUALIZAR
$app->put('/juegos/{id}', function (Request $request, Response $response, $args) {
    $id = $request->getAttribute('id');
    $params = json_decode($request->getBody());

    $set = "";

    if(isset($params->nombre)){
        $nombre = $params->nombre;
        if(empty($nombre)){
            $response->getBody()->write("El campo nombre no puede estar vacio");
            return $response->withStatus(200);
        }
        $set .= "nombre = :nombre, ";
    }

    if(isset($params->tipoImagen)){    
        $tipoImagen = $params->tipoImagen;
        if (!(($tipoImagen == 'image/jpeg') || ($tipoImagen == 'image/jpg') || ($tipoImagen == 'image/png'))){ 
            $response->getBody()->write("El tipo de imagen es incorrecto");
            return $response->withStatus(200);         
        }
        $set .= "tipo_imagen = :tipoImagen, ";
    }

    if(isset($params->imagen)){    
        $imagen = $params->imagen;
        if(empty($imagen)){
            $response->getBody()->write("El campo imagen no puede estar vacio");
            return $response->withStatus(200);
        }
        $set .= "imagen = :imagen, ";
    }

    if(isset($params->descripcion)){
        $descripcion = $params->descripcion;
        if (strlen($descripcion) > 255 ) {
            $response->getBody()->write("No se admiten mas de 255 caracteres para la descripcion");
            return $response->withStatus(200); 
        }   
        $set .= "descripcion = :descripcion, ";
    }

    if(isset($params->url)){
        $url = $params->url;
        if (strlen($url) > 80 ) {
            $response->getBody()->write("No se admiten mas de 80 caracteres para el url");
            return $response->withStatus(200); 
        }
        $set .= "url = :url, ";
    }

    if(isset($params->genero)){
        $genero = $params->genero;
        if(empty($genero)){
            $response->getBody()->write("El campo genero no puede estar vacio");
            return $response->withStatus(200);
        }
        $set .= "id_genero = :genero, ";
    }

    if(isset($params->plataforma)){
        $plataforma = $params->plataforma;
        if(empty($plataforma)){
            $response->getBody()->write("El campo plataforma no puede estar vacio");
            return $response->withStatus(200);
        }
        $set .= "id_plataforma = :plataforma, ";
    }

    $set = rtrim($set, ", ");       // Remueve la coma del final

    $sql = "UPDATE juegos SET $set WHERE id = $id";

    try{
        $db = new Db();
        $db = $db->conectar();
        $stmt = $db->prepare($sql);

        if(isset($params->nombre)){
            $stmt->bindParam("nombre", $nombre); 
        }
        if(isset($params->tipoImagen)){    
            $stmt->bindParam("tipoImagen", $tipoImagen); 
        }
        if(isset($params->imagen)){    
            $stmt->bindParam("imagen", $imagen); 
        }
        if(isset($params->descripcion)){
            $stmt->bindParam("descripcion", $descripcion); 
        }
        if(isset($params->url)){
            $stmt->bindParam("url", $url); 
        }
        if(isset($params->genero)){
            $stmt->bindParam("genero", $genero); 
        }
        if(isset($params->plataforma)){
            $stmt->bindParam("plataforma", $plataforma); 
        }

        $stmt->execute();  

        if($stmt->rowCount() > 0){
            $response->getBody()->write("Juego actualizado");
            return $response->withStatus(200);
        }else{
            $response->getBody()->write("No existe un juego con ese id");
            return $response->withStatus(200);
        }

    } catch(PDOException $e) {
        // si tira ese error, en este caso quiere decir que no existe el id de genero o de plataforma
        if($e->getCode() == 23000){             //foreign key exception
            $response->getBody()->write($e->getMessage());
            return $response->withStatus(200);
        } else{
            $response->getBody()->write(json_encode($e->getMessage()));
            return $response->withHeader('content-type','aplication/json')->withStatus(404);
        }
    }
});


// ENDPOINT JUEGOS -> ELIMINAR
$app->delete('/juegos/{id}', function (Request $request, Response $response, $args) {
    $id = $request->getAttribute('id');
    $sql = "DELETE FROM juegos WHERE id = $id";

    try {
        $db = new Db();
        $db = $db->conectar();
        $resultado = $db->prepare($sql); 
        $resultado->execute();   
        if($resultado->rowCount() > 0){
            $response->getBody()->write("Juego eliminado");
            return $response->withStatus(200);
        }else{
            $response->getBody()->write("No existe un juego con ese id");
            return $response->withStatus(200);
        }

    } catch(PDOException $e) {
        $response->getBody()->write(json_encode($e->getMessage()));
        return $response->withHeader('content-type','aplication/json')->withStatus(404);
    }
});


// ENDPOINT JUEGOS -> BUSCAR
$app->get('/juegos', function (Request $request, Response $response, $args) {
    //$queryParams = $request->getQueryParams();

    // Obtener los valores de los parámetros de la consulta
    $nombre = $_GET['nombre'] ?? null;
    $genero = $_GET['genero'] ?? null;
    $plataforma = $_GET['plataforma'] ?? null;
    $orden = $_GET['orden'] ?? null;

    $sql = "SELECT j.*, g.nombre AS nombre_genero, p.nombre AS nombre_plataforma FROM juegos j INNER JOIN generos g ON g.id = j.id_genero INNER JOIN plataformas p ON p.id = j.id_plataforma WHERE 1=1";

    if(isset($nombre)){
        $sql = $sql . " AND j.nombre LIKE '%" . $nombre . "%'";
    }

    if(isset($genero)){
        $sql = $sql . " AND j.id_genero = $genero ";
    }

    if(isset($plataforma)){
        $sql = $sql . " AND j.id_plataforma = $plataforma ";
    }

    if(isset($orden)){
        if($orden == 'asc') {
            $sql = $sql . " ORDER BY j.nombre ASC ";
        }
        if($orden == 'desc') {
            $sql = $sql . " ORDER BY j.nombre DESC ";
        }
    }
    
    try{
        $db = new Db();
        $db = $db->conectar();
        $resultado = $db->prepare($sql); 
        $resultado->execute();         

        if($resultado->rowCount() > 0){             
            $arrayJuegos = $resultado->fetchAll(PDO::FETCH_OBJ);      
            $response->getBody()->write(json_encode($arrayJuegos, JSON_INVALID_UTF8_IGNORE));
            return $response->withHeader('content-type','aplication/json')->withStatus(200);
        } else{
            $response->getBody()->write("No existen juegos en la BD");
            return $response->withStatus(200);
        }

    }catch (PDOException $e){
        $response->getBody()->write(json_encode($e->getMessage()));
        return $response->withHeader('content-type','aplication/json')->withStatus(404);
    }
});


$app->run();

?>