<?php

	function listarUsuario($conexao){
		$sql		= "SELECT id, nome, idade FROM usuario ORDER BY nome";
		$resultado	= mysqli_query($conexao, $sql);

		return $resultado;
	}

	function excluirUsuario($conexao, $id){
		$sql		= sprintf("DELETE FROM usuario WHERE id = %s", $id);
		$resultado	= mysqli_query($conexao, $sql);

		return $resultado;
	}

	function cadastrarUsuario($conexao, $nome, $idade){
		if($nome == "")
			return false;

		if($idade == "")
			$idade	= "NULL";

		$sql		= sprintf("INSERT INTO usuario(nome, idade) VALUES('%s', %s)", $nome, $idade);
		$resultado	= mysqli_query($conexao, $sql) or die(mysqli_error($conexao) . "<br>" . sql);

		return $resultado;
	}