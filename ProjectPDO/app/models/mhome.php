<?php

	class mHome extends Model{

		function __construct(){
			parent::__construct();

		}

		function login($email,$pass){
			$output=null;

			$this->query("SELECT * FROM users WHERE email = :email AND password = :pass");
			$this->bind(':email',$email);
			$this->bind(':pass',$pass);
			$this->execute();

			if($this->rowCount() > 0){
				$result = $this->resultSet();
				if($result[0]['rol'] == 1){
					$output = -1;
				}else{
					$output = $this->rowCount();
				}
			}else{
				$output = $this->rowCount();
			}
			
			return $output;
		}


		function m_show_post(){
			$this->query("SELECT * FROM ads INNER JOIN images ON ads.id_ad = images.ad");
			$this->execute();
			return $this->resultSet();
		}

	}