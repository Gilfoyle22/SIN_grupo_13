<?php

class Validation{
	private $_success= false, $_errors = [], $_db = null;

	public function __construct(){

	}

	public function check($source, $items = []){

		foreach($items as $item => $rules){
			$name = $rules['name'];
			foreach($rules as $rule => $rule_value){
				if(array_key_exists($item, $source)){
					$value = $source[$item];
					if($rule === 'required' && empty($value)){
						$this->addError("{$name} es requerido");
					}else if($value != ''){
						switch ($rule) {
							case 'min':
								if($value < $rule_value){
									$this->addError("{$name} no debe ser menor a {$rule_value}");
								}
								break;
							case 'max':
								if($value > $rule_value){
									$this->addError("{$name} no debe ser mayor a {$rule_value}");
								}
								break;
							case 'minlength':
								if(strlen($value) < $rule_value){
									$this->addError("{$name} no debe ser menor a {$rule_value} caracteres");
								}
								break;
							case 'maxlength':
								if(strlen($value) > $rule_value){
									$this->addError("{$name} no debe ser mayor a {$rule_value} caracteres");
								}
								break;
							case 'equal':
								if($value != $source[$rule_value]){
									$match = $items[$rule_value]['name'];
									$this->addError("{$match} y {$name} deben ser iguales");
								}
								break;
							case 'length':
								if(strlen($value) != $rule_value){
									$this->addError("{$name} debe tener {$rule_value} caracteres");
								}
								break;
							case 'type':
								switch ($rule_value) {
									case 'numeric':
										if(!preg_match("/^[0-9]+$/", $value)){
											$this->addError("{$name} debe tener solo números");
										}
										break;
									case 'alpha':
										if(!preg_match("/^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ ]+$/", $value)){
											$this->addError("{$name} debe tener solo letras");
										}
										break;
									case 'alphanum':
										if(!preg_match("/^[a-zA-Z0-9áéíóúüñÁÉÍÓÚÜÑ]+$/", $value)){
											$this->addError("{$name} debe tener solo letras y/o numeros");
										}
										break;
									case 'words':
										if(!preg_match("/^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ ]+$/", $value)){
											$this->addError("{$name} debe tener solo letras y espacios");
										}
										break;
									case 'email':
										if(!filter_var($value, FILTER_VALIDATE_EMAIL)){
											$this->addError("{$name} debe ser un email", $item);
										}
										break;
								}
								break;
						}
					}
				}
			}
		}
	}

	public function addError($error){
		$this->_errors[] = $error;
	}

	public function isOk(){
		if(empty($this->_errors)){
			$this->_success = true;
		}else{
			$this->_success = false;
		}
		return $this->_success;
	}

	public function errors(){
		return $_errors;
	}

	public function getErrors(){
		$html = '<ul>';
		foreach($this->_errors as $error){
			$html .= "<li>$error</li>";
		}
		$html .= '<ul>';
		return $html;
	}
}