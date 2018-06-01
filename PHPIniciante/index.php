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

	//Dados para conexão com o banco de dados
	//host, username, password, dbName
	$dbHost		= "mysql.hostinger.com.br";
	$dbUsername	= "u432556926_exe01";
	$dbPassword	= "u432556926";
	$dbName 	= "u432556926_exe01";

	$r = (isset($_GET["r"])) : $_GET["r"] ? "";

	//rainTPL
	include("lib/template/rainTPL/rain.tpl.class.php");
	raintpl::$tpl_dir	= $r . "tpl/";
	raintpl::$cache_dir	= $r . "tmp/";

	require_once("funcoes.php");
	require_once($r . "/index.php");