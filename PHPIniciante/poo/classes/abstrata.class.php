<?php

/**
 * Exemplo de classe abstrata
 */
abstract class Abstrata
{
	
	function __construct()
	{
		
	}

	abstract function digaOla();

	function escreve($txt){
		echo $txt . "<b>";
	}
}

/**
 * Exemplificar uso da abstrata
 */
class Especifica extends Abstrata
{
	function digaOla(){
		echo "Olá!<br>";
	}
	
}


/**
 * Exemplificar uso da abstrata
 */
class MuitoEspecifica extends Abstrata
{
	function digaOla(){
		echo "Olá muito especifico!<br>";
	}
	
}

?>