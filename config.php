<?php 

spl_autoload_register(function($class_name){
	$nome = "class".DIRECTORY_SEPARATOR.$class_name.".php";
	if(file_exists(($nome))){
		require_once($nome);
	}
});
 ?>