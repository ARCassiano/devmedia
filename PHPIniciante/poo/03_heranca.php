<?php
	require("classes/db.class.php");
	require("classes/usuario.class.php");

	$usuario 	= new Usuario();

	echo $usuario->getTable() . "<br>";
	echo $usuario->getPai() . "<br>";

	print_r($usuario->exec("SELECT * FROM usuario"));
?>