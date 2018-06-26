<?php
/**
 *	Classe respnsável pela manutenção dos posts
 */
class Site
{
	
	public $sqlPost	= "SELECT 
							post.postid,
							post.posttitulo,
							post.posttexto,
							post.postbloqueado,
							post.postdata,
							post.posturlamigavel,
							categoria.categoriatitulo AS postcategoria,
							usuario.usuarionome AS postusuarionome,
							imagem.imagemarquivo,
							imagem.imagemlegenda
						FROM blog_post AS post 
						INNER JOIN blog_usuario AS usuario ON usuario.usuarioid = post.blog_usuario_usuarioid 
						INNER JOIN blog_categoria AS categoria ON categoria.categoriaid = post.blog_categoria_categoriaid 
						LEFT JOIN (
									SELECT 
										imagem.imagemarquivo,
										imagem.imagemlegenda,
										imagem.blog_post_postid
									FROM blog_imagem AS imagem
									WHERE imagem.imagemdestaque = 1
									ORDER BY imagem.imagemid DESC
									LIMIT 1
						) AS imagem ON imagem.blog_post_postid = post.postid 
						WHERE 1 = 1 ";


	/**
	 *	Função responsável pela listagem de categorias do banco de dados
	 */
	public function listaCategorias($pdo){
		$obj	= $pdo->prepare("SELECT categoriaid, categoriatitulo FROM blog_categoria");
		return ($obj->execute()) ? $obj : false;
	}

	/**
	 *	Função responsável pela listagem de posts
	 */
	public function listaPosts($pdo, $bloqueado = "NI", $categoriaid = null){
		$where	= " ";

		/**
		 *	Caso o parâmetro $bloqueado receba algum valor, adicionar condição para listar posts bloqueados ou desbloqueados
		 *	0 - Desbloqueado
		 *	1 - Bloqueado
		 */
		if($bloqueado !== "NI")
			$where	.= " AND post.postbloqueado = :bloqueado ";

		/**
		 *	Caso o parâmetro $categoriaid receba algum valor, adicionar condição para listar posts da categoria informada
		 */
		if($categoriaid != null)
			$where	.= " AND categoria.categoriaid = :categoriaid ";


		/**
		 *	Preparar a SQL para ser executa
		 */
		$obj	= $pdo->prepare($this->sqlPost . $where);

		/**
		 *	Caso o parametro $bloqueado seja informado, o mesmo será passado a SQL
		 */
		if($bloqueado !== "NI")
			$obj->bindParam(":bloqueado", $bloqueado);

		/**
		 *	Caso o parametro $categoriaid seja informado, o mesmo será passado a SQL
		 */
		if($categoriaid != null)
			$obj->bindParam(":categoriaid", $categoriaid, PDO::PARAM_INT);

		$obj->execute();
		return $obj;
	}

	/**
	 *	Função responsável por buscar no banco de dados um post, utilizando como base um postid (blog_post.postid)
	 */
	public function getPost($pdo, $postId, $url = null){
		/**
		 *	Neste caso o desenvolvedor deverá utilizar a URL amigável como parâmetro ou o id do post
		 */
		if($url == null){
			/**
			 *	Setar o id como condição na pesquisa
			 */
			$where	= " AND post.postid = :postid ";
			
			$obj	= $pdo->prepare($this->sqlPost . $where);
			$obj->bindParam(":postid", $postId);
		}else{
			/**
			 *	Setar a URL como condição na pesquisa
			 */
			$where	= " AND post.posturlamigavel = :url ";
			
			$obj	= $pdo->prepare($this->sqlPost . $where);
			$obj->bindParam(":url", $url);
		}

		return ($obj->execute()) ? $obj->fetch(PDO::FETCH_OBJ) : false;
	}

	/**
	 *	Função responsável por buscar no banco de dados as imagens de um determinado post, utilizando como base um postid (blog_post.postid)
	 */
	public function listaImagensPost($pdo, $postId, $destaque = "NI"){
		$sql 	= "SELECT * FROM blog_imagem WHERE blog_post_postid = :postid";
		$where 	= "";


		/**
		 *	Caso o parâmetro $destaque receba algum valor, adicionar condição para listar apenas as imagens com destaque ou sem destaque
		 *	0 - Sem destaque
		 *	1 - Com Destaque 
		 */
		if($destaque != "NI")
			$where 	= " AND imagemdestaque = " . $destaque . " ";

		$obj 	= $pdo->prepare($sql . $where);
		$obj->bindParam(":postid", $postId);

		return ($obj->execute()) ? $obj : false;
	}
}
?>