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
							usuario.usuarionome AS postusuarionome
						FROM blog_post AS post 
						INNER JOIN blog_usuario AS usuario ON usuario.usuarioid = post.blog_usuario_usuarioid 
						INNER JOIN blog_categoria AS categoria ON categoria.categoriaid = post.blog_categoria_categoriaid ";


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
	public function listaPosts($pdo, $bloqueado = null){
		$where	= " ";

		/**
		 *	Caso o parâmetro $bloqueado receba algum valor, adicionar condição para listar posts bloqueados ou desbloqueados
		 *	0 - Bloqueado
		 *	1 - Desbloqueado 
		 */
		if($bloqueado != null)
			$where	= " AND postbloqueado = " . $bloqueado . " ";

		$obj	= $pdo->prepare($this->sqlPost . $where);

		return ($obj->execute()) ? $obj : false;
	}

	/**
	 *	Função responsável por buscar no banco de dados um post, utilizando como base um postid (blog_post.postid)
	 */
	public function getPost($pdo, $postId){
		/**
		 *	Setar o id como condição na pesquisa
		 */
		$where	= " AND post.postid = :postid ";
		
		$obj	= $pdo->prepare($this->sqlPost . $where);
		$obj->bindParam(":postid", $postId);

		return ($obj->execute()) ? $obj->fetch(PDO::FETCH_OBJ) : false;
	}

	/**
	 *	Função responsável por buscar no banco de dados as imagens de um determinado post, utilizando como base um postid (blog_post.postid)
	 */
	public function listaImagensPost($pdo, $postId, $destaque = null){
		$sql 	= "SELECT * FROM blog_imagem WHERE blog_post_postid = :postid";
		$where 	= "";


		/**
		 *	Caso o parâmetro $destaque receba algum valor, adicionar condição para listar apenas as imagens com destaque ou sem destaque
		 *	0 - Sem destaque
		 *	1 - Com Destaque 
		 */
		if($destaque != null)
			$where 	= " AND imagemdestaque = " . $destaque . " ";

		$obj 	= $pdo->prepare($sql . $where);
		$obj->bindParam(":idpost", $postId);
		return ($obj->execute()) ? $obj->fetch(PDO::FETCH_OBJ) : false;
	}
}
?>