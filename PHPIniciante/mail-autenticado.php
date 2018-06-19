<?php

	$headers	= "";
	$headers	.= "MIME-Version: 1.0 \r\n";
	$headers	.= "Content-type: text/html; charset=\"UTF-8\" \r\n";
	$headers	.= "From: PHP Iniciante <anderson.cassiano@hotmail.com>";

	$mensagem	= "<strong>Olá Anderson Cassiano</strong>";

	include("app/lib/smtp/SMTPConfig.php");
	include("app/lib/smtp/SMTPClass.php");

	/*
	* $smtpSever;
	* $smtPort;
	* $smtpUser;
	* $smtpPas;
	*/
	$SMTPMail	= new SMTPClient($smtpSever, $smtPort, $smtpUser, $smtpPass, $smtpUser, $smtpUser, "E-mail enviado através do site", $mensagem, $headers);


	if($SMTPMail->sendMail()){
		echo("O E-mail foi enviado com sucesso!");
	}else{
		echo("O envio falhou!");
	}
?>