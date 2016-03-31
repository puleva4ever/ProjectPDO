<?php

	class View{

		protected $tpl;
		protected $view_data;
		function __construct(){
			ob_start();
			$conf=Registry::getInstance();
			// access to app_data that configures html-view
			$this->view_data=(array)$conf->app;
		}
		
	}