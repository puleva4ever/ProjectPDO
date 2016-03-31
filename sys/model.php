<?php

	class Model{

		/*<form action="<?= APP_W.'home/login'; ?>" */

		protected $db;
		protected $stmt;

		function __construct(){
			$this->db=DB::singleton();
		}

		function query($query){
			$this->stmt = $this->db->prepare($query);
		}

		function bind($param,$value,$type=null){
			switch(gettype($value)){
				case "integer":	$this->stmt->bindValue($param,$value,PDO::PARAM_INT);
							   	break;
				case "NULL":	$this->stmt->bindValue($param,$value,PDO::PARAM_NULL);
							   	break;
				case "string":	$this->stmt->bindValue($param,$value,PDO::PARAM_STR);
							   	break;
				case "boolean":	$this->stmt->bindValue($param,$value,PDO::PARAM_BOOL);
							   	break;
				default:$this->stmt->bindValue($param,$value,PDO::PARAM_STR);
						break;
			}
		}

		function execute(){
			$this->stmt->execute();
		}

		function resultSet(){
			return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}	

		function single(){
			return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		function rowCount(){
			return $this->stmt->rowCount();
		}

		function lastInsertID(){
			return $this->db->lastInsertId();			 
		}

		function beginTransaction(){
			$this->db->beginTransaction();			
		}

		function endTransaction(){
			$this->db->commit();			
		}

		function cancelTransaction(){
			$this->db->rollback();
		}

		function debugDumpParams(){
			$this->stmt->debugDumpParams();
		}

		


		
	}

?>