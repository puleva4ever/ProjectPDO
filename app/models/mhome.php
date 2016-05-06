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

		function m_get_total_score($ad){
			$this->query("SELECT * FROM score WHERE ad = :ad");
			$this->bind(':ad',$ad);
			$this->execute();
			$scores = $this->resultSet();
			$total_score = 0;
			$cont = 0;

			foreach($array_score as $row) {
				$total_score = $total_score + $row["score"];
				$cont++;
			}

			$total_score = $total_score / $cont;

			$output = array(
				'score' => $total_score,
				'outOf' => $cont
			);

			return $output;
		}

		function m_checkIfRated($user,$ad){

			$this->query("SELECT * FROM users WHERE user = :user");
			$this->bind(':user',$user);
			$this->execute();
			$query_user = $this->resultSet();
			$user = $query_user['id_user'];


			$this->query("SELECT * FROM score WHERE user = :user AND ad = :ad");
			$this->bind(':user',$user);
			$this->bind(':ad',$ad);
			$this->execute();

			if($this->rowCount() > 0){
				return true;
			}else{
				return false;
			}

		}
	}