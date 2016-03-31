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

		
		$model_return = $this->model->m_post($title,$description,$image);
		Sleep(1);
		if($model_return == 0){
			header('Location: '.APP_W.'home');
		}else{
			echo "Error: ".$model_return;
		}
	}
}