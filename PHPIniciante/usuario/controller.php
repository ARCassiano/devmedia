<?php

	$titulo	= "Gerenciamento de Usuários";

	//Realizar conexão com o banco de dados
	$conexao	= @mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

	if(mysqli_connect_errno($conexao)){
		echo "A conexão falhou, erro reportado: " . mysqli_connect_error();
		exit();
	}

	require("modelUsuario.php");

	//Definir qual view deve ser carregada
	//p == "cadastrar" || p == "listar" || p == "excluir"
	if(isset($_GET["p"]))
		$p 	= $_GET["p"];
	else
		$p 	= "";

	switch ($p) {
		case "cadastrar":
			# code...
			break;
		
		case "excluir":
			# code...
			break;
		
		default:
			$dados 	= listarDados($conexao);
			require("viewListar.php");
			break;
	}

	//Encerrar conexão com o banco de dados
	@mysqli_close($conexao);

	function listarDados($conexao){
		$data	= array();
		$resultado	= listarUsuario($conexao);

		while ($row = $resultado->fetch_row()) 
			$data[]	= array("id" => $row["id"], "nome" => $row["nome"], "idade" => $row["idade"]);
		
		return $data;
	}