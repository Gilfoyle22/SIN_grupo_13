<?php
function format($var){
	echo '<pre>';
	print_r($var);
	echo '</pre>';
}

function url($url = '/'){
	return BASE_PATH . $url;
}

function redirect($url = '/'){
	header('Location:' . BASE_PATH . $url);
	exit();
}

function upper($data){
	if(is_array($data)){
		foreach($data as $k => $v){
			$data[$k] = mb_strtoupper($v, 'UTF-8');
		}
		return $data;
	}else{
		return mb_strtoupper($data, 'UTF-8');
	}
}

function verifySession(){
	if(!Session::get('loggedIn')){
		redirect();
	}
}

function checkRole($role){
	if(Session::get('user')){
		if(Session::get('user')->role == $role){
			return true;
		}else{
			return false;
		}
	}else{
		return false;
	}
}

function formatDate($date){
	return date('d/m/Y H:i', strtotime($date));
}