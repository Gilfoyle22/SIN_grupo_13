<?php

class AuthController extends Controller{
	
	public function loginForm(){
		$this->view('login');
	}

	public function login(){
		if($_POST){
			$v = new Validation();

			$v->check($_POST, [
				'email' => [
					'name' => 'Usuario',
					'required' => true,
					'type' => 'email'
				],
				'password' => [
					'name' => 'Contraseña',
					'required' => true
				]
			]);

			if($v->isOk()){
				$db = DB::getInstance();
				$email = $_POST['email'];
				$password = $_POST['password'];
				$user_data = $db->find('users', 'email', $email);

				if($user_data){
					if(password_verify($password, $user_data->password)){

						if($user_data->online == 0){

							$db->update('users', $user_data->id, [
								'online' => 1
							]);

							unset($user_data->password);
							Session::set('loggedIn', true);
							Session::set('user', $user_data);
							redirect();
						}else{
							Session::set('error', 'Sólo se puede iniciar sesión en 1 dispositivo');
							redirect('/login');
						}
						
					}else{
						Session::set('error', 'La contraseña es incorrecta');
						redirect('/login');
					}
				}else{
					Session::set('error', 'El usuario no existe');
					redirect('/login');
				}
			}else{
				Session::set('error', $v->getErrors());
				redirect('/login');
			}
		}
	}

	public function register(){
		if($_POST){
			$v = new Validation();

			$v->check($_POST, [
				'name' => [
					'name' => 'Nombre',
					'required' => true
				],
				'last_name' => [
					'name' => 'Apellidos',
					'required' => true
				],
				'email' => [
					'name' => 'Usuario',
					'required' => true,
					'type' => 'email'
				],
				'password' => [
					'name' => 'Contraseña',
					'required' => true
				]
			]);

			if($v->isOk()){
				$db = DB::getInstance();
				$name = $_POST['name'];
				$last_name = $_POST['last_name'];
				$email = $_POST['email'];
				$password = $_POST['password'];

				$user_data = $db->find('users', 'email', $email);


				if($user_data){
					Session::set('error', 'El correo ya se encuentra registrado');
					redirect('/login');
				}

				$db->insert('users', [
					'name' => $name,
					'last_name' => $last_name,
					'email' => $email,
					'password' => password_hash($password, PASSWORD_DEFAULT),
					'role' => 'client'
				]);

				Session::set('loggedIn', true);
				Session::set('user', (object) [
					'id' => $db->lastID(),
					'name' => $name,
					'last_name' => $last_name,
					'email' => $email,
					'role' => 'client'
				]);

				redirect();

			}else{
				Session::set('error', $v->getErrors());
				redirect('/login');
			}
		}
	}

	public function logout(){
		$db = DB::getInstance();
		$id = Session::get('user')->id;

		$db->update('users', $id, [
			'online' => 0
		]);

		Session::clear();
		redirect('/login');
	}

	public function verify_session(){
		if(!Session::get('loggedIn')){
			redirect('/');
		}
	}
}