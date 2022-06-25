<?php

class CartController extends Controller{
	
	public function index(){
		$cart = Session::get('cart') ? Session::get('cart') : [];
		$this->view('cart', true, compact('cart'));
	}

	public function store($id){

		$db = DB::getInstance();
		$cart = Session::get('cart') ? Session::get('cart') : [];
		$product = $db->find('products', 'id', $id);

		if($product){
			$found = false;
			$foundKey = 0;

			foreach($cart as $key => $value) {
				if($value['id'] == $id){
					$found = true;
					$foundKey = $key;
				}
			}

			if($found){
				$cart[$foundKey]['quantity'] += 1;
			}else{
				$cart[] = [
					'id' => $product->id,
					'image' => $product->image,
					'name' => $product->name,
					'price' => $product->price,
					'quantity' => 1
				];
			}

			Session::set('cart', $cart);
			Session::set('flash', 'Producto agregado');
			redirect('/cart');
		}
	}

	public function remove(){
		$id = isset($_POST['id']) ? $_POST['id'] : null;

		$cart = Session::get('cart') ? Session::get('cart') : [];

		foreach ($cart as $key => $value) {
			if($value['id'] == $id){
				array_splice($cart, $key, 1);
			}
		}

		Session::set('cart', $cart);
		Session::set('flash', 'Producto eliminado');

		redirect('/cart');
	}

	public function update(){
		$db = DB::getInstance();

		$id = isset($_POST['id']) ? $_POST['id'] : null;
		$quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 1;

		$product = $db->find('products', 'id', $id);

		$cart = Session::get('cart') ? Session::get('cart') : [];
		
		if($quantity >= 1){

			foreach ($cart as $key => $value) {
				if($value['id'] == $id){
					if($product->stock >= $quantity){
						$cart[$key]['quantity'] = $quantity;
					}else{
						Session::set('error', 'La cantidad ingresada es mayor al stock disponible');
						redirect('/cart');
					}
				}
			}
		}

		Session::set('cart', $cart);
		Session::set('flash', 'Producto actualizado');

		redirect('/cart');
	}

	public function clear(){
		Session::set('cart', []);

		redirect('/cart');
	}


}