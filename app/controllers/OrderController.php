<?php

class OrderController extends Controller {
	public function index(){
		$db = DB::getInstance();
		$orders = $db->getAll('orders');
		$this->view('orders/index', true, compact('orders'));
	}

	public function show($id){
		$db = DB::getInstance();
		$order = $db->find('orders', 'id', $id);
		$details = $db->findAll('order_details', 'order_id', $id);
		$this->view('orders/show', true, compact('order', 'details'));
	}

	public function annul($id){
		$db = DB::getInstance();
		$db->update('orders', $id, [
			'annulled' => 1
		]);
		Session::set('flash', 'Pedido anulado');
		redirect('/history');
	}
}