<?php

	function listarUsuario($conexao){
		$sql		= "SELECT id, nome, idade FROM usuario ORDER BY nome";
		$resultado	= mysqli_query($conexao, $sql);

		return $resultado;
	}