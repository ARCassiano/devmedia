<?php

	$titulo	= "Aula 13 - Curso de PHP Básico";

	//Se o usuário não estivwe logado, devemos retornar o formulario de login
	//Se o usuário estiver logado retornar tela de boas vindas com o seu nome 	

	//Iniciar o uso de sessões
	session_start();

	if(isset($_GET["ac"]) && $_GET["ac"] == "logout")
		session_destroy(); //Poderia ser utilziado o unset($_SESSION["usuario"]), mas teria quer verificar antes se a sessão existe (isset($_SESSION["usuario"]))

	if(isset($_POST["usuario"]) && isset($_POST["senha"]) && $_POST["senha"] == "admin" && $_POST["usuario"] == "admin")
		$_SESSION["usuario"]	= $_POST["usuario"];

	if(isset($_SESSION["usuario"])){
		require_once("tmpl_administrativo.php");
	}else{
		require_once("tmpl_formularioLogin.php");
	}
	