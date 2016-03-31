<?php
	/**
	 *  vHome
	 *  Prepares and loads the corresponding Template
	 *  @author Toni
	 * 
	 * */
	class vPost extends View{

		function __construct(){
			parent::__construct();
			
			$this->tpl=Template::load('post',$this->view_data);
			
		}

	}