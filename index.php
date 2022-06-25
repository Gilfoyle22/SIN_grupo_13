<?php

session_start();

spl_autoload_register(function($className){
	if(file_exists('./core/' .$className. '.php')){
		require_once './core/' .$className. '.php';
	}elseif(file_exists('./app/controllers/' .$className. '.php')){
		require_once './app/controllers/' .$className. '.php';
	}
});

require_once './core/config.php';
require_once './core/helpers.php';
require_once './app/routes.php';


