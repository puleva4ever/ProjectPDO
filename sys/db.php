<?php

class DB extends PDO{

	static $_instance;
	public function __construct(){

		$dsn='mysql:host=localhost;dbname=projectpdo';
		$user='root';
		$pass='';

		//recuperar dades configuració de Config.json
		$config=Registry::getInstance();
		$dbconf=(array)$config->dbconf;
		Coder::codear($dbconf);
		try{
			parent::__construct($dsn,$user,$pass);
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	static function singleton(){
		if(!(self::$_instance instanceof self)){
			self::$_instance=new self();
		}return self::$_instance;
	}
}


?>