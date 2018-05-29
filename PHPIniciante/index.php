<?php 

	//Verirficar se o IP está em nossa blocklist
	$ipsbloqueados	= array();

	foreach ($ipsbloqueados as $ip) {
		if($ip == $_SERVER["REMOTE_ADDR"]){
			header("Location: ./negado.php");
			exit();
		}
	}

	//Previnir o cache nas páginas
	header("Expires: Mon, 21 Out 1999 00:00:00 GMT");
	header("Cache-control: no-cache");
	header("Pragma: no-cache");

	$r = $_GET["r"];

	require_once("funcoes.php");
	require_once($r . "/index.php");