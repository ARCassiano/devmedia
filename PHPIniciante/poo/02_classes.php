<?php
	require("classes/db.class.php");

	$conexao	= new Database();

	$expression 	= $conexao->exec("SELECT * FROM usuario");
	print_r($expression);
?>