<?php
	class Imagem {
		function listarImagens($app, $postid, $admin=null, $msg=""){
			// carrega o model do painel
			if($admin==null)
				$admin = $app->loadModel("Admin");

			$imagens = $admin->getTodasImagens($app->conexao, $postid);
			
			$param = array("titulo"=>$app->site_titulo, 
						   "pagina" => "listarimagens",
						   "dados" => array(
								"imagens" => $imagens,
								"postid" => $postid,
								"msg" => $msg
							)
							);
							 
			$app->loadView("Admin",$param);
		}
		
		function alterarImagem($app){
			$imagemid = (int)$_GET["id"];
			
			$admin = $app->loadModel("Admin");
			
			$obj = $admin->getImagemId($app->conexao, $imagemid);
					
			$param = array("titulo"=>$app->site_titulo, 
						   "pagina" => "formimagem",
						   "dados" => array(
								"tituloform" => "Alterar imagem",
								"action"=>"execAlterarImagem",
								"imagemid"=>$obj["imagemid"],
								"imagemlegenda"=>$obj["imagemlegenda"],
								"imagemdestaque"=>$obj["imagemdestaque"],
								"postid"=>$obj["postid"],
								"labelbtnsubmit"=>"Alterar Imagem"
							)
						   );
							 
			$app->loadView("Admin",$param);
		}
		
		function execAlterarImagem($app){
			$admin = $app->loadModel("Admin");
			
			$imagemid = (int)$_POST["imagemid"];
			$imagemlegenda = tStr($_POST["imagemlegenda"]);
			$imagemdestaque = (int)$_POST["imagemdestaque"];
			$postid = (int)$_POST["postid"];

			$obj = $admin->alteraDadosImagem($app->conexao, $imagemid, $imagemlegenda, $imagemdestaque);
		
			if($obj) {
				$mensagem = "Alteração efetuada com sucesso!";
			} else {
				$mensagem = "Alteração falhou!";
			}
					
			$this->listarImagens($app,$postid,$admin,$mensagem);
		}
		
		function excluirImagem($app){
			$admin = $app->loadModel("Admin");
			$imagemid = (int)$_GET["id"];
			$postid = (int)$_GET["postid"];
			
			// precisamos excluir os arquivos físicos
			// vamos pegar os dados da imagem
			$obj = $admin->getImagemId($app->conexao, $imagemid);
			
			// excluimos os arquivos fisicos
			unlink("upload/".$obj["imagemarquivo"]);
			unlink("upload/thumb/".$obj["imagemarquivo"]);
			
			// excluímos do banco de dados
			$obj = $admin->excluirImagem($app->conexao, $imagemid);
			
			if($obj) {
				$mensagem = "Exclusão efetuada com sucesso!";
			} else {
				$mensagem = "Exclusão falhou!";
			}
			
			$this->listarImagens($app,$postid,$admin,$mensagem);
		}
		
		function cadastrarImagem($app){
			$postid = (int)$_GET["postid"];
			
			$param = array("titulo"=>$app->site_titulo, 
						   "pagina" => "formimagem",
						   "dados" => array(
								"tituloform" => "Cadastrar imagem",
								"action"=>"execCadastrarImagem",
								"imagemid"=>"",
								"imagemlegenda"=>"",
								"imagemdestaque"=>0,
								"postid"=>$postid,
								"labelbtnsubmit"=>"Cadastrar Imagem"
							)
						   );
							 
			$app->loadView("Admin",$param);
		}
		
		function execCadastrarImagem($app){
			$admin = $app->loadModel("Admin");
			$postid = (int)$_POST["postid"];
			
			if($_FILES["arquivo"]["tmp_name"] == ""){
				$this->listarImagens($app,$postid,$admin,"Falha ao cadastrar imagem! Selecione uma imagem.");
				return;
			}
			
			// precisamos fazer o upload da imagem
			$img = $app->uploadImagem($_FILES["arquivo"]);
			
			if($img == false){
				$this->listarImagens($app,$postid,$admin,"Falha ao cadastrar imagem, verifique o tipo de arquivo enviado!");
				return;
			}
			
			$imagemlegenda = tStr($_POST["imagemlegenda"]);
			$imagemdestaque = (int)$_POST["imagemdestaque"];
			
			$obj = $admin->cadastrarImagem($app->conexao, $postid, $img, $imagemlegenda, $imagemdestaque);
			
			if($obj) {
				$mensagem = "Cadastro efetuado com sucesso!";
			} else {
				$mensagem = "Cadastro falhou!";
			}
					
			$this->listarImagens($app,$postid,$admin,$mensagem);
		}
}