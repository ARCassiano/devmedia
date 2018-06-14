<?php 

$passo	= (isset($_GET["p"])) ? $_GET["p"] : "";
$dir	= "../_up/";

$ext_img	= array("jpg", "gif", "png");
$ext_arq	= array("doc", "docx", "pdf", "zip", "rar");

switch ($passo) {
	default:
		uploadBasico($dir, $ext_img, $ext_arq);
		break;
}

function uploadBasico($dir, $ext_img, $ext_arq){
	$arquivo	= $_FILES["arquivo"];
	$file 		= $dir.$arquivo["name"];

	if(move_uploaded_file($arquivo["tmp_name"], $file)){
		echo "O arquivo foi enviado corretamente!<br>";
		echo "<a href='../_up/".$arquivo["name"]."'>Arquivo</a><br>";
		print_r($_FILES);
	}else{
		echo "O envio do arquivo falhou!";
		print_r($_FILES);
	}
}

?>