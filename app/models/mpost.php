<?php

	class mPost extends Model{

		function __construct(){
			parent::__construct();

		}

		function m_post($title,$description,$image,$latitude,$longitude){
			$output = 0;
			$user = null;

			$this->db;
			$this->query("SELECT id_ad FROM ads WHERE title = :title AND description = :description AND image = :image");
			$this->bind(':title',$title);
			$this->bind(':description',$description);
			$this->bind(':image',$image);
			$this->execute();

			$this->beginTransaction();

			if($this->rowCount() == 0){
				$this->query("SELECT id_user FROM users WHERE email = :user");
				$this->bind(':user',SESSION::get('user'));
				$this->execute();
				$user = $this->resultSet();
				$user = $user[0]['id_user'];
				if($this->rowCount() > 0){
					$this->query("INSERT INTO ads(title,description,latitude,longitude,user) VALUES(:title,:description,:latitude,:longitude,:user)");
					$this->bind(':title',$title);
					$this->bind(':description',$description);
					$this->bind(':latitude',$latitude);
					$this->bind(':longitude',$longitude);
					$this->bind(':user',$user);
					$this->execute();
					if($this->rowCount() > 0){
						$this->query("INSERT INTO images(image_path,resolution,size,ad) VALUES(:image,null,null,:ad)");
						$this->bind(':image',$image);
						$this->bind(':ad',$this->lastInsertID());
						$this->execute();
						if($this->rowCount() > 0){
							$this->query("INSERT INTO images(image_path,resolution,size,ad) VALUES(:image,null,null,:ad)");
							$this->bind(':image',$image);
							$this->bind(':ad',$this->lastInsertID());
							$this->execute();
						}else{
							$output = -4;
						}
					}else{
						$output = -3;
					}
				}else{
					$output = -2;
				}
			}else{
				$output = -1;
			}

			if($output == 0){
				$this->endTransaction();
			}else{
				$this->cancelTransaction();
			}	

			return $output;
		}


		function m_rating($score,$user,$ad){

			$this->query("INSERT INTO score VALUES(:ad, :user, :score)");
			$this->bind(':ad',$ad);
			$this->bind(':user',$user);
			$this->bind(':score',$score);
			$this->execute();

			if($this->rowCount() > 0){
				$this->query("SELECT * FROM score WHERE ad = :ad");
				$this->bind(':ad',$ad);
				$this->execute();				
				
				return $this->model->m_get_total_score($ad);

			}else{
				return -1;
			}
		}
	}