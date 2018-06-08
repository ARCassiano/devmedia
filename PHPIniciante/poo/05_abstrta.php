<?php
	require("classes/abstrata.class.php");

	$esp 	= new Especifica();
	$mesp 	= new MuitoEspecifica();

	$esp->escreve("Escreve");
	$esp->digaOla();
	$mesp->digaOla();
?>