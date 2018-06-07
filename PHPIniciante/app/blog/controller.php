<?php

	$titulo	= "Aula 11 - Curso de PHP Básico";

	$nome	= "Anderson Cassiano";
	$idade	= 22;
	$dtNasc	= "12/04/1996";

	$mensagem	= "";
	if($idade < 20)
		$mensagem	= "Jovem";
	else
		$mensagem	= "Você esta ficando idosos!";


	//Calculado o quadrado de um numero
	$retorno	= "O quadrado de 4 é: " . quadrado(4);
	//quadrado(2, true);// desta forma iria imprimir diretamente na tela

	$concatenei	= concatenar("Anderson", "Cassiano"); //Ao utilizar um @ na chamada do metodo, o erro da função não será exibida