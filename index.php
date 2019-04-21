<?php 

require_once("config.php");

//$user = new Usuario();
//$user -> loadById(10);
//$user = Usuario::getList();
//$aluno = new Usuario("teste2","321");
//$aluno->insert();
//echo $aluno;

$user = new Usuario();
$user->loadById(18);

$user->delete();
echo $user;

 ?>