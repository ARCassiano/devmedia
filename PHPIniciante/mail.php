<?php

	$headers	= "From: PHP Iniciante <atendimento@gmail.com.br>";

	if(mail("anderson.cassiano@hotmail.com", "olá", "teste", $headers)){
		echo "E-mail enviado com sucesso!";
	}else{
		echo "O Envio do e-mail falhou!";
	}
?>