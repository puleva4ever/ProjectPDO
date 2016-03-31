<?php

class Admin extends Controller{

	protected $model;
	protected $view;

	function __construct($params){
			parent::__construct($params);
			$this->model = new mAdmin();
			$this->view = new vAdmin();	
	}

	function home(){

	}

	function fill_users(){
		$output = $this->model->m_fill_users();
		$this->json_out($output);
	}

	function get_user_data(){
		$user = $_POST['user'];
		$output = $this->model->m_get_user_data($user);
		$this->json_out($output);
	}

	function delete_user(){
		$user = $_POST['user'];
		$output[] = $this->model->m_delete_user($user);
		$this->json_out($output);
	}

	function edit_user(){
		$user = $_POST['user'];
		$email = $_POST['email'];
		$pass = $_POST['pass'];
		$conf_pass = $_POST['conf_pass'];
		$name = $_POST['name'];
		$phone = $_POST['phone'];
		$rol = $_POST['rol'];

		if($email != null && $pass != null && $conf_pass != null && $name != null){

			if($pass == $conf_pass){
				$model_return = $this->model->m_edit_user($user,$email,$pass,$name,$phone,$rol);
				if($model_return > 0){
					$output[] = '0';
				}else{
					$output[] = '-3';
				}	
			}else{
				$output[] = '-2';
			}

							

		}else{
			$output[] = '-1';
		}

		$this->json_out($output);
	}
}

?>