<?php
//Dados para conexão com o banco de dados
//host, username, password, dbName
$db_host		= "mysql.hostinger.com.br";
$db_user	= "u432556926_exe01";
$db_pass	= "u432556926";
$db_name 	= "u432556926_exe01";

$conexao	= @mysqli_connect($db_host, $db_user, $db_pass, $db_name);

try{
	$pdo	= new PDO('mysql:host=' . $db_host . ';port=3306;dbname=' . $db_name, $db_user, $db_pass);	
}catch(PDOException $e){
	echo($e->getMessage());
}
