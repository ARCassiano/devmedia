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

	public function getTodosUsuarios($pdo){
		$obj = $pdo->prepare("SELECT 
								usuarioid,
								usuariouser, 
								usuarionome
							FROM 
								blog_usuario 
							ORDER BY
								usuariouser ASC
							");
		
		return ($obj->execute()) ? $obj->fetchAll(PDO::FETCH_ASSOC) : false;
	}
	
	public function getUsuarioId($pdo, $usuarioid){
		$obj = $pdo->prepare("SELECT 
								usuarioid,
								usuariouser, 
								usuariopass,
								usuarionome
							FROM 
								blog_usuario 
							WHERE
								usuarioid = :usuarioid
							");
							
		$obj->bindParam(":usuarioid",$usuarioid);
		return ($obj->execute()) ? $obj->fetch(PDO::FETCH_ASSOC) : false;
	}
	
	public function alteraDadosUsuario($pdo, $usuarioid, $nome, $senha=null){
		if($senha==null) {
			$sql = "UPDATE 
						blog_usuario
					SET 
						usuarionome=? 
					WHERE 
						usuarioid=?";
			$obj = $pdo->prepare($sql);
			$obj->execute(array($nome,$usuarioid));
		} else {
			$sql = "UPDATE 
						blog_usuario
					SET 
						usuarionome=?,
						usuariopass=?
					WHERE 
						usuarioid=?";
			$obj = $pdo->prepare($sql);
			$obj->execute(array($nome,md5($senha),$usuarioid));
		}
		
		return ($obj) ? $obj : false;
		
	}
	
	public function cadastrarUsuario($pdo, $usuario, $nome, $senha){
		$ins = $pdo->prepare("INSERT INTO blog_usuario(usuariouser, usuarionome, usuariopass) VALUES(:usuario,:nome,:senha)");
		$ins->bindParam(":usuario",$usuario);
		$ins->bindParam(":nome",$nome);
		$ins->bindParam(":senha",md5($senha));
		
		$obj = $ins->execute();
		
		return ($obj) ? $obj : false;
	}
	
	public function excluirUsuario($pdo, $usuarioid){
		$ins = $pdo->prepare("DELETE FROM 
								blog_usuario
							 WHERE
								usuarioid=:usuarioid");
		$ins->bindParam(":usuarioid",$usuarioid);
		
		$obj = $ins->execute();
		
		return ($obj) ? $obj : false;
	}

	
	// módulos de categoria
	
	public function getTodasCategorias($pdo){
		$obj = $pdo->prepare("SELECT 
								bc.categoriaid,
								bc.categoriatitulo,
								(
								 SELECT count(bp.postid) 
								 FROM
									blog_post bp
								 WHERE
									bp.blog_categoria_categoriaid = bc.categoriaid
								) as numeroposts
							FROM 
								blog_categoria bc
							ORDER BY
								bc.categoriatitulo ASC
							");
		
		return ($obj->execute()) ? $obj->fetchAll(PDO::FETCH_ASSOC) : false;
	}
	
	public function getCategoriaId($pdo, $categoriaid){
		$obj = $pdo->prepare("SELECT 
								categoriaid,
								categoriatitulo
							FROM 
								blog_categoria 
							WHERE
								categoriaid = :categoriaid
							");
							
		$obj->bindParam(":categoriaid",$categoriaid);
		return ($obj->execute()) ? $obj->fetch(PDO::FETCH_ASSOC) : false;
	}
	
	public function alteraDadosCategoria($pdo, $categoriaid, $categoriatitulo){
		$sql = "UPDATE 
					blog_categoria
				SET 
					categoriatitulo=? 
				WHERE 
					categoriaid=?";
		$obj = $pdo->prepare($sql);
		$obj->execute(array($categoriatitulo,$categoriaid));
		
		return ($obj) ? $obj : false;
		
	}
	
	public function cadastrarCategoria($pdo, $categoriatitulo){
		$ins = $pdo->prepare("INSERT INTO blog_categoria(categoriatitulo) VALUES(:categoriatitulo)");
		$ins->bindParam(":categoriatitulo",$categoriatitulo);
		
		$obj = $ins->execute();
		
		return ($obj) ? $obj : false;
	}
	
	public function excluirCategoria($pdo, $categoriaid){
		$ins = $pdo->prepare("DELETE FROM 
								blog_categoria
							 WHERE
								categoriaid=:categoriaid");
		$ins->bindParam(":categoriaid",$categoriaid);
		
		$obj = $ins->execute();
		
		return ($obj) ? $obj : false;
	}

}
?>