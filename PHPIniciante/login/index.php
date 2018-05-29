<?php

	//log.txt
	//Verificar se o aqruivo log.txt já existe, caso não exista, devemos cria-lo
	//file_exists("log.txt");
	
	//definir constante armazenando o arquivo de log
	define("ARQUIVO_LOG","log.txt");
	
	$log	= fopen(ARQUIVO_LOG, "x");

	//Arquivo de log já existe
	if(!$log)
		$log 	= fopen(ARQUIVO_LOG, "a"); //Abre o arquivo e posiciona o ponteiro no final do arquivo

	require_once("controller.php");
	//require_once("view.php");