<?php


class Sql extends PDO{
	
	
	
	private $conn;
	
	public function  __construct(){
		
		$this->conn=new PDO("mysql:dbname=loja_racao;host=127.0.0.1","root","" );
		
		
	}
	
	
	
	public function setParams($statement, $parameters = array())
	{

		foreach ($parameters as $key => $value) {
			
			$this->bindParam($statement, $key, $value);

		}

	}

	public function bindParam($statement, $key, $value)
	{

		$statement->bindParam($key, $value);

	}

	public function query($rawQuery, $params = array())
	{

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();
		
		return $stmt;

	}

	public function select($rawQuery, $params = array()):array
	{


		 $stmt=$this->query($rawQuery, $params = array());

	

		return $stmt->fetchAll(PDO::FETCH_ASSOC);

	}
	
	
	
	
}








?>