<?php 

$passo	= (isset($_GET["p"])) ? $_GET["p"] : "";
$dir	= "../_up/";

$ext_img	= array("jpg", "gif", "png");
$ext_arq	= array("doc", "docx", "pdf", "zip", "rar");

switch ($passo) {
	case "cadUsuario":
		cadUsuario($dir, $ext_img, $ext_arq);
		break;
	default:
		uploadBasico($dir, $ext_img, $ext_arq);
		break;
}

function uploadBasico($dir, $ext_img, $ext_arq){
	$arquivo	= $_FILES["arquivo"];
	$file 		= $dir.$arquivo["name"];

	//Funcao end retorna a ultima posição do vetor
	$exte		= explode(".", $arquivo["name"]);
	$ext 		= strtolower(end($exte));

	//A função array_search realiza a busca de um valor dentro do vetor 
	if(!array_search($ext, $ext_img)){
		if(!array_search($ext, $ext_arq)){
			echo "O tipo do arquivo é inválido!<br>";
			return false;
		}
	}


	if(!file_exists($dir))
		mkdir("../_up/");

	if(move_uploaded_file($arquivo["tmp_name"], $file)){
		echo "O arquivo foi enviado corretamente!<br>";
		echo "<a href='../_up/".$arquivo["name"]."'>Arquivo</a><br>";
		print_r($_FILES);
	}else{
		echo "O envio do arquivo falhou!";
		print_r($_FILES);
	}
}

function cadUsuario($dir, $ext_img, $ext_arq){
	require("../app/usuario/modelUsuario.php");
	require("../dbCon.php");
	
	$usuario = $_POST['txtNomeUsuario'];
	$idade = (int) $_POST['txtIdadeUsuario'];
	$foto = "";
	
	$arquivo = $_FILES['arquivo'];
	$file = $dir.$arquivo['name'];
	

	$exte		= explode(".", $arquivo["name"]);
	$ext 		= strtolower(end($exte));
	
	if(array_search($ext,$ext_img)) {
		if(move_uploaded_file($arquivo['tmp_name'], $file)){
			$foto = $arquivo['name'];

			include("../app/lib/wideimage/lib/WideImage.php");
			WideImage::load($file)->resize(200, 150)->saveToFile($dir."thumbnail/".$foto);
		}
	} 
	
	$resultado = cadastrarUsuario( $conexao, $usuario, $idade, $foto );
	
	if($resultado){
		echo "Cadastro efetuado com sucesso!<br/>";
		
		echo "Nome: ".$_POST['txtNomeUsuario']."<br/>";
		echo "Idade: ".$_POST['txtIdadeUsuario']."<br/>";
		
		if($foto != "")
			echo "Foto: <img width='150' src='../_up/".$foto."' />";
		
	} else {
		echo "O cadastro falhou!";
	}
}

?>