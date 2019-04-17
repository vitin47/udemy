<?php 

require_once("config.php");

//$user = new Usuario();
//$user -> loadById(10);
//$user = Usuario::getList();
$procura = Usuario::login("pedro","123");


echo json_encode($procura);

 ?>