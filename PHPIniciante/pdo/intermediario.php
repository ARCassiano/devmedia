<?php 

	require("../dbCon.php");

	try{
		$pdo	= new PDO('mysql:host=' . $db_host . ';port=3306;dbname=' . $db_name, $db_user, $db_pass);	

		$usuario 	= "Usuario PDO";
		$idade		= 30;
		$senha		= sha1("123456");

		$objIns	= $pdo->prepare("INSERT INTO usuario(nome, idade, senha) VALUES(?, ?, ?)"); //pode utilizar labels (exe.: :nome, :senha, :idade)
		$objIns->bindParam(1, $usuario); //Pode-se utilizar o label ao invés de indice (ex.: :nome)
		$objIns->bindParam(2, $idade);
		$objIns->bindParam(3, $senha);

		$objIns->execute();
		$objIns	= null;

		$obj	= $pdo->prepare("SELECT id, nome, idade FROM usuario");
		if($obj->execute()){
			if($obj->rowCount() > 0){
				while ($row = $obj->fetch(PDO::FETCH_OBJ)) {
					echo($row->id . " " . $row->nome . " " . $row->idade . "<br>");
				}
			}
		}

		$obj 	= null;
	}catch(PDOException $e){
		echo($e->getMessage());
	}

?>