<?php


class Sql extends PDO{
	
	
	
	private $conn;
	
	public function  __construct(){
		
		$this->conn=new PDO("mysql:dbname=lojaracao;host=127.0.0.1","root","" );
		
		
	}
	
	
	
	private function setParams($statement, $parameters = array())
	{

		foreach ($parameters as $key => $value) {
			
			$this->bindParam($statement, $key, $value);

		}

	}

	private function bindParam($statement, $key, $value)
	{

		$statement->bindParam($key, $value);

	}

	private function query($rawQuery, $params = array())
	{

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();
		
		return $stmt;

	}

	private function select($rawQuery, $params = array()):array
	{

		$stmt = $this->conn->prepare($rawQuery);

		 $stmt=$this->query($rawQuery, $params = array())

	

		return $stmt->fetchAll(PDO::FETCH_ASSOC);

	}
	
	
	
	
}








?>