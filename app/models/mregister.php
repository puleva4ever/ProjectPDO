<?php

	class mRegister extends Model{

		function __construct(){
			parent::__construct();
		}

		function m_register($email,$pass,$name,$phone){			
			$this->query("CALL sp_new_user(:email,:password,:name,:phone)");
			$this->bind(':email',$email);
			$this->bind(':password',$pass);
			$this->bind(':name',$name);
			$this->bind(':phone',$phone);
			$this->execute();
			return $this->rowCount();
		}

	}

?>