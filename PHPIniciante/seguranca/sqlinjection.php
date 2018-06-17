<?php

	include("../dbCon.php");
	include("../app/lib/funcoes.php");

	$usuario	= $_GET["usuario"];
	//$senha		= tratarStr($_GET["senha"]);
	$senha		= $_GET["senha"];

	$sql		= "SELECT * FROM usuario WHERE nome = '" . $usuario . "' AND senha = '" . $senha . "'";
	$ret 		= mysqli_query($conexao, $sql);
	
	if(mysqli_num_rows(mysqli_query($conexao, $sql)) > 0){
		echo "Acesso ao sistema liberado!";
	}else{
		echo "Acesso ao sistema negado!";
	}


?>