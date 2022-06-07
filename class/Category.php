<?php

class Category {

    private $idcategory;
    private $descategory;
	   private $dtregister;
    
    public function getidcategory(){

        return $this->idcategory;

    }

    public function setidcategory($value){

        $this->idcategory = $value;

    }

    public function getdescategory(){

        return $this->descategory;

    }

    public function setdescategory($value){

        $this->descategory = $value;

    }

    
    public function getdtregister(){

        return $this->dtregister;

    }

    public function setdtregister($value){

        $this->dtregister = $value;

    }

    public function loadById($id){

        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_categories WHERE idcategory = :ID", array(

            ":ID"=>$id

        ));
		

        if (count($results) > 0) {

            $row = $results[0];

          /*  $this->setidcategory($row['idcategory']);
            $this->setdescategory($row['descategory']);
            $this->setdtregister(new DateTime($row['dtregister']));*/
			
			 $this->setData($row);

        }

    }
	
	
	public static function getList(){

        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_categories ORDER BY descategory;");

    }

	
	 public static function search($descategory){

        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_categories WHERE descategory LIKE :SEARCH ORDER BY descategory", array(

            ':SEARCH'=>"%".$descategory."%"

        ));

    }
	
	
	
    public function setData($data){

        $this->setidcategory($data['idcategory']);
        $this->setdescategory($data['descategory']);
        $this->setdtregister(new DateTime($data['dtregister']));

    }

    public function insert(){

        $sql = new Sql();

        $results = $sql->select("CALL sp_categories_save(:idcategory,:descategory)", array(
			':idcategory'=>$this->getidcategory(),	
            ':descategory'=>$this->getdescategory()

        ));

        if (count($results) > 0) {

            $this->setData($results[0]);

        }

    }
	
	
	 public function update(){
		 
		 
		 $this->setidcategory(20);
        $this->setdescategory('alterado categoria');

        $sql = new Sql();

        $results = $sql->select("CALL sp_categories_save(:idcategory,:descategory)", array(
			':idcategory'=>$this->getidcategory(),	
            ':descategory'=>$this->getdescategory()

        ));

        if (count($results) > 0) {

            $this->setData($results[0]);

        }

    }
	
	public function delete(){
		
		 $sql = new Sql();

        $results = $sql->query("delete from tb_categories where idcategory= :idcategory ", array(
			':idcategory'=>$this->getidcategory()

        ));
		
		echo "categoria de id ".$this->getidcategory()." deletada";
		
	}

    public function __construct($descategory = ""){

        $this->setdescategory($descategory);

    }


	
	

    public function __toString(){

        return json_encode(array(

            "idcategory"=>$this->getidcategory(),
            "descategory"=>$this->getdescategory(),
            "dtregister"=>$this->getdtregister()

        ));

    }

}

?>