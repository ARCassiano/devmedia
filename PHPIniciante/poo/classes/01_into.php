<?php

	/**
	 * Introdução a POO
	 */
	class Usuario
	{
		var $nome	= "";
		var $idade	= "";

		function __construct(argument)
		{
			# code...
		}

		function setNome($nome){
			this->nome = $nome;
		}
		
		function setIdade($idade){
			this->idade = $idade;
		}
		
		function getNome(){
			return this->nome;
		}

		function getIdade(){
			return this->idade;
		}
	}

	$usuario 	= new Usuario();

	echo "O nome atual do usuário é: " . $usuario->getNome($usuario->setNome("Anderson Cassiano"));

?>