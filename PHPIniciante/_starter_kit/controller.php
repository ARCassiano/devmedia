<?php
	//Realizar conexão com o banco de dados
	$conexao	= @mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

	if(mysqli_connect_errno($conexao)){
		echo "A conexão falhou, erro reportado: " . mysqli_connect_error();
		exit();
	}

	//require("modelUsuario.php");

	//Definir qual view deve ser carregada
	//p == "cadastrar" || p == "listar" || p == "excluir"
	$p 	= (isset($_GET["p"])) ? $_GET["p"] : null;

	$tpl 		= new raintpl();

	switch ($p) {
		default:
			inicial($conexao, $tpl);
			break;
	}

	//Encerrar conexão com o banco de dados
	@mysqli_close($conexao);

	function inicial($conexao, $tpl){
		$titulo		= "Aplicação utilizando JSON";
		$template	= "default";
		$conteudo	= "";

		$tpl->assign("dados", "");
		
		show($tpl, $titulo, $conteudo, $template);
	}