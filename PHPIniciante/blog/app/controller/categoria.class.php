<?php
	class Categoria {
		function listarCategorias($app,$admin=null,$msg=""){
			// carrega o model do painel
			if($admin==null)
				$admin = $app->loadModel("Admin");

			$categorias = $admin->getTodasCategorias($app->conexao);
			
			$param = array("titulo"=>$app->site_titulo, 
						   "pagina" => "listarcategorias",
						   "dados" => array(
								"categorias" => $categorias,
								"msg" => $msg
							)
							);
							 
			$app->loadView("Admin",$param);
		}
		
		function alterarCategoria($app){
			$categoriaid = (int)$_GET["id"];
			
			$admin = $app->loadModel("Admin");
			
			$obj = $admin->getCategoriaId($app->conexao, $categoriaid);
					
			$param = array("titulo"=>$app->site_titulo, 
						   "pagina" => "formcategoria",
						   "dados" => array(
								"tituloform" => "Alterar categoria",
								"action"=>"execAlterarCategoria",
								"categoriaid"=>$obj["categoriaid"],
								"categoriatitulo"=>$obj["categoriatitulo"],
								"labelbtnsubmit"=>"Alterar Categoria"
							)
						   );
							 
			$app->loadView("Admin",$param);
		}
		
		function execAlterarCategoria($app){
			$admin = $app->loadModel("Admin");
			$categoriatitulo = tStr($_POST['categoriatitulo']);
			
			$categoriaid = (int)$_POST["categoriaid"];
			
			$obj = $admin->alteraDadosCategoria($app->conexao, $categoriaid, $categoriatitulo);
		
			if($obj) {
				$mensagem = "Alteração efetuada com sucesso!";
			} else {
				$mensagem = "Alteração falhou!";
			}
					
			$this->listarCategorias($app,$admin,$mensagem);
		}
		
		function excluirCategoria($app){
			$admin = $app->loadModel("Admin");
			
			$categoriaid = (int)$_GET["id"];
			
			$obj = $admin->excluirCategoria($app->conexao, $categoriaid);
			
			if($obj) {
				$mensagem = "Exclusão efetuada com sucesso!";
			} else {
				$mensagem = "Exclusão falhou! Verifique se a categoria não possui registros.";
			}
					
			$this->listarCategorias($app,$admin,$mensagem);
		}
		
		function cadastrarCategoria($app){			
			$param = array("titulo"=>$app->site_titulo, 
						   "pagina" => "formcategoria",
						   "dados" => array(
								"tituloform" => "Cadastrar nova categoria",
								"action"=>"execCadastrarCategoria",
								"categoriaid"=>"",
								"categoriatitulo"=>"",
								"labelbtnsubmit"=>"Cadastrar categoria"
							)
						   );
							 
			$app->loadView("Admin",$param);
		}
		
		function execCadastrarCategoria($app){
			$admin = $app->loadModel("Admin");
			
			$categoriatitulo = tStr($_POST["categoriatitulo"]);
			
			$obj = $admin->cadastrarCategoria($app->conexao, $categoriatitulo);
			
			if($obj) {
				$mensagem = "Cadastro efetuado com sucesso!";
			} else {
				$mensagem = "Cadastro falhou!";
			}
					
			$this->listarCategorias($app,$admin,$mensagem);
		}
}