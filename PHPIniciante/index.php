<?php 

	//Verirficar se o IP está em nossa blocklist
	$ipsbloqueados	= array();

	foreach ($ipsbloqueados as $ip) {
		if($ip == $_SERVER["REMOTE_ADDR"]){
			header("Location: ./negado.php");
			exit();
		}
	}

	$r = $_GET["r"];

	require_once("funcoes.php");
	require_once($r . "/index.php");