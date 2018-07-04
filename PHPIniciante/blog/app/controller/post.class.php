<?php
	class Post {
		
		function alterarPost($app){
			$postid = (int)$_GET["id"];
			
			$admin = $app->loadModel("Admin");
			$site = $app->loadModel("Site");
			
			$obj = $site->getPost($app->conexao, $postid);
			$categorias = $admin->getTodasCategorias($app->conexao);
			
			$criadoem = dtToBr($obj->postcriadoem);
			$postdata = dtToBr($obj->postdata);
			
			$param = array("titulo"=>$app->site_titulo, 
						   "pagina" => "formpost",
						   "dados" => array(
								"tituloform" => "Alterar post",
								"action"=>"execAlterarPost",
								"postid"=>$obj->postid,
								"posttitulo"=>$obj->posttitulo,
								"posttexto"=>$obj->posttexto,
								"postbloqueado"=>$obj->postbloqueado,
								"postcategoriaid"=>$obj->postcategoriaid,
								"postcriadoem"=>$criadoem,
								"postdata"=>$postdata,
								"auxPostData"=>$postdata,
								"postusuarionome"=>$obj->postusuarionome,
								"labelbtnsubmit"=>"Alterar Post",
								"categorias"=>$categorias
							)
						   );
							 
			$app->loadView("Admin",$param);
		}
		
		function execAlterarPost($app){
			$admin = $app->loadModel("Admin");
			
			$postid = (int)$_POST["postid"];
			$posttitulo = tStr($_POST["posttitulo"]);
			$posturlamigavel = limpaUrl($posttitulo);
			$posttexto = tStr($_POST["posttexto"]);
			$postbloqueado = (int)$_POST["postbloqueado"];
			$postcategoria = (int)$_POST["postcategoria"];
			$postdata = brToDt($_POST["postdata"]); 

			$obj = $admin->alteraDadosPost($app->conexao, $postid, $posttitulo, $posttexto, $postbloqueado, $postcategoria, $posturlamigavel, $postdata);
		
			if($obj) {
				$mensagem = "Alteração efetuada com sucesso!";
			} else {
				$mensagem = "Alteração falhou!";
			}
			
			renderizaAdminInicial($app, $mensagem);
		}
		
		function excluirPost($app){
			$admin = $app->loadModel("Admin");
			$postid = (int)$_GET["id"];
						
			// precisamos excluir todas as imagens do post
			// vamos pegar as imagens
			$obj = $admin->getTodasImagens($app->conexao, $postid);
			
			// excluimos os arquivos fisicos
			foreach($obj as $imagem){
				@unlink("upload/".$imagem["imagemarquivo"]);
				@unlink("upload/thumb/".$imagem["imagemarquivo"]);
			}
			
			// excluímos do banco de dados
			$obj = $admin->excluirPost($app->conexao, $postid);
			
			if($obj) {
				$mensagem = "Exclusão efetuada com sucesso!";
			} else {
				$mensagem = "Exclusão falhou!";
			}
			
			renderizaAdminInicial($app, $mensagem);
		}
		
		function cadastrarPost($app){
			
			$admin = $app->loadModel("Admin");
			
			$categorias = $admin->getTodasCategorias($app->conexao);
			
			$param = array("titulo"=>$app->site_titulo, 
						   "pagina" => "formpost",
						   "dados" => array(
								"tituloform" => "Cadastrar post",
								"action"=>"execCadastrarPost",
								"postid"=>"",
								"posttitulo"=>"",
								"posttexto"=>"",
								"postbloqueado"=>0,
								"postcategoriaid"=>"",
								"postcriadoem"=>"",
								"postdata"=>dtToBr(),
								"auxPostData"=>dtToBr(),
								"postusuarionome"=>"",
								"labelbtnsubmit"=>"Cadastrar Post",
								"categorias"=>$categorias
							)
						   );
							 
			$app->loadView("Admin",$param);
		}
		
		function execCadastrarPost($app){
			$admin = $app->loadModel("Admin");
			
			$posttitulo = tStr($_POST["posttitulo"]);
			$posturlamigavel = limpaUrl($posttitulo);
			$posttexto = $_POST["posttexto"];
			$postbloqueado = (int)$_POST["postbloqueado"];
			$postcategoria = (int)$_POST["postcategoria"];
			$postdata = brToDt($_POST["postdata"]); 
			$usuarioid = $_SESSION["usuarioid"];
			
			$obj = $admin->cadastrarPost($app->conexao, 
										 $posttitulo, 
										 $posturlamigavel, 
										 $posttexto, 
										 $postbloqueado,
										 $postcategoria,
										 $postdata,
										 $usuarioid,
										 brToDt());
			
			if($obj) {
				$mensagem = "Cadastro efetuado com sucesso!";
			} else {
				$mensagem = "Cadastro falhou!";
			}
					
			renderizaAdminInicial($app, $mensagem);
		}
}