<?php
	/*
	*
	* Arquivo de funções para uso geral
	*
	*/

	/* Função para renderizar o template padrão do sistema */
	function show($tpl, $titulo = "Título da Página", $conteudo = "", $template = "default"){
		$tpl->assign("titulo", $titulo);
		$tpl->assign("conteudo", $conteudo);
		$tpl->draw($template);
	}

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