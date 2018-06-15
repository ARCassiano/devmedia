<?php

	function listarUsuario($conexao){
		$sql		= "SELECT id, nome, idade FROM usuario ORDER BY nome";
		$resultado	= mysqli_query($conexao, $sql);

		return $resultado;
	}

	function listarUsuarioPorId($conexao, $id){
		$sql		= sprintf("SELECT id, nome, idade FROM usuario WHERE id = %s", $id);
		$resultado	= mysqli_query($conexao, $sql);

		return $resultado;
	}

	function excluirUsuario($conexao, $id){
		$sql		= sprintf("DELETE FROM usuario WHERE id = %s", $id);
		$resultado	= mysqli_query($conexao, $sql);

		return $resultado;
	}

	function cadastrarUsuario($conexao, $nome, $idade, $foto = "", $senha = ""){
		if($nome == "")
			return false;

		if($idade == "")
			$idade	= "NULL";

		//$senha	= md5($senha);
		//$senha	= sha1($senha);
		//$senha	= base64_encode($senha); base64_decode()
		if($senha != "")
			$senha	= sha1($senha);

		$sql		= sprintf("INSERT INTO usuario(nome, idade, foto, senha) VALUES('%s', %s, '%s', '%s')", $nome, $idade, $foto, $senha);
		$resultado	= mysqli_query($conexao, $sql) or die(mysqli_error($conexao) . "<br>" . sql);

		return $resultado;
	}

	function alterarUsuario($conexao, $nome, $idade, $id){
		if($nome == "")
			return false;

		if($idade == "")
			$idade	= "NULL";

		$sql		= sprintf("UPDATE usuario SET nome = '%s', idade = %s WHERE id = %s", $nome, $idade, $id);
		$resultado	= mysqli_query($conexao, $sql) or die(mysqli_error($conexao) . "<br>" . sql);

		return $resultado;
	}