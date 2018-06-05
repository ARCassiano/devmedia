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
		case 'jsonDecodeIntermediario':
			jsonDecodeIntermediario($conexao, $tpl);
			break;
		case 'jsonEncode':
			jsonEncode($conexao, $tpl);
			break;
		default:
			jsonDecodeBasico($conexao, $tpl);
			break;
	}

	//Encerrar conexão com o banco de dados
	@mysqli_close($conexao);

	function jsonDecodeBasico($conexao, $tpl){
		$json 		= '{"nomeCampo": "valor", "nomeCampo2": "valor"';
		$obj		= json_decode($json);

		switch (json_last_error()) {
			//JSON_ERROR_DEPTH || JSON_ERROR_NONE || JSON_ERRO_STATE_MISMATCH
			case JSON_ERROR_STATE_MISMATCH:
				echo "JSON inválido ou mal formado";
				break;
			case JSON_ERROR_SYNTAX:
				echo "Problema com o JSON";
				break;
			case JSON_ERROR_NONE:
				echo $obj->nomeCampo;
				break;
			default:
				echo "Erro de JSON desconhecido";
				break;
		}
			
	}

	function jsonEncode($conexao, $tpl){
		$usuarios	= array('Nome' => 'Anderson Cassiano',  'idade' => 22, 'dataNascimento' => '12/04/1996');

		$json 	= json_encode($usuarios);
		echo $json;
	}

	function jsonDecodeIntermediario($conexao, $tpl){
		$json 		=	'{
							"usuarios":	[
								{
									"nome": "Anderson Cassiano",
									"idade": 22,
									"dataNascimento": "12/04/1996"
								},
								{
									"nome": "Anderson Cassiano",
									"idade": 22,
									"dataNascimento": "12/04/1996"
								},
								{
									"nome": "Anderson Cassiano",
									"idade": 22,
									"dataNascimento": "12/04/1996"
								},
								{
									"nome": "Anderson Cassiano",
									"idade": 22,
									"dataNascimento": "12/04/1996"
								}
							]
						}';

		$obj		= json_decode($json);

		foreach ($obj->usuarios as $usuario) {
			echo "<p>Nome: " . $usuario->nome . " | Idade: " . $usuario->idade . " | dataNascimento: " . $usuario->dataNascimento . "</p>";
		}
	}

	function inicial($conexao, $tpl){
		$titulo		= "Aplicação utilizando JSON";
		$template	= "default";
		$conteudo	= "";

		show($tpl, $titulo, $json, $template);
	}