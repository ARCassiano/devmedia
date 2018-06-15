<?php
session_start();
$passo	= (isset($_GET["p"])) ? $_GET["p"] : "";

switch ($passo) {
	case "spoofing":
		spoofing();
		break;
	default:
		echo "Parâmetro inválido!";
		break;
}

function spoofing(){
	include_once '../lib/securimage/securimage/securimage.php';
	$securimage = new Securimage();

	if ($securimage->check($_POST['captcha_code']) == false) {
	  //Captcha incorreto
	  echo "O código digitado é inválido!.<br /><br />";
	  exit;
	}

	echo "O código digitado é válido!.<br /><br />";
}
?>