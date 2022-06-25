<?php
//trabaja los datos y pasar a la vista
class Controller{
	
	public $view, $data = [];

	public function view($file, $template = true, $data = []){
		
		if(is_array($data)){
			$this->data = $data;
		}
		
		if($template){
			$this->view = $file;
			$this->render('template');
		}else{
			$this->render($file);
		}

	}

	public function render($file){
		
		if(file_exists('./app/views/' . $file . '.php')){
			extract($this->data);
			require_once './app/views/' . $file . '.php';
		}
	}
	
}