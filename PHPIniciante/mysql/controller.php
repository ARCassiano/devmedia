<?php

	$titulo	= "Aula 18 - Curso de PHP para iniciantes";

	$conexao	= @mysqli_connect($dbHost . "as", $dbUsername, $dbPassword, $dbName);

	if(mysqli_connect_errno($conexao))
		$resultado	= "A conexão falhou, erro reportado: " . mysqli_connect_error();
	else
		$resultado	= "Conexão realizada com sucesso!";

	@mysqli_close($conexao);