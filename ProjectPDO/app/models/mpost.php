<?php

	class mPost extends Model{

		function __construct(){
			parent::__construct();

		}

		function m_post($title,$description,$image){
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
					$this->query("INSERT INTO ads(title,description,user) VALUES(:title,:description,:user)");
					$this->bind(':title',$title);
					$this->bind(':description',$description);
					$this->bind(':user',$user);
					$this->execute();
					if($this->rowCount() > 0){
						$this->query("INSERT INTO images(image_path,resolution,size,ad) VALUES(:image,null,null,:ad)");
						$this->bind(':image',$image);
						$this->bind(':ad',$this->lastInsertID());
						$this->execute();
						if($this->rowCount() == 0){
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
	}