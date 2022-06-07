<?php

class Usuario {

    private $iduser;
    private $deslogin;
    private $despassword;
    private $dtregister;

    public function getiduser(){

        return $this->iduser;

    }

    public function setiduser($value){

        $this->iduser = $value;

    }

    public function getdeslogin(){

        return $this->deslogin;

    }

    public function setdeslogin($value){

        $this->deslogin = $value;

    }

    public function getdespassword(){

        return $this->despassword;

    }

    public function setdespassword($value){

        $this->despassword = $value;

    }

    public function getdtregister(){

        return $this->dtregister;

    }

    public function setdtregister($value){

        $this->dtregister = $value;

    }

    public function loadById($id){

        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_users WHERE iduser = :ID", array(

            ":ID"=>$id

        ));

        if (count($results) > 0) {

            $row = $results[0];

           /* $this->setiduser($row['iduser']);
            $this->setdeslogin($row['deslogin']);
            $this->setdespassword($row['despassword']);
            $this->setdtregister(new DateTime($row['dtregister']));*/
			
				setData($row);

        }

    }

    public static function getList(){

        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_users ORDER BY deslogin;");

    }

    public static function search($login){

        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_users WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(

            ':SEARCH'=>"%".$login."%"

        ));

    }

    public function login($login, $password){

        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_users WHERE deslogin = :LOGIN AND despassword = :PASSWORD", array(

            ":LOGIN"=>$login,
            ":PASSWORD"=>$password,

        ));

        if (count($results) > 0) {

            $row = $results[0];

			/*
            $this->setiduser($row['iduser']);
            $this->setdeslogin($row['deslogin']);
            $this->setdespassword($row['despassword']);
            $this->setdtregister(new DateTime($row['dtregister']));*/
			
			setData($row);


        } else {

            throw new Exception("Login e/ou senha inválidos.");

        }

    }
	
	
	
    public function setData($data){

        $this->setiduser($data['iduser']);
        $this->setdeslogin($data['deslogin']);
        $this->setdespassword($data['despassword']);
        $this->setdtregister(new DateTime($data['dtregister']));

    }

   

    public function __toString(){

        return json_encode(array(

            "iduser"=>$this->getiduser(),
            "deslogin"=>$this->getdeslogin(),
            "despassword"=>$this->getdespassword(),
            "dtregister"=>$this->getdtregister()->format("d/m/Y H:i:s")

        ));

    }

}

?>