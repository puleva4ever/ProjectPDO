<?php

class Post extends Controller{

	protected $model;
	protected $view;

	function __construct($params){
			parent::__construct($params);
			$this->model = new mPost();
			$this->view = new vPost();	
	}

	function home(){

	}

	function c_post(){
		$title = $_POST['title'];
		$description = $_POST['description'];
		$image = $_POST['image'];
		$latitude = $_POST['latitude'];
		$longitude = $_POST['longitude'];

		
		$model_return = $this->model->m_post($title,$description,$image,$latitude,$longitude);
		Sleep(1);
		if($model_return == 0){
			header('Location: '.APP_W.'home');
		}else{
			echo "Error: ".$model_return;
		}
	}

	function c_rating(){
		$score = $_POST['score'];
		$user = $_POST['user'];
		$ad = $_POST['ad'];

		$model_return = $this->model->m_rating($score, $user, $ad);
		Sleep(1);
		echo $model_return;
	}


}