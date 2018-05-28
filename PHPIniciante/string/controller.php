<?php

	$titulo	= "Aula 12 - Curso de PHP Básico";

	$array	= array();

	$var1 	= "ESTA é alguma frase";
	$var2 	= "Esta é outra frase";
	$var3 	= "ABCDEfghi";

	//Tranformando a string em minúsculo 
	$array[]	= "VAR1 em minúsculo: " . strtolower($var1);
	
	//Tranformando as strings em maiúsculo 
	$array[]	= "VAR2 em maiúsculo: " . strtoupper($var2);
	
	//exibindo a posição de uma caracter de ums string
	$array[]	= "Posição do caracter  'é' na variavel VAR2: " . stripos("é", $var2);

	//utilizando str_split
	$str_split	= str_split($var3);

	//utilizando expldoe
	$explode	= explode($var2, " ");

	//utilizando impldoe
	$implode 	= implode($explode, "_");

	//utilizando str_replace
	$array[] 	= str_replace("Esta", "Aquela", $var2);
