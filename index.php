<?php

require_once("config.php");

$sql = new Sql();

$categories = $sql->select("SELECT * FROM tb_categories");

echo json_encode($categories);

?>