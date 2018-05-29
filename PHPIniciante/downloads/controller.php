<?php

	$titulo	= "Aula 17 - Curso d PHP Básico";

	$array	= array("12345" => "aoe.png");

	$idarquivo	= $_GET["id"];

	header("Content-type: application/png");
	header("content-disposition:attachment,filename='imagem17.png'");

	readfile("../arquivos/aoe.png");