<?php 
	/*
	*	Arquivo principal da aplicação
	*/


	/*
	*	Verirficar se o IP está em nossa blocklist
	*/
	$ipsbloqueados	= array();

	foreach ($ipsbloqueados as $ip) {
		if($ip == $_SERVER["REMOTE_ADDR"]){
			header("Location: ./negado.php");
			exit();
		}
	}

	/*
	*	Arquivos essenciais
	*/
	require_once("libs/funcoes.php");

	/*
	*	Previnir o cache nas páginas
	*/
	header("Expires: Mon, 21 Out 1999 00:00:00 GMT");
	header("Cache-control: no-cache");
	header("Pragma: no-cache");


	/*
	*	Controle de acesso ao módulo ($modulo)
	*/
	$modulo = (isset($_GET["m"])) ? $_GET["m"] : "inicial";

	/*
	*	Controle do Front-end
	*		- Páginal Inicial
	*		- Post
	*		- Contato
	*/
	switch ($modulo) {
		case 'value':
			# code...
			break;
		
		default:
			# Controle do modulo inicial
			break;
	}