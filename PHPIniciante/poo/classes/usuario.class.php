<?php 

/**
 * Classe responsável por gerencia usuários
 */
class Usuario extends Database
{
	const table	= "usuario";
	function __construct()
	{
		parent::__construct();
	}

	function getTable(){
		//return $this->table; table não é uma variavel
		return self::table;
	}

	function getPai(){
		return parent::pai;
	}
}
?>