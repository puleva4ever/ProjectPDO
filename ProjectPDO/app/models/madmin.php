<?php

	class mAdmin extends Model{

		function __construct(){
			parent::__construct();

		}

		function m_fill_users(){
			$this->query("SELECT * FROM users WHERE rol = 2");
			$this->execute();
			return $this->resultSet();
		}

		function m_get_user_data($user){
			$this->query("SELECT * FROM users WHERE id_user = :user");
			$this->bind(':user',$user);
			$this->execute();
			return $this->resultSet();
		}

		function m_delete_user($user){
			$this->beginTransaction();
			$this->query("DELETE FROM users WHERE id_user = :user");
			$this->bind(':user',$user);
			$this->execute();

			if($this->rowCount() > 0){
				$this->endTransaction();
			}else{
				$this->cancelTransaction();
			}
			return $this->rowCount();
		}

		function m_edit_user($user,$email,$pass,$name,$phone,$rol){			
			$this->query("UPDATE users SET email = :email , password = :pass , name = :name , phone = :phone , rol = :rol WHERE id_user = :user");
			$this->bind(':email',$email);
			$this->bind(':pass',$pass);
			$this->bind(':name',$name);
			$this->bind(':phone',$phone);
			$this->bind(':rol',$rol);
			$this->bind(':user',$user);
			$this->execute();
			return $this->rowCount();
		}



	}