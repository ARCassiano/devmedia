<?php

	//$titulo	= "Aula 13 - Curso de PHP Básico";

	//Se o usuário não estivwe logado, devemos retornar o formulario de login
	//Se o usuário estiver logado retornar tela de boas vindas com o seu nome 	

	//Iniciar o uso de sessões
	session_start();

	if(isset($_SESSION["usuario"])){
		require_once("tmpl_administrativo.php");
	}else{
		require_once("tmpl_formularioLogin.php");
	}
	