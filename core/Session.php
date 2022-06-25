<?php

class Session{

	public static function all(){
		return $_SESSION;
	}

	public static function get($key){
		if(isset($_SESSION[$key])){
			return $_SESSION[$key];
		}else{
			return false;
		}
	}

	public static function set($key, $value){
		$_SESSION[$key] = $value;
	}

	public static function remove($key){
		if(isset($_SESSION[$key])){
			unset($_SESSION[$key]);
		}
	}

	public static function clear(){
		session_destroy();
	}

}