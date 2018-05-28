<?php

	$titulo	= "Aula 13 - Curso de PHP Básico";

	//Se o usuário não estivwe logado, devemos retornar o formulario de login
	//Se o usuário estiver logado retornar tela de boas vindas com o seu nome 	

	//Iniciar o uso de sessões
	session_start();

	if(isset($_GET["ac"]) && $_GET["ac"] == "logout" && isset($_SESSION["usuario"])){
		setcookie("usuarioLogado", "", time() - 3600);
		unset($_SESSION["usuario"]);//session_destroy(); 
		unset($_COOKIE["usuarioLogado"]);
	}

	if(isset($_POST["usuario"]) && isset($_POST["senha"]) && $_POST["senha"] == "admin" && $_POST["usuario"] == "admin"){
		//Caso o usuário tenha marcado que deseja lembrar o login, deveremos mante-lo logado por mais 2min.
		if(isset($_POST["lembra"]) && $_POST["lembra"] == "1")
			setcookie("usuarioLogado", $_POST["usuario"], time() + 60*2);

		$_SESSION["usuario"]	= $_POST["usuario"];
	}

	if(isset($_SESSION["usuario"]) || isset($_COOKIE["usuarioLogado"])){

		require_once("tmpl_administrativo.php");
	}else{
		require_once("tmpl_formularioLogin.php");
	}
	