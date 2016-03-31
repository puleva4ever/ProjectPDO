<?php

class DB extends PDO{

	static $_instance;
	public function __construct(){

		//recuperar dades configuració de Config.json
		$config=Registry::getInstance();
		$dbconf=(array)$config->dbconf;
		$dsn=$dbconf['driver'].":host=".$dbconf['dbhost'].";dbname=".$dbconf['dbname'];
		$user=$dbconf['dbuser'];
		$pass=$dbconf['dbpass'];
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