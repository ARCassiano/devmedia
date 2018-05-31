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
			cadastrarDado($conexao);

			break;
		
		case "excluir":
			$retorno	= excluirDado($conexao);
			$dados 		= listarDados($conexao);
			require("viewListar.php");
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

		while ($row = mysqli_fetch_array($resultado)) 
			$data[]	= array("id" => $row["id"], "nome" => $row["nome"], "idade" => $row["idade"]);
		
		return $data;
	}

	function excluirDado($conexao){
		$id	= (isset($_GET["codigo"])) ? $_GET["codigo"] : null;
		$resultado	= excluirUsuario($conexao, $id);

		if($resultado)
			$msg	= "Exclusão efetuada com sucesso!";
		else
			$msg	= "";

		return $msg;
	}

	function cadastrarDado($conexao){
		//Verificar se está sendo realizado um cadastro de usuário
		$nome	= "";
		$idade	= "";

		if(isset($_POST["formUsuario"])){
			//Executar procedimento de cadastro
			$nome	= $_POST["nome"];
			$idade	= $_POST["idade"];

			$resultado	= cadastrarUsuario($conexao, $nome, $idade);

			if($resultado){
				$msg	= "Usuário cadastrado com sucesso!";
				$dados 	= listarDados($conexao);
				require("viewListar.php");
			}else{
				echo "Não foi possível realizar o cadastro";
				$titulo	= "Cadastrar Usuário";
				require("viewCadastro.php");
			}
		}else{
			//Exibir formulario de cadastro
			$titulo	= "Cadastrar Usuário";
			require("viewCadastro.php");
		}
	}