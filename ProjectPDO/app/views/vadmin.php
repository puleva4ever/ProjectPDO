<?php

	class vAdmin extends View{

		function __construct(){
			parent::__construct();
			
			$this->tpl=Template::load('adashboard',$this->view_data);
			
		}

	}