<?php
//clase princial de la bd que se conecta con la bd
class DB{
	private static $_instance = null;
	public $_pdo, $_query, $_error = false, $_result, $_count = 0, $_lastInsertID = null;
	
	public function __construct(){
		try{
			$this->_pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME .';charset=utf8mb4', DB_USER, DB_PASSWORD);
		} catch(PDOException $e){
			die($e->getMessage());
		}
	}

	public static function getInstance(){
		if(!isset(self::$_instance)){
			self::$_instance = new DB();
		}
		return self::$_instance;
	}

	public function query($sql, $params = []){

		$this->_error = false;
		if($this->_query = $this->_pdo->prepare($sql)){
			$i = 1;
			if(count($params)){
				foreach($params as $param){
					$this->_query->bindValue($i, $param);
					$i++;
				}
			}

			if($this->_query->execute()){
				$this->_result = $this->_query->fetchAll(PDO::FETCH_OBJ);
				$this->_count = $this->_query->rowCount();
				$this->_lastInsertID = $this->_pdo->lastInsertId();
			}else{
				$this->_error = true;
			}
		}
		return $this;
	}

	public function getAll($table,$order = 'asc',$limit = null){

		if($limit){
			$sql = "SELECT * FROM {$table} ORDER BY id {$order} LIMIT $limit";
		}else{
			$sql = "SELECT * FROM {$table} ORDER BY id {$order}";
		}


		if($this->query($sql)->count()){
			return $this->results();
		}else{
			return false;
		}
	}

	public function find($table, $col, $value){
		if(count($this->query("SELECT * FROM {$table} WHERE $col = '{$value}'")->results()) >= 1){
			return $this->first();	
		}
		else{
			return false;
		}
	}

	public function findAll($table, $col, $value){
		if(count($this->query("SELECT * FROM {$table} WHERE $col = '{$value}'")->results()) >= 1){
			return $this->results();	
		}
		else{
			return false;
		}
	}

	public function insert($table, $fields = []){
		$fieldString = '';
		$valueString = '';
		$values = [];

		foreach($fields as $field => $value){
			$fieldString .= $field . ',';
			$valueString .= '?,';
			$values[] = $value;
		}

		$fieldString = rtrim($fieldString, ',');
		$valueString = rtrim($valueString, ',');

		$sql = "INSERT INTO $table ($fieldString) VALUES($valueString)";

		if(!$this->query($sql, $values)->error()){
			return true;
		}else{
			return false;
		}
	}

	public function update($table, $id, $fields = []){
		$fieldString = '';
		$values = [];

		foreach($fields as $field => $value){
			$fieldString .= ' ' . $field . ' = ?,';
			$values[] = $value;
		}

		$fieldString = trim($fieldString);
		$fieldString = rtrim($fieldString, ',');

		$sql = "UPDATE $table SET $fieldString WHERE id = $id";

		if(!$this->query($sql, $values)->error()){
			return true;
		}else{
			return false;
		}
	}

	public function delete($table, $col, $value){
		$sql = "DELETE from $table WHERE $col = '$value'";
		if(!$this->query($sql)->error()){
			return true;
		}else{
			return false;
		}
	}

	public function column(){
		return $this->_column;
	}
	public function results(){
		return $this->_result;
	}

	public function first(){
		if($this->results()){
			return $this->_result[0];
		}
		return false;
	}

	public function count(){
		return $this->_count;
	}

	public function lastID(){
		return $this->_lastInsertID;
	}

	public function error(){
		return $this->_error;
	}
}