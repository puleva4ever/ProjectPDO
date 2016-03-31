<?php

class Users extends Controller{

	protected $model;
	protected $view;

	function __construct($params){
			parent::__construct($params);
			$this->model = new mHome();
			$this->view = new vUsers();	
	}

	function home(){

	}

}

?>