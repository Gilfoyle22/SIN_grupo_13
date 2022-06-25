<?php

class ProductController extends Controller {
	public function index(){
		$db = DB::getInstance();
		$products = $db->getAll('products');
		$this->view('products/index', true, compact('products'));
	}

	public function create(){
		$this->view('products/create');
	}

	public function store(){
		$db = DB::getInstance();
		$v = new Validation();

		$v->check($_POST, [
			'name' => [
				'name' => 'Nombre',
				'required' => true,
			],
			'price' => [
				'name' => 'Precio',
				'required' => true
			],
			'image' => [
				'name' => 'Imagen',
				'required' => true,
			],
			'stock' => [
				'name' => 'Stock',
				'required' => true,
				'type' => 'numeric'
			]
		]);

		if($v->isOk()){
			$name = $_POST['name'];
			$description = $_POST['description'];
			$price = $_POST['price'];
			$image = $_POST['image'];
			$stock = $_POST['stock'];

			$db->insert('products', [
				'name' => $name,
				'description' => $description,
				'price' => $price,
				'image' => $image,
				'stock' => $stock
			]);

			Session::set('flash', 'Producto creado');
			redirect('/products');
		}else{
			Session::set('error', $v->getErrors());
			redirect('/products/create');
		}
	}

	public function edit($id){
		$db = DB::getInstance();
		$product = $db->find('products', 'id', $id);
		
		if(!$product){
			redirect('/products');
		}

		$this->view('products/edit', true, compact('product'));
	}

	public function update($id){
		$db = DB::getInstance();
		$v = new Validation();

		$v->check($_POST, [
			'name' => [
				'name' => 'Nombre',
				'required' => true,
			],
			'price' => [
				'name' => 'Precio',
				'required' => true
			],
			'image' => [
				'name' => 'Imagen',
				'required' => true,
			],
			'stock' => [
				'name' => 'Stock',
				'required' => true,
				'type' => 'numeric'
			]
		]);

		if($v->isOk()){
			$name = $_POST['name'];
			$description = $_POST['description'];
			$price = $_POST['price'];
			$image = $_POST['image'];
			$stock = $_POST['stock'];

			$db->update('products', $id, [
				'name' => $name,
				'description' => $description,
				'price' => $price,
				'image' => $image,
				'stock' => $stock
			]);

			Session::set('flash', 'Producto actualizado');
			redirect('/products');
		}else{
			Session::set('error', $v->getErrors());
			redirect('/product/'.$id);
		}
	}

	public function destroy($id){
		$db = DB::getInstance();

		$db->delete('products', 'id', $id);

		Session::set('flash', 'Producto eliminado');
			redirect('/products');
	}
}