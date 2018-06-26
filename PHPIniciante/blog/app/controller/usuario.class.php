<?php
	class Usuario {
		function listarUsuarios($app,$admin=null,$msg=""){
			// carrega o model do painel
			if($admin==null)
				$admin = $app->loadModel("Admin");

			$usuarios = $admin->getTodosUsuarios($app->conexao);
			
			$param = array("titulo"=>$app->site_titulo, 
						   "pagina" => "listarusuarios",
						   "dados" => array(
								"usuarios" => $usuarios,
								"msg" => $msg
							)
						   );
							 
			$app->loadView("Admin",$param);
		}
		
		function alterarUsuario($app){
			$usuarioid = (int)$_GET["id"];
			
			$admin = $app->loadModel("Admin");
			
			$obj = $admin->getUsuarioId($app->conexao, $usuarioid);
					
			$param = array("titulo"=>$app->site_titulo, 
						   "pagina" => "formusuario",
						   "dados" => array(
								"tituloform" => "Alterar usuário",
								"action"=>"execAlterarUsuario",
								"usuariouser"=>$obj["usuariouser"],
								"usuarionome"=>$obj["usuarionome"],
								"labelbtnsubmit"=>"Alterar Registro",
								"auxusuario"=>"disabled='disabled'",
								"usuarioid"=>$obj["usuarioid"],
								"auxsenha"=>""
							)
						   );
							 
			$app->loadView("Admin",$param);
		}
		
		function execAlterarUsuario($app){
			$admin = $app->loadModel("Admin");
			// alteração de usuário não é aceita
			// somente nome do usuário e a senha
			$nome = tStr($_POST['nome']);
			
			// lembrando que a senha pode vir vazia
			$senha = tStr($_POST['senha']);
			
			$usuarioid = (int)$_POST["usuarioid"];
			
			$obj = $admin->alteraDadosUsuario($app->conexao, $usuarioid, $nome, $senha);
		
			if($obj) {
				$mensagem = "Alteração efetuada com sucesso!";
			} else {
				$mensagem = "Alteração falhou!";
			}
					
			$this->listarUsuarios($app,$admin,$mensagem);
		}
		
		function excluirUsuario($app){
			$admin = $app->loadModel("Admin");
			
			$usuarioid = (int)$_GET["id"];
			
			$obj = $admin->excluirUsuario($app->conexao, $usuarioid);
			
			if($obj) {
				$mensagem = "Exclusão efetuada com sucesso!";
			} else {
				$mensagem = "Exclusão falhou!";
			}
					
			$this->listarUsuarios($app,$admin,$mensagem);
		}
		
		function cadastrarUsuario($app){			
			$param = array("titulo"=>$app->site_titulo, 
						   "pagina" => "formusuario",
						   "dados" => array(
								"tituloform" => "Cadastrar novo usuário",
								"action"=>"execCadastrarUsuario",
								"usuariouser"=>"",
								"usuarionome"=>"",
								"labelbtnsubmit"=>"Cadastrar usuário",
								"auxusuario"=>"",
								"usuarioid"=>"",
								"auxsenha"=>"required"
							)
						   );
							 
			$app->loadView("Admin",$param);
		}
		
		function execCadastrarUsuario($app){
			$admin = $app->loadModel("Admin");
			
			$usuario = tStr($_POST["usuario"]);
			$nome = tStr($_POST["nome"]);
			$senha = tStr($_POST["senha"]);
			
			$obj = $admin->cadastrarUsuario($app->conexao, $usuario, $nome, $senha);
			
			if($obj) {
				$mensagem = "Cadastro efetuado com sucesso!";
			} else {
				$mensagem = "Cadastro falhou!";
			}
					
			$this->listarUsuarios($app,$admin,$mensagem);
		}
}