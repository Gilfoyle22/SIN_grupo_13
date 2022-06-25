<?php

class LocalController extends Controller {
	public function index(){
		$db = DB::getInstance();
		$locales = $db->getAll('locales');
		$this->view('locales/index', true, compact('locales'));
	}

	public function create(){
		$this->view('locales/create');
	}

	public function store(){
		$db = DB::getInstance();
		$v = new Validation();

		$v->check($_POST, [
			'name' => [
				'name' => 'Nombre',
				'required' => true,
			]
		]);

		if($v->isOk()){
			$name = $_POST['name'];

			$db->insert('locales', [
				'name' => $name,
			]);

			Session::set('flash', 'Local creado');
			redirect('/locales');
		}else{
			Session::set('error', $v->getErrors());
			redirect('/locales/create');
		}
	}

	public function edit($id){
		$db = DB::getInstance();
		$local = $db->find('locales', 'id', $id);
		
		if(!$local){
			redirect('/locales');
		}

		$this->view('locales/edit', true, compact('local'));
	}

	public function update($id){
		$db = DB::getInstance();
		$v = new Validation();

		$v->check($_POST, [
			'name' => [
				'name' => 'Nombre',
				'required' => true,
			]
		]);

		if($v->isOk()){
			$name = $_POST['name'];

			$db->update('locales', $id, [
				'name' => $name
			]);

			Session::set('flash', 'Local actualizado');
			redirect('/locales');
		}else{
			Session::set('error', $v->getErrors());
			redirect('/local/'.$id);
		}
	}

	public function destroy($id){
		$db = DB::getInstance();

		$db->delete('locales', 'id', $id);

		Session::set('flash', 'Local eliminado');
			redirect('/locales');
	}
}