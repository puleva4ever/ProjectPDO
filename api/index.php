<?php

require 'vendor/autoload.php';
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

require 'vendor/connect.php';




/* ---------------------------- GET - LISTAR USUARIOS ---------------------------- */
$app->get('/users',function(){

	$app = \Slim\Slim::getInstance();
	$db = getDB(); // DATABASE CONNECTION	

	$stmt = $db->prepare('SELECT * FROM users');
	$stmt->execute();

	if($stmt->rowCount() == 0){
		echo "{'response':'no_users_found'}";
	}else{
		$result = $stmt->fetchAll(PDO::FETCH_OBJ);

		$app->response->setStatus(200);
		$app->response->headers->set('Content-Type', 'application/json');
		$parsed = json_encode($result);
		echo $parsed;
	}

	$db=null; // DATABASE DISCONNECTION
});



/* ---------------------------- POST - INSERTAR USUARIO ---------------------------- */
$app->post('/users', function(){

	$request = \Slim\Slim::getInstance()->request();	
	$info = $request->params();
	$db = getDB(); // DATABASE CONNECTION

	$phone = NULL;
	$rol = 2;	

	if(!empty($info['email']) && !empty($info['password']) && !empty($info['name'])){

		$email = $info['email'];
		$password = $info['password'];
		$name = $info['name'];
		if(isset($info['phone'])){
			$phone = $info['phone'];
		}
		if(isset($info['rol'])){
			$rol = $info['rol'];
		}

		$stmt = $db->prepare('SELECT * FROM users WHERE email = :email');
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->execute();

		if($stmt->rowCount() > 0){
			$msg = json_encode(array('response' => 'user_exists'));
		}else{
			$stmt = $db->prepare('INSERT INTO users(email, password, name, phone, rol) VALUES(:email, :password, :name, :phone, :rol)');		
			$stmt->bindParam(':email', $email, PDO::PARAM_STR);
			$stmt->bindParam(':password', $password, PDO::PARAM_STR);
			$stmt->bindParam(':name', $name, PDO::PARAM_STR);
			$stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
			$stmt->bindParam(':rol', $rol, PDO::PARAM_STR);
			$res = $stmt->execute();

			if($stmt->rowCount() > 0){
				$msg = json_encode(array('response' => 'created'));
			}else{
				$msg = json_encode(array('response' => 'cannot_create'));
			}
		}		
	}else{
		$msg = json_encode(array('response' => 'missing_params'));
	}

	echo $msg;

	$db=null; // DATABASE DISCONNECTION
});



/* ---------------------------- PUT - ACTUALIZAR USUARIO ---------------------------- */
$app->put('/users', function(){

	$request = \Slim\Slim::getInstance()->request();	
	$info = $request->params();
	$db = getDB(); // DATABASE CONNECTION

	if(!empty($info['id_user']) && !empty($info['email']) && !empty($info['password']) && !empty($info['name'])){
		$id_user = $info['id_user'];
		$email = $info['email'];
		$password = $info['password'];
		$name = $info['name'];
		$phone = $info['phone'];
		$rol = $info['rol'];

		$stmt = $db->prepare('SELECT * FROM users WHERE id_user = :id_user');
		$stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		if($stmt->rowCount() == 0){
			$msg = json_encode(array('response' => 'user_not_exists'));
		}else{

			$stmt = $db->prepare("UPDATE users SET email = :email, password = :password, name = :name, phone = :phone, rol = :rol WHERE id_user = :id_user");	
			$stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);	
			$stmt->bindParam(':email', $email, PDO::PARAM_STR);
			$stmt->bindParam(':password', $password, PDO::PARAM_STR);
			$stmt->bindParam(':name', $name, PDO::PARAM_STR);
			$stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
			$stmt->bindParam(':rol', $rol, PDO::PARAM_INT);
			$res = $stmt->execute();
			if($stmt->rowCount() > 0){
				$msg = json_encode(array('response' => 'updated'));
			}else{
				$msg = json_encode(array('response' => 'cannot_update'));
			}
		}		
	}else{
		$msg = json_encode(array('response' => 'missing_params'));
	}

	echo $msg;

	$db=null; // DATABASE DISCONNECTION
});



/* ---------------------------- DELETE - BORRAR USUARIO ---------------------------- */
$app->delete('/users', function(){

	$request = \Slim\Slim::getInstance()->request();	
	$info = $request->params();
	$db = getDB(); // DATABASE CONNECTION

	$id_user=0;
	$email=0;

	if(isset($info['id_user'])){
		$id_user = $info['id_user'];
	}else if(isset($info['email'])){
		$email = $info['email'];		
	}else{
		echo json_encode(array('response' => 'param_error'));
		die;
	}

	$stmt = $db->prepare('SELECT * FROM users WHERE id_user = :id_user OR email = :email');
	$stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
	$stmt->bindParam(':email', $email, PDO::PARAM_STR);
	$stmt->execute();

	if($stmt->rowCount() == 0){
		$msg = "user_not_exists";
	}else{
		$stmt = $db->prepare("DELETE FROM users WHERE id_user = :id_user OR email = :email");	
		$stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);	
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$res = $stmt->execute();
		if($stmt->rowCount() > 0){
			$msg = json_encode(array('response' => 'deleted'));
		}else{
			$msg = json_encode(array('response' => 'cannot_delete'));
		}
	}

	echo $msg;

	$db=null; // DATABASE DISCONNECTION
});



$app->run(); // EXECUTE

?>