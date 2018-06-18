<?php

	$headers	= "From: PHP Iniciante <anderson.cassiano@hotmail.com>";

	if(mail("anderson.cassiano@hotmail.com", "olá", "teste", $headers)){
		echo "E-mail enviado com sucesso!";
	}else{
		echo "O Envio do e-mail falhou!";
	}
?>