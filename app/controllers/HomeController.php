<?php

class HomeController extends Controller{
	public function index(){
		$db = DB::getInstance();
		$products = $db->getAll('products', 'desc');
		$locales = $db->getAll('locales');
		$this->view('index', true, compact('products', 'locales'));
	}

	public function local(){
		$db = DB::getInstance();
		$id = Session::get('user')->id;
		$cart = Session::get('cart') ? Session::get('cart') : [];
		if(count($cart) == 0){
			$db->update('users', $id, [
				'local_id' => $_POST['local_id']
			]);
			Session::set('flash', 'Local de recojo actualizado');
			redirect();
		}else{
			Session::set('error', 'El carrito debe estar vacío para poder cambiar el local de recojo');
			redirect();
		}
		
	}

	public function history(){
		$db = DB::getInstance();
		$user_id =Session::get('user')->id;
		$orders = $db->findAll('orders', 'client_id', $user_id);
		$this->view('history', true, compact('orders'));
	}

	public function error(){
		$this->view('404');
	}

	public function checkout(){
		$db = DB::getInstance();
		$cart = Session::get('cart') ? Session::get('cart') : [];

		if(!Session::get('loggedIn')){
			Session::set('error', 'Primero debe iniciar sesión');
			redirect();
		}

		if(count($cart) == 0){
			Session::set('error', 'Primero debe agregar productos al carrito');
			redirect();
		}

		$user = Session::get('user');
		$total = 0;

		foreach($cart as $item){
			$total += $item['price'] * $item['quantity'];
		}
		
		$db->insert('orders', [
			'client_id' => $user->id,
			'date' => date('Y-m-d H:i:s'),
			'total' => $total
		]);

		$order_id = $db->lastID();
		$order = $db->find('orders', 'id', $order_id);

		foreach($cart as $item){
			$db->insert('order_details', [
				'order_id' => $order_id,
				'product_id' => $item['id'],
				'price' => $item['price'],
				'quantity' => $item['quantity']
			]);
		}

		Session::set('cart', []);

		$this->view('confirm', true, compact('order'));
	}

	// public function changePassword(){
	// 	if($_POST){
	// 		$v = new Validation();
	// 		$v->check($_POST, [
	// 			'clave_actual' => [
	// 				'name' => 'Clave actual',
	// 				'required' => true
	// 			],
	// 			'clave_nueva' => [
	// 				'name' => 'Clave nueva',
	// 				'required' => true,
	// 				'minlength' => 6,
	// 				'type' => 'alphanum'
	// 			],
	// 			'clave_nueva2' => [
	// 				'name' => 'Confirmar clave nueva',
	// 				'required' => true,
	// 				'minlength' => 6,
	// 				'type' => 'alphanum',
	// 				'equal' => 'clave_nueva'
	// 			],
	// 		]);
	// 		if($v->isOk()){
	// 			$user_id = Session::get('user')->id;
	// 			$db = DB::getInstance();
	// 			$row = $db->query("SELECT clave FROM usuario WHERE id = {$user_id}")->first();
	// 			if($row->clave == $_POST['clave_actual']){
	// 				if($row->clave != $_POST['clave_nueva']){
	// 					if($db->update('usuario', $user_id, [
	// 						'clave' => $_POST['clave_nueva']
	// 					])){
	// 						Session::set('flash', 'Clave actualizada correctamente');
	// 						die(json_encode([
	// 							'status' => 1
	// 						]));
	// 					}	
	// 				}else{
	// 					die(json_encode([
	// 						'status' => 0,
	// 						'message' => 'La clave nueva es igual a la actual'
	// 					]));
	// 				}
					
	// 			}else{
	// 				die(json_encode([
	// 					'status' => 0,
	// 					'message' => 'La clave actual es incorrecta'
	// 				]));
	// 			}
				
	// 		}else{
	// 			die(json_encode([
	// 				'status' => 0,
	// 				'message' => $v->getErrors()
	// 			]));
	// 		}
	// 	}
	// }

}