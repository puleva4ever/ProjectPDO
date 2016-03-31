<?php

class Register extends Controller{

	protected $model;
	protected $view;

	function __construct($params){
			parent::__construct($params);
			$this->model = new mRegister();
			$this->view = new vRegister();
	}

	function home(){

	}

	function c_register(){	
		$email = $_POST['email'];
		$pass = $_POST['pass'];
		$conf_pass = $_POST['conf_pass'];
		$name = $_POST['name'];
		$phone = $_POST['phone'];

		if($email != null && $pass != null && $conf_pass != null && $name != null && $phone != null){
			if($pass == $conf_pass){
				$model_return = $this->model->m_register($email,$pass,$name,$phone);
				if($model_return > 0){
					Session::set('user',$email);
					setcookie('user',Session::get('user'),0,APP_W);
					Sleep(1);
					header('Location: '.APP_W.'users');
				}else{
					echo "<br/>Error al intentar crear el usuario.";
				}
			}else{
				echo "<br/>Las password no coinciden.";
			}
		}else{
			echo "<br/>Rellena todos los campos.";
		}
				

	}

}

?>