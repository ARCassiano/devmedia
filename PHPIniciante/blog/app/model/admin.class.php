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

	
	// módulos de imagens
	
	public function getTodasImagens($pdo,$postid){
		$obj = $pdo->prepare("SELECT 
								bi.imagemid,
								bi.imagemlegenda,
								bi.imagemarquivo,
								bi.imagemdestaque
							FROM 
								blog_imagem bi
							WHERE
								bi.blog_post_postid = :postid
							");
		$obj->bindParam(":postid",$postid);
		return ($obj->execute()) ? $obj->fetchAll(PDO::FETCH_ASSOC) : false;
	}
	
	public function getImagemId($pdo, $imagemid){
		$obj = $pdo->prepare("SELECT 
								bi.imagemid,
								bi.imagemlegenda,
								bi.imagemarquivo,
								bi.imagemdestaque,
								bi.blog_post_postid as postid
							FROM 
								blog_imagem bi
							WHERE
								bi.imagemid = :imagemid
							");
							
		$obj->bindParam(":imagemid",$imagemid);
		return ($obj->execute()) ? $obj->fetch(PDO::FETCH_ASSOC) : false;
	}
	
	public function alteraDadosImagem($pdo, $imagemid, $imagemlegenda, $imagemdestaque){
		$sql = "UPDATE 
					blog_imagem
				SET 
					imagemlegenda=?,
					imagemdestaque=?
				WHERE 
					imagemid=?";
		$obj = $pdo->prepare($sql);
		$obj->execute(array($imagemlegenda,$imagemdestaque,$imagemid));
		
		return ($obj) ? $obj : false;
	}
	
	public function cadastrarImagem($pdo, $postid, $imagemarquivo, $imagemlegenda, $imagemdestaque){
		$ins = $pdo->prepare("INSERT INTO 
								blog_imagem
								(
									imagemarquivo, 
									imagemlegenda, 
									imagemdestaque, 
									blog_post_postid
								) VALUES(
									:imagemarquivo, 
									:imagemlegenda, 
									:imagemdestaque, 
									:postid
								)");
		$ins->bindParam(":imagemarquivo",$imagemarquivo);
		$ins->bindParam(":imagemlegenda",$imagemlegenda);
		$ins->bindParam(":imagemdestaque",$imagemdestaque);
		$ins->bindParam(":postid",$postid);
		
		$obj = $ins->execute();
		
		return ($obj) ? $obj : false;
	}
	
	public function excluirImagem($pdo, $imagemid){
		$ins = $pdo->prepare("DELETE FROM 
								blog_imagem
							 WHERE
								imagemid=:imagemid");
		$ins->bindParam(":imagemid",$imagemid);
		
		$obj = $ins->execute();
		
		return ($obj) ? $obj : false;
	}

	// módulos posts	
	public function getPostId($pdo, $postid){
		$obj = $pdo->prepare("SELECT 
								bp.postid,
								bp.posttitulo,
								bp.posttexto,
								bp.postbloqueado,
								bp
							FROM 
								blog_post bp,
								blog_usuario bu,
								blog_categoria bc
							WHERE
								bi.imagemid = :imagemid
							");
							
		$obj->bindParam(":imagemid",$imagemid);
		return ($obj->execute()) ? $obj->fetch(PDO::FETCH_ASSOC) : false;
	}
	
	public function alteraDadosPost($pdo, $postid, $posttitulo, $posttexto, $postbloqueado, $postcategoria, $posturlamigavel, $postdata){
		$sql = "UPDATE 
					blog_post
				SET 
					posttitulo=?,
					posttexto=?,
					postbloqueado=?,
					blog_categoria_categoriaid=?,
					posturlamigavel=?,
					postdata=?
				WHERE 
					postid=?";
		$obj = $pdo->prepare($sql);
		$obj->execute(array($posttitulo, $posttexto, $postbloqueado, $postcategoria, $posturlamigavel, $postdata, $postid));
		
		return ($obj) ? $obj : false;
	}
	
	public function cadastrarPost($pdo, $posttitulo, $posturlamigavel, $posttexto, $postbloqueado, $postcategoria, $postdata, $usuarioid, $postcriadoem){
		$ins = $pdo->prepare("INSERT INTO 
								blog_post
								(
									posttitulo,
									posturlamigavel,
									posttexto,
									postbloqueado,
									blog_categoria_categoriaid,
									postdata,
									blog_usuario_usuarioid,
									postcriadoem
								) VALUES(
									:posttitulo,
									:posturlamigavel,
									:posttexto,
									:postbloqueado,
									:postcategoria,
									:postdata,
									:usuarioid,
									:postcriadoem
								)");
		$ins->bindParam(":posttitulo",$posttitulo);
		$ins->bindParam(":posturlamigavel",$posturlamigavel);
		$ins->bindParam(":posttexto",$posttexto);
		$ins->bindParam(":postbloqueado",$postbloqueado);
		$ins->bindParam(":postcategoria",$postcategoria);
		$ins->bindParam(":postdata",$postdata);
		$ins->bindParam(":usuarioid",$usuarioid);
		$ins->bindParam(":postcriadoem",$postcriadoem);
		
		$obj = $ins->execute();
		
		return ($obj) ? $obj : false;
	}
	
	public function excluirPost($pdo, $postid){
		// excluímos as imagens do banco de dados
		$ins = $pdo->prepare("DELETE FROM 
								blog_imagem
							 WHERE
								blog_post_postid=:postid");
		$ins->bindParam(":postid",$postid);
		$obj = $ins->execute();
		
		// excluimos o post
		$ins = $pdo->prepare("DELETE FROM 
								blog_post
							 WHERE
								postid=:postid");
		$ins->bindParam(":postid",$postid);
		$obj = $ins->execute();
		
		return ($obj) ? $obj : false;
	}
}
?>