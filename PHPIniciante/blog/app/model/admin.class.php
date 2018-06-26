<?php 

/**
 *	Classe responsável pelo gerenciamento do modulo administrativo
 */
class Admin
{
	
	# Função responsável pelo login do usuário
	public function getUsuarioLoginSenha($pdo, $usuario, $senha){
		$obj	= $pdo->prepare("SELECT 
									usuarioid,
									usuariouser,
									usuarionome
								FROM blog_usuario
								WHERE 
									usuariouser = :usuario AND
									usuariopass	= :senha");

		$obj->bindParam(":usuario", $usuario);
		$obj->bindParam(":senha", $senha);

		return ($obj->execute()) ? $obj->fetch(PDO::FETCH_OBJ) : false;
	}
}
?>