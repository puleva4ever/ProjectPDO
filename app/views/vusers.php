<?php

	class vUsers extends View{

		function __construct(){
			parent::__construct();
			
			$this->tpl=Template::load('dashboard',$this->view_data);
			
		}

	}