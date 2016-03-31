<?php

	$dsn='mysql:host=localhost;dbname=testdb';
	$user='testdb';
	$pass='root';

	function connectDB($dsn,$user,$pass){
		try{
			$db = new PDO($dsn,$user,$pass);
			return $db;
		}catch(PDOException $e){
			//si hay error
			echo $e->getMessage();
			return null;
		}
	}

	//nos conectamos
	$db=connectDB($dsn,$user,$pass);
	//preparamos una sentencia (en este caso un INSERT)
	$stmt=$db->prepare('INSERT INTO users(name,email) VALUES(:name,:email)');
	$name='Chuck';
	$email='chuck.norris@god.us';
	$stmt->bindParam(':name',$name);
	$stmt->bindParam(':email',$email);
	//ejecutamos sentencia
	$stmt->execute();
	//visualizamos resultados	
	//creamos la sentencia mysql
	$stmt=$db->query('SELECT * FROM users');
	//recuperamos los datos de la sentencia
	while($row=$stmt->fetch()){
		echo 'ID: '.$row['id'].'<br/>'.
			 'Name: '.$row['name'].'<br/>'.
			 'Email: '.$row['email'].'<br/><br/>';
	}
	//desconexión
	$db=null;

/*
try{
	//prueba de conexión
	$dsn='mysql:host=localhost;dbname=testdb';
	$user='testdb';
	$pass='root';
	$db = new PDO($dsn,$user,$pass);
	echo 'Conexión establecida. <br/><br/>';

	foreach($db->query('SELECT * FROM users') as $fila){
		print_r($fila);
	}
}catch(PDOException $e){
	//si hay error
	echo $e->getMessage();
}
*/

?>