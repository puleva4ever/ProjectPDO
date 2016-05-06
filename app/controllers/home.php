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

		}

		function login(){
			$email = $_POST['email'];
			$pass = $_POST['pass'];

			$model_return = $this->model->login($email,$pass);

			if($model_return > 0){
				Session::set('user',$email);
				setcookie('user',Session::get('user'),0,APP_W);
				sleep(1);
				$this->json_out(array('redir'=>APP_W.'users'));
			}else if($model_return < 0){
				Session::set('user',$email);
				setcookie('user',Session::get('user'),0,APP_W);
				sleep(1);
				$this->json_out(array('redir'=>APP_W.'admin'));
			}else{
				$this->json_out(array('redir'=>APP_W.'register'));
			}
		}

		function getCookie(){
			if($_COOKIE['user']){
				$this->json_out(array('response' => $_COOKIE['user']));
			}else{
				$this->json_out(array('response' => '-1'));
			}
		}

		function logout(){
			setcookie("user", "", time() - 3600);
			session_destroy();
			header('Location:'.APP_W.'home');
		}

		function show_post(){
			$output = $this->model->m_show_post();
			$this->json_out($output);
		}

		function c_checkIfRated(){
			$user = $_POST['user'];
			$ad = $_POST['ad'];
			$mod_out = $this->model->m_checkIfRated($user,$ad);
			$this->json_out(array('response' => $mod_out));
		}

		function c_get_total_score(){
			$ad = $_POST['ad'];
			$mod_out = $this->model->m_get_total_score($ad);
			$this->json_out(array('response' => $mod_out));			
		}

}