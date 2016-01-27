<?php
	
	class Home extends Controller{
		protected $model;
		protected $view;
		
		function __construct($params){
			parent::__construct($params);
			$this->model = new mHome();
			$this->view = new vHome();

			
			
		}
		function home(){
			//Coder::codear($this->conf);
		}



}