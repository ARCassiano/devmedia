<?php
	/*
	*
	* Arquivo de funções para uso geral
	*
	*/

	/* Função para calcular o quadrdo de um numero passado como parametro */
	function quadrado($num, $escreve = false){
		// se o parametro for false, retornamos o valor
		// se for true, escrevemos o valor na tela
		
		$resultado	= $num * $num;
		if($escreve)
			echo $resultado;
		else
			return $resultado;
	}

	function concatenar($var1, $var2){
		return $var1.$var2;
	}