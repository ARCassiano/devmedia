<?php 
 
    $pdo = new PDO('mysql:host=localhost:8080;dbname=devmedia', 'root', '1234');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");
 
    try {
        $pdoStatement = $pdo->query("SELECT id, nome, preco FROM produto LIMIT 5");
 
        while($row = $pdoStatement->fetch(PDO::FETCH_ASSOC)){
 
            echo "<p>{$row['id']} {$row['nome']} {$row['preco']}</p>";
        }
 
    } catch(Exception $e) {
        echo "Erro: {$e->getMessage()}";
    }